<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {

    var $data;

    public function index()
    {
		$this->data['selected_page'] = 'aboutus';
		$this->load->view('aboutus', $this->data);
    }
	
	public function howwework()
    {
		$this->data['selected_page'] = 'howwework';
        $this->load->view('howwework', $this->data);
    }
	
	public function ourteam()
    {
		$this->data['selected_page'] = 'ourteam';
        $this->load->view('ourteam', $this->data);
    }
	
	public function ourprojects()
    {
		$this->data['selected_page'] = 'ourprojects';
        $this->load->view('ourprojects', $this->data);
    }
	
	public function blog()
    {
		$this->data['selected_page'] = 'blog';
        $this->load->view('blog', $this->data);
    }
	
	public function contactus()
    {
		$this->data['selected_page'] = 'contactus';
        $this->load->view('contactus', $this->data);
    }
	
}
