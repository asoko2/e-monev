<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data;
    public $opd;

	public $app;

	public function __construct()
	{
		parent::__construct();

        $this->data['page_title'] = '';
        $this->data['window_title'] = '';
        $this->app = $this->db->get('app_config', 1)->row();
        $this->opd = $this->db->get('vv_subunit')->result();
    }

    public function render($view='')
    {
        $this->load->view('layout/header', $this->data);
        $this->load->view('layout/topnav', $this->data);
        $this->load->view('layout/leftmenu', $this->data);
        if ($view != '') {
            $this->load->view($view, $this->data);
        }
        $this->load->view('layout/footer', $this->data);


        
	}

	public function response($data = NULL, $http_code = NULL)
	{
	    // If the HTTP status is not NULL, then cast as an integer
	    if ($http_code !== NULL)
	    {
	        // So as to be safe later on in the process
	        $http_code = (int) $http_code;
	    }

	    // Set the output as NULL by default
	    $output = NULL;

	    if ($data === NULL && $http_code === NULL)
	    {
	        $http_code = 404;
	    }

	    // If data is not NULL and a HTTP status code provided, then continue
	    elseif ($data !== NULL)
	    {
	      $output = json_encode($data);  
	    }

	    // If not greater than zero, then set the HTTP status code as 200 by default
	    // Though perhaps 500 should be set instead, for the developer not passing a
	    // correct HTTP status code
	    $http_code > 0 || $http_code = 200;

	    set_status_header($http_code);

	    exit($output);
	}

    public function removeParam($param, $remove ='__')
    {   
        if (is_array($remove)) {
            foreach ($remove as $value) {
                if(isset($param[$value])) {
                    unset($param[$value]);
                }
            }
            return $param;
        }

        if(isset($param[$remove])) {
            unset($param[$remove]);
        }

        return $param;
    }

    public function cetak($view='')
    {
        if ($view != '') {
            $this->load->view($view, $this->data);
        }
    }

}

class User_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');

        if (! $this->ion_auth->logged_in()){
            redirect('/','refresh');
        }



        if (! $this->session->has_userdata('tahun')) {
            $this->setSessionTahun();
        }

        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['tahun'] = $this->session->userdata('tahun');
        $this->data['tahunkey'] = getTahunKey($this->session->userdata('tahun'));
        $this->data['list_renstra'] = list_renstra();
        if ($this->ion_auth->is_admin())
        {
            $this->data['user']->unit = 'ALL';
        }
    }


    public function setSessionTahun($tahun = 2018)
    {
        $dt = $this->db->select('renstra_1,renstra_2,renstra_3,renstra_4,renstra_5')->get('master_renstra')->row_array();
        $valid = in_array($tahun, $dt);

        if ($valid) {
            $this->session->set_userdata('tahun', $tahun);
        }
    }
}

class Admin_Controller extends User_Controller
{
	public function __construct()
	{
	 	parent::__construct();
	 	if (!$this->ion_auth->is_admin())
        {
            redirect('/');
        }

        $this->data['user']->unit = NULL;
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
