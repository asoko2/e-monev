<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends User_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Evaluasi Keuangan';
        $this->data['window_title'] = 'Evaluasi Keuangan';

        $this->load->helper('form');

        $this->load->model('dpa_kegiatan_m');
    }


    /**
     * 
     * @return void
     */
    public function index()
    {


        $this->data['hash'] = '';
        if ($this->input->get('hash')) {
            $hash = base64_decode($this->input->get('hash'));
            

            $this->load->model('input_m');
            $this->data['hash'] = $hash;
            $this->data['data'] = $this->input_m->buildLaporan($hash);
            $this->render('evaluasi/keuangan/list');
        } else {
            $this->data['data'] =[];
            $this->render('evaluasi/keuangan/list');
        }

    }

    /**
     * 
     * @return void
     */
    public function target()
    {

        $this->data['hash'] = '';
        if ($this->input->get('hash')) {
            
            $hash = base64_decode($this->input->get('hash'));
            $kode = explode('.', $hash);

            $this->load->model('input_m');
            $this->data['hash'] = $hash;
            $this->data['data'] = $this->input_m->dataKeuangan($hash);

            
            $this->render('evaluasi/keuangan/target');
        } else {
            $this->data['data'] =[];
            $this->render('evaluasi/keuangan/target');
        }

    }

    /**
     * 
     * @return void
     */
    public function realisasi()
    {
        $this->data['hash'] = '';
        if ($this->input->get('hash')) {
            $hash = base64_decode($this->input->get('hash'));
            

            $this->load->model('input_m');
            $this->data['hash'] = $hash;
            $this->data['data'] = $this->input_m->dataKeuangan($hash);

            $this->render('evaluasi/keuangan/realisasi');
        } else {
            $this->data['data'] =[];
            $this->render('evaluasi/keuangan/realisasi');
        }

    }

    /**
     * 
     * @return void
     */
    public function indikator()
    {

        $this->data['hash'] = '';
        if ($this->input->get('hash')) {
            $hash = base64_decode($this->input->get('hash'));
            

            $this->load->model('input_m');
            $this->data['hash'] = $hash;
            $this->data['data'] = $this->input_m->dataIndikator($hash);

            
            $this->render('evaluasi/keuangan/indikator');
        } else {
            $this->data['data'] =[];
            $this->render('evaluasi/keuangan/indikator');
        }

    }

    /**
     * 
     * @return void
     */
    public function realisasi_indikator()
    {

        $this->data['hash'] = '';
        if ($this->input->get('hash')) {
            $hash = base64_decode($this->input->get('hash'));
            

            $this->load->model('input_m');
            $this->data['hash'] = $hash;
            $this->data['data'] = $this->input_m->dataIndikator($hash);

            
            $this->render('evaluasi/keuangan/realisasi_indikator');
        } else {
            $this->data['data'] =[];
            $this->render('evaluasi/keuangan/realisasi_indikator');
        }

    }

}

/* End of file Keuangan.php */
/* Location: ./application/controllers/evaluasi/Keuangan.php */
