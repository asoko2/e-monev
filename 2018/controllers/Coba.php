<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends User_Controller {

    public function index()
    {
        print_r($this->ion_auth->user);        
    }

}

/* End of file Coba.php */
/* Location: ./application/controllers/Coba.php */
