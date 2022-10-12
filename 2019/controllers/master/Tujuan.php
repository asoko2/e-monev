<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tujuan extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tujuan_m');
		$this->data['page_title'] = 'Master Data Tujuan';
        $this->data['window_title'] = 'Master Data tujuan';
	}


	public function index()
	{
		
		$data = array();
       	$this->load->model('jenisindikator_m');
       	// get indikator tujuan
       	foreach ($this->db->get('indikator_tujuan')->result() as $key => $value) {
       		$indikator [$value->kd_tujuan] [] = $value;
       	}

       	// get tujuan

       	foreach ($this->db->get('tujuan')->result() as $key => $value) {
       		$value->indikator = (isset($indikator[$value->kd_tujuan])) ? $indikator[$value->kd_tujuan] : array() ;
       		$tujuan [] = $value;
       	}

       	//Get misi
       	$misi = $this->db->get('master_misi')->result();

       	// jenis indikator
       	foreach ($this->jenisindikator_m->getAll() as $key => $value) {
            $d['value']   = $value['id'];
            $d['text']    = $value['uraian'];
            $jenis_indikator []  = $d;
        }

      	$data = array(
      		'misi'				=> $misi,
      		'tujuan'			=> $tujuan,
      		'jenis_indikator'	=> $jenis_indikator 
      	);

		$this->data['data'] = $data;

		$this->render('master/tujuan/list');


	}

	public function tambah_indikator($id = 0)
	{
		if ($id == 0) {
            $this->session->set_flashdata('status_add_indikator', 'Gagal menambah Indikator Capaian');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

        // get data tujuan
        $this->db->where('kd_tujuan', $id);
        $tujuan = $this->db->get('tujuan')->row();

        $this->db->insert('indikator_tujuan', [
			'kd_tujuan'			=> $tujuan->kd_tujuan,
			'kd_misi'			=> $tujuan->kd_misi,
			'id_visi'			=> $tujuan->kd_tujuan,
			'uraian'			=> 'Silahkan isi indikator',
			'satuan'			=> 'ubah satuan'
        ]);
         $this->session->set_flashdata('status_add_indikator', 'Sukses menambah Indikator Capaian');
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
}

/* End of file Tujuan.php */
/* Location: .//G/www/2020/bojonegoro/2020/controllers/master/Tujuan.php */