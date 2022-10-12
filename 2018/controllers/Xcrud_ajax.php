<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Xcrud_ajax extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->library('session','ion_auth');
        $this->load->helper(array('url', 'xcrud'));
        Xcrud_config::$scripts_url = base_url('');
        $this->output->set_output(Xcrud::get_requested_instance());
    }
}

/* End of file xcrud_ajax.php */
/* Location: ./application/controllers/xcrud_ajax.php */
