<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	var $data;
	public function __construct()
	{
		parent::__construct();
		
		# if user is not logged in, then redirect him to login page
		if(! isset($_SESSION['user']->user_id) )
		{
			$_SESSION['redirect_to_last_url'] = current_url();
			redirect(base_url().'admin/login/','location');
		}
	}
	
	public function index()
	{
		$order_by = $this->input->get_post('order_by') ? $this->input->get_post('order_by') : 'date_created';
		$direction = $this->input->get_post('direction') ? $this->input->get_post('direction') : 'DESC';
		
		$keyword = $this->input->get_post('keyword');

		# Pagination Code
		$offset	=	$this->input->get_post('per_page');
		if($offset < 1)
		{
			$offset = 0;
		}

		if ($this->uri->segment(4)) { $limit = $this->uri->segment(4); }else{ $limit = 10; }
		
		if($keyword != '') $query_params['keyword'] = $keyword;

		$query_params['limit'] = $limit;
		$query_params['offset'] = $offset;
		$query_params['order_by'] = $order_by;
		$query_params['direction'] = $direction;
		
		$total_rows = $this->user_model->get($query_params,true);
		$users = $this->user_model->get($query_params);
		
		# array for pagination query string
		$qstr['order_by'] = $order_by;
		$qstr['direction'] = $direction;
		if($keyword) $qstr['keyword'] = $keyword;

		$page_query_string = '?'.http_build_query($qstr);
		$config['base_url'] = base_url('admin/user/index/'.$page_query_string);
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config);
		$this->data['pagination_links'] = $this->pagination->create_links();
		// Paination code end
		
		$this->data['keyword'] = $keyword;
		$this->data['order_by'] = $order_by;
		$this->data['direction'] = $direction;
		$this->data['total_rows'] = $total_rows;
		$this->data['users'] = $users;
		
		$this->data['selected_page'] = 'user';
		$this->load->view('admin/user', $this->data);
	}
	
	public function update()
	{
		$id = $this->input->get_post('id');

		// Set the validation rules
		$this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
        $this->form_validation->set_rules('roles[]', 'Role', 'required|trim');
		if($id > 0)
        {
            $this->form_validation->set_rules('password', 'Password', 'trim');

        }
        else
        {
            $this->form_validation->set_rules('password', 'Password', 'trim');
        }

		// If the validation worked
		if ($this->form_validation->run())
		{
            $get_post = $this->input->get_post(null,true);

            $get_post['roles'] = is_array($this->input->get_post('roles')) ? $this->input->get_post('roles') : [];
            $get_post['rights'] = is_array($this->input->get_post('rights')) ? $this->input->get_post('rights') : [];

			if($get_post['email'] != '' and $this->user_model->email_already_exists($get_post['email'], $id))
			{
				$_SESSION['msg_error'][] = 'Email address already taken...';
			}
            else
			{
				$delete_old_file = $this->input->get_post('delete_old_file');
				$uploaded_file_array = (isset($_FILES['image']) and $_FILES['image']['size'] > 0 and $_FILES['image']['error'] == 0) ? $_FILES['image'] : '';
				# Show uploading error only when the file uploading attempt exist.
				if( is_array($uploaded_file_array) )
				{
					$delete_old_file = true;
				}
				
				# File uploading configuration
				$upload_path = './uploads/users/';
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['encrypt_name'] = true;
                $config['max_size'] = 51200; //KB

				$this->load->library('upload', $config);
				
				$oldfile = $this->input->get_post('oldfile');
				if($delete_old_file)
				{
					# Delete old file if there was any
					if(delete_file($upload_path.$oldfile))
					{
						$_SESSION['msg_success'][] = " $oldfile file deleted. ";
						$this->user_model->update($id,['image'=>'']);
					}
				}
				
				# Try to upload file now
				if ($this->upload->do_upload('image'))
				{
					# Get uploading detail here
					$upload_detail = $this->upload->data();

                    $get_post['image'] = $upload_detail['file_name'];
					$image = $get_post['image'];

					# Get width and height and resize image keeping aspect ratio same
					$image_path = $upload_path.$image;
					$width = get_width($image_path);
					$width > 800 ? resize_image2($image_path, 800, '', 'W') : '';
					$height = get_height($image_path);
					$height > 600 ? resize_image2($image_path, '', 600, 'H') : '';
				}
                else
                {
                    $uploaded_file_array = (isset($_FILES['image']) and $_FILES['image']['name']!='') ? $_FILES['image'] : '';

                    # Show uploading error only when the file uploading attempt exist.
                    if( is_array($uploaded_file_array) )
                    {
                        $uploading_error = $this->upload->display_errors();
                        $_SESSION['msg_error'][] = $uploading_error;
                    }
                }

                $get_post['dob'] = $get_post['dob'] ? date('Y-m-d',strtotime($get_post['dob'])) :'';
                $get_post['fullname'] = $get_post['firstname'].' '.$get_post['lastname'];

				if($get_post['password']!='') {
                    $get_post['password'] = md5($get_post['password']);
				}
				else
				    unset($get_post['password']);

				unset($get_post['id']);
				unset($get_post['oldfile']);
				unset($get_post['delete_old_file']);
				if($id > 0) // update
                {
                    if($this->user_model->update($id,$get_post))
                    {
                        $_SESSION['msg_success'][] = 'Data Updated...';

                        redirect('admin/user/');
                    }
                }
                else // insert
                {
                    if($this->user_model->insert($get_post))
                    {
                        $_SESSION['msg_success'][] = 'Record added successfully...';
                        redirect('admin/user/');
                    }
                }
			}
		}

		if($id > 0)
		$this->data['update_data'] = $this->user_model->get_user_by_id($id);
		
		$this->data['selected_page'] = 'user';
		$this->load->view('admin/user_update', $this->data);
	}
	
	public function delete()
	{
		$delete_id = $this->uri->segment(4) ? $this->uri->segment(4) : $this->input->get_post('delete_id');
		
		$this->user_model->delete($delete_id);
		$_SESSION['msg_error'][] = 'Record deleted successfully!';
		redirect('admin/user/');
	}
	
	public function change_status()
	{
		$id = $this->input->get_post('id');
		$status = $this->input->get_post('status');
		$data['is_activated'] = $status;
		//$data['deleted'] = $status == 0 ? 1 : 0;
		$this->user_model->update($id,$data);
		
		$user = $this->user_model->get_user_by_id($id);
		$login_url = base_url().'admin/login/login_with_link?id='.md5($id);
		$login_url = '<p><a href="'.$login_url.'">Click here to login</a></p>';
		$login_url = $user->is_activated ? $login_url : '';
		
		$approved_disapproved = $user->is_activated ? 'approved' : 'disapproved';
		
		# Send notification to User
		if($user->email!='')
		{
			# Send email to Signup User
			$this->email->clear(TRUE);
			$this->email->set_mailtype("html");
			$this->email->from(SYSTEM_EMAIL, SYSTEM_NAME);
			$this->email->to($user->email);
			$this->email->subject('Your account has been '.$approved_disapproved);
			$this->email->message('Your user account has been '.$approved_disapproved.$login_url);
			$this->email->send();
			
			my_var_dump('Your account has been '.$approved_disapproved);
		}
	}

    public function search_rights()
    {
        $tags = [];
        $keyword = $this->input->get_post('keyword');
        $query_params['offset'] = 0;
        $query_params['limit'] = 10;
        $query_params['keyword'] = $keyword;

        # get rows
        $this->db->like('right', $query_params['keyword']);
        $this->db->limit($query_params['limit'], $query_params['offset']);
        $query = $this->db->get('rights');
        //my_var_dump($this->db->last_query());
        foreach($query->result() as $row)
        {
            $tags[] = ['value' => $row->right_id, 'text' => $row->right];
        }

        echo json_encode($tags);
    }

    public function search_users()
    {
        $tags = [];
        $keyword = $this->input->get_post('keyword');
        $query_params['offset'] = 0;
        $query_params['limit'] = 10;
        $query_params['keyword'] = $keyword;

        # get rows
        $this->db->like('fullname', $query_params['keyword']);
        $this->db->limit($query_params['limit'], $query_params['offset']);
        $query = $this->db->get('users');
        //my_var_dump($this->db->last_query());
        foreach($query->result() as $row)
        {
            $tags[] = ['value' => $row->user_id, 'text' => $row->fullname];
        }

        echo json_encode($tags);
    }
}

