<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Private_member extends CI_Controller {

    var $data;

    public function index()
    {
        $this->data['show'] = $this->input->get_post('show');
        $this->data['selected_page'] = 'private_member';

        $this->load->view('private_member', $this->data);
    }


}
