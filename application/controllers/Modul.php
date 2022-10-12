<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends User_Controller {

	public function administrasi()
	{
		$this->session->set_userdata('modul', 'Administrasi');
		$this->render('modul/administrasi');
	}

	public function master()
	{
		$this->session->set_userdata('modul', 'Master');
		$this->render('modul/master');
	}

    public function evaluasi()
    {
        $this->session->set_userdata('modul', 'Evaluasi');
        $this->render('modul/evaluasi');
    }

	public function penganggaran()
	{
		$this->session->set_userdata('modul', 'Penganggaran');
		$this->render('modul/penganggaran');
	}

}

/* End of file Modul.php */
/* Location: ./application/controllers/Modul.php */
