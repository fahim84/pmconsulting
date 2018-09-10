<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Icocustom extends CI_Controller {
	
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
		$order_by = $this->input->get_post('order_by') ? $this->input->get_post('order_by') : 'rating';
		$direction = $this->input->get_post('direction') ? $this->input->get_post('direction') : 'DESC';
		$listing = $this->input->get_post('listing') ? $this->input->get_post('listing') : '';

		$keyword = $this->input->get_post('keyword');

		# Pagination Code
		$offset	=	$this->input->get_post('per_page');
		if($offset < 1)
		{
			$offset = 0;
		}

		if ($this->uri->segment(4)) { $limit = $this->uri->segment(4); }else{ $limit = 50; }
		
		if($keyword != '') $query_params['keyword'] = $keyword;

		$query_params['limit'] = $limit;
		$query_params['offset'] = $offset;
		$query_params['order_by'] = $order_by;
		$query_params['direction'] = $direction;
		$query_params['listing'] = $listing;

		$total_rows = $this->ico_custom_model->get($query_params,true);
		$rows = $this->ico_custom_model->get($query_params);
		
		# array for pagination query string
		$qstr['order_by'] = $order_by;
		$qstr['direction'] = $direction;
		if($keyword) $qstr['keyword'] = $keyword;
		if($listing) $qstr['listing'] = $listing;

		$page_query_string = '?'.http_build_query($qstr);
		$config['base_url'] = base_url('admin/ico/index/'.$page_query_string);
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config);
		$this->data['pagination_links'] = $this->pagination->create_links();
		// Paination code end
		
		$this->data['keyword'] = $keyword;
		$this->data['listing'] = $listing;
		$this->data['order_by'] = $order_by;
		$this->data['direction'] = $direction;
		$this->data['total_rows'] = $total_rows;
		$this->data['rows'] = $rows;
		
		$this->data['selected_page'] = 'icocustom';
		$this->load->view('admin/ico_custom', $this->data);
	}
	
	public function update()
	{
		$id = $this->input->get_post('id');

		// Set the validation rules
		$this->form_validation->set_rules('id', 'ID', 'required|trim');

		// If the validation worked
		if ($this->form_validation->run())
		{
            $get_post = $this->input->get_post(null,true);

            $get_post['preIcoStart'] = date('Y-m-d H:i:s',strtotime($this->input->get_post('start_date').' '.$this->input->get_post('start_time')));
            $get_post['preIcoEnd'] = date('Y-m-d H:i:s',strtotime($this->input->get_post('end_date').' '.$this->input->get_post('end_time')));
            $get_post['icoStart'] = $get_post['preIcoStart'];
            $get_post['icoEnd'] = $get_post['preIcoEnd'];

            unset($get_post['start_date']);
            unset($get_post['start_time']);
            unset($get_post['end_date']);
            unset($get_post['end_time']);

            $delete_old_file = $this->input->get_post('delete_old_file');
            $uploaded_file_array = (isset($_FILES['image']) and $_FILES['image']['size'] > 0 and $_FILES['image']['error'] == 0) ? $_FILES['image'] : '';
            # Show uploading error only when the file uploading attempt exist.
            if( is_array($uploaded_file_array) )
            {
                $delete_old_file = true;
            }

            # File uploading configuration
            $upload_path = './uploads/icos/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = true;
            $config['max_size'] = 512000; //KB

            $this->load->library('upload', $config);

            $oldfile = $this->input->get_post('oldfile');
            if($delete_old_file)
            {
                # Delete old file if there was any
                if(delete_file($upload_path.$oldfile))
                {
                    $_SESSION['msg_success'][] = " $oldfile file deleted. ";
                    $this->ico_custom_model->update($id,['image'=>'']);
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
                $width > 200 ? resize_image2($image_path, 200, '', 'W') : '';
                $height = get_height($image_path);
                $height > 200 ? resize_image2($image_path, '', 200, 'H') : '';
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

            ////////////////////////////////////////////////////////////////////////

            $delete_old_file = $this->input->get_post('delete_old_file2');
            $uploaded_file_array = (isset($_FILES['video']) and $_FILES['video']['size'] > 0 and $_FILES['video']['error'] == 0) ? $_FILES['video'] : '';
            # Show uploading error only when the file uploading attempt exist.
            if( is_array($uploaded_file_array) )
            {
                $delete_old_file = true;
            }

            $oldfile = $this->input->get_post('oldfile2');
            if($delete_old_file)
            {
                # Delete old file if there was any
                if(delete_file($upload_path.$oldfile))
                {
                    $_SESSION['msg_success'][] = " $oldfile file deleted.";
                    $this->ico_custom_model->update($id,['video'=>'']);
                }
            }

            # Try to upload file now
            if ($this->upload->do_upload('video'))
            {
                # Get uploading detail here
                $upload_detail = $this->upload->data();

                $get_post['video'] = $upload_detail['file_name'];
            }
            else
            {
                $uploaded_file_array = (isset($_FILES['video']) and $_FILES['video']['name']!='') ? $_FILES['video'] : '';

                # Show uploading error only when the file uploading attempt exist.
                if( is_array($uploaded_file_array) )
                {
                    $uploading_error = $this->upload->display_errors();
                    $_SESSION['msg_error'][] = $uploading_error;
                }
            }


            unset($get_post['id']);
            unset($get_post['oldfile']);
            unset($get_post['delete_old_file']);
            unset($get_post['oldfile2']);
            unset($get_post['delete_old_file2']);

            if($id > 0) // update
            {
                if($this->ico_custom_model->update($id,$get_post))
                {
                    $_SESSION['msg_success'][] = 'Data Updated...';

                    redirect('admin/icocustom/');
                }
            }
            else // insert
            {
                $get_post['status'] = 1;
                if($this->ico_custom_model->insert($get_post))
                {
                    $_SESSION['msg_success'][] = 'Record added successfully...';
                    redirect('admin/icocustom/');
                }
            }
		}

		if($id > 0)
		$this->data['update_data'] = $this->ico_custom_model->get_ico_by_id($id);
		
		$this->data['selected_page'] = 'icocustom';
		$this->load->view('admin/ico_custom_update', $this->data);
	}
	
	public function delete()
	{
		$delete_id = $this->uri->segment(4) ? $this->uri->segment(4) : $this->input->get_post('delete_id');
		
		$this->ico_custom_model->delete($delete_id);
		$_SESSION['msg_error'][] = 'Record deleted successfully!';
		redirect('admin/icocustom/');
	}

    public function change_status()
    {
        $id = $this->input->get_post('id');
        $status = $this->input->get_post('status');

        $this->ico_custom_model->update($id,['status'=>$status]);

        my_var_dump($this->db->last_query());
    }
}

