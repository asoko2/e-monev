<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {

    public function index()
    {
    	$this->load->view('landing');
        //print_r($this->ion_auth->user);        
    }

}

/* End of file Coba.php */
/* Location: ./application/controllers/Coba.php */
