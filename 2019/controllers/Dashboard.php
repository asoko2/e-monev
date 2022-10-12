<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends User_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

	public function index()
	{
        $this->session->set_userdata('modul', 'Dashboard');
		$this->render('backend/dashboard');
	}

	public function tahun($tahun = 2019)
	{
        $this->setSessionTahun($tahun);
		redirect('dashboard','refresh');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
