<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Keluaran extends User_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Data DPA';
        $this->data['window_title'] = 'Data DPA';

        $this->load->helper('form');

        $this->load->model('dpa_kegiatan_m');
    }


    /**
     * 
     * @return void
     */
    public function index()
    {
        $this->render('evaluasi/keluaran/list');
    }

}

/* End of file Keluaran.php */
/* Location: ./application/controllers/evaluasi/Keluaran.php */
