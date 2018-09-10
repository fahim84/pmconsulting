<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	var $data;
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		# if user is already logged in, then redirect him to welcome page
		if(isset($_SESSION['user']->user_id) )
		{
			redirect(base_url().'admin/welcome/','refresh');
		}

		// Set the validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		// If the validation worked
		if ($this->form_validation->run())
		{
			$login_detail['email'] = $this->input->get_post('email');
			$login_detail['password'] = $this->input->get_post('password');
			
			if($user_detail = $this->user_model->check_login($login_detail)) // if login success
			{
				if($user_detail->deleted)
				{
					$_SESSION['msg_error'][] = 'Your account is banned by administration...';
				}
				else
				{
					if($user_detail->is_activated)
					{
						$this->user_model->update($user_detail->user_id,['last_login' => date('Y-m-d H:i:s')]);
						
						# Set session here and redirect user
						$_SESSION['user'] = $user_detail;
						
						if($this->input->get_post('remember_me') == 1)
						{
                            $_SESSION['user']->remember_me = 1;
						}
						else
						{
                            $_SESSION['user']->remember_me = 0;
						}
						
						$redirect_url = isset($_SESSION['redirect_to_last_url']) ? $_SESSION['redirect_to_last_url'] : base_url().'admin/welcome/';
						unset($_SESSION['redirect_to_last_url']);
						redirect($redirect_url,'location');
					}
					else
					{
						$_SESSION['msg_error'][] = 'Your account is not yet activated by administration, Please check your welcome email for activation link...!';
					}
				}
			}
			else
			{
				$_SESSION['msg_error'][] = 'Either email or password is wrong';
			}
		}

		$this->load->view('admin/login',$this->data);
	}
	
	public function remember_me($user_id)
	{
		if($user_detail = $this->user_model->get_user_by_id($user_id)) // if login success
		{
            if($user_detail->deleted)
            {
                $_SESSION['msg_error'][] = 'Your account is banned by administration...';
            }
            else
            {
                if($user_detail->is_activated)
                {
                    $this->user_model->update($user_detail->user_id,['last_login' => date('Y-m-d H:i:s')]);

                    # Set session here and redirect user
                    $_SESSION['user'] = $user_detail;
					$_SESSION['user']->remember_me = 1;
					
					$redirect_url = isset($_SESSION['redirect_to_last_url']) ? $_SESSION['redirect_to_last_url'] : base_url().'admin/welcome/';
					unset($_SESSION['redirect_to_last_url']);
					//my_var_dump($redirect_url);
					redirect($redirect_url,'location');
					exit;
				}
				else
				{
					$_SESSION['msg_error'][] = 'Your account is not yet activated by administration, Please check your welcome email for activation link...!';
				}
			}
		}
		$this->load->view('admin/login',$this->data);
	}
	public function logout()
	{
		session_destroy();
		$this->load->view('admin/logout',$this->data);
	}

    public function login_with_link()
    {
        $id = $this->uri->segment(4) ? $this->uri->segment(4) : $this->input->get_post('id');

        my_var_dump($id);
        if($user_detail = $this->user_model->get_user_by_md5_id($id)) // if login success
        {
            if($user_detail->deleted)
            {
                $_SESSION['msg_error'][] = 'Your account is banned by administration...';
                redirect(base_url().'admin/login/','refresh');
                exit;
            }
            else
            {
                if($user_detail->is_activated)
                {
                    $this->user_model->update($user_detail->user_id,['last_login' => date('Y-m-d H:i:s')]);

                    # Set session here and redirect user
                    $_SESSION['user'] = $user_detail;

                    redirect(base_url().'admin/','location');
                    exit;
                }
                else
                {
                    $_SESSION['msg_error'][] = 'Your account is not yet activated by administration, Please check your welcome email for activation link...!';
                    redirect(base_url().'admin/login/','refresh');
                    exit;
                }
            }
        }
    }
}