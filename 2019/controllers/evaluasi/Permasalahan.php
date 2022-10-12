<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permasalahan extends User_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->data['page_title'] = 'Permasalahan';
        $this->data['window_title'] = 'Permasalahan';

        $this->load->helper('form');

	}

	public function penghambat()
	{
		$this->data['hash'] = '';
		$this->data['bhash'] = '';

		 if ($this->input->get('hash')) {
		 	$hash = base64_decode($this->input->get('hash'));
		 	$tw = $this->input->get('tw');
		 	$this->data['tw'] = $tw;

            $kode = explode('.', $hash);
            $hashs = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);

            $unit = implode('.', [$kode[0],$kode[1],$kode[2]]);
       		$subunit = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);

            $this->data['hash'] = $hashs;
            $this->data['bhash'] = base64_encode($hashs);
            

            $this->db->where('kode_subunit', $subunit);
            $this->db->where('tw', $tw);
            $this->db->where('tahun_key', $this->data['tahunkey']);
            $data = $this->db->get('f_penghambat')->result();
           	$this->data['penghambat'] = $data;
            
            
		 	$this->render('evaluasi/permasalahan/penghambat');

		 }else{
		 	$this->render('evaluasi/permasalahan/penghambat');
		 }
	}

	public function add_penghambat()
	{
		$penghambat = $this->input->post('Penghambat');
		$triwulan = $this->input->post('Triwulan');
		$hash = $this->input->post('hash');
		$hash = base64_decode($hash);

		$kode = explode('.', $hash);

        $unit = implode('.', [$kode[0],$kode[1],$kode[2]]);
        $subunit = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);



		$insert = array(
			'kode_unit' 	=> $unit,
			'kode_subunit' 	=> $subunit,
			'tw' 			=> $triwulan,
			'tahun_key' 	=> $this->data['tahunkey'],
			'tahun' 		=> $this->data['tahun'],
			'penghambat' 	=> $penghambat,
			// 'tindak_lanjut' => $tindak_lanjut
		);

		$this->db->insert('f_penghambat', $insert);

		// var_dump ($this->db->last_query());
	

		header('Content-Type: application/json');

		// $this->session->set_flashdata('status_input', 'berhasil menambahkan faktor penghambat');
		$this->response(['status'=>true],200);  
	}


	public function update_penghambat()
	{
		$id = $this->input->post('pk');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		$update = array($name => $value);
		$this->db->where('id', $id);
		$this->db->update('f_penghambat', $update);
		$this->session->set_flashdata('status_input', 'berhasil menambahkan update data faktor penghambat');

		header('Content-Type: application/json');
		$this->response(['status'=>true],200);  

		
	}
	public function hapus_penghambat()
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('f_penghambat');

		$this->session->set_flashdata('status_input', 'berhasil menghapus data faktor penghambat');

		header('Content-Type: application/json');
		$this->response(['status'=>true],200);  
	}

	public function pendorong()
	{
		$this->data['hash'] = '';
		$this->data['bhash'] = '';

		$this->data['tw'] = 1;
		if ($this->input->get('hash')) {
		 	$hash = base64_decode($this->input->get('hash'));
		 	$tw = intval($this->input->get('tw'));
		 	
		 	$this->data['tw'] = $tw;

            $kode = explode('.', $hash);
            $hashs = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);

            $unit = implode('.', [$kode[0],$kode[1],$kode[2]]);
       		$subunit = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);

            $this->data['hash'] = $hashs;
            $this->data['bhash'] = base64_encode($hashs);
            

            $this->db->where('kode_subunit', $subunit);
            $this->db->where('tw', $tw);
            $this->db->where('tahun_key', $this->data['tahunkey']);
            $data = $this->db->get('f_pendorong')->result();
           	$this->data['pendorong'] = $data;
            
            
		 	$this->render('evaluasi/permasalahan/pendorong');

		}else{
			
		 	$this->render('evaluasi/permasalahan/pendorong');
		}


	}


	public function add_pendorong()
	{
		$penghambat = $this->input->post('Pendorong');
		$tindak_lanjut = $this->input->post('tindak_lanjut');
		$triwulan = $this->input->post('Triwulan');
		$hash = $this->input->post('hash');
		$hash = base64_decode($hash);

		$kode = explode('.', $hash);

        $unit = implode('.', [$kode[0],$kode[1],$kode[2]]);
        $subunit = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);



		$insert = array(
			'kode_unit' 	=> $unit,
			'kode_subunit' 	=> $subunit,
			'tw' 			=> $triwulan,
			'tahun_key' 	=> $this->data['tahunkey'],
			'tahun' 		=> $this->data['tahun'],
			'pendorong' 	=> $penghambat,
			// 'tindak_lanjut' => $tindak_lanjut
		);
		
		$this->db->insert('f_pendorong', $insert);

		header('Content-Type: application/json');

		$this->session->set_flashdata('status_input', 'berhasil menambahkan faktor penghambat');
		$this->response(['status'=>true],200);  
	}


	public function hapus_pendorong()
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('f_pendorong');

		$this->session->set_flashdata('status_input', 'berhasil menghapus data faktor Pendorong');

		header('Content-Type: application/json');
		$this->response(['status'=>true],200);  
	}

	public function update_pendorong()
	{
		$id = $this->input->post('pk');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		$update = array($name => $value);
		$this->db->where('id', $id);
		$this->db->update('f_pendorong', $update);
		$this->session->set_flashdata('status_input', 'berhasil menambahkan update data faktor penghambat');

		header('Content-Type: application/json');
		$this->response(['status'=>true],200);  

		
	}

	public function next_tw()
	{
		$this->data['hash'] = '';
		$this->data['bhash'] = '';

		 if ($this->input->get('hash')) {
		 	$hash = base64_decode($this->input->get('hash'));
		 	$tw = $this->input->get('tw');
		 	$this->data['tw'] = $tw;

            $kode = explode('.', $hash);
            $hashs = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);

            $unit = implode('.', [$kode[0],$kode[1],$kode[2]]);
       		$subunit = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);

            $this->data['hash'] = $hashs;
            $this->data['bhash'] = base64_encode($hashs);
            

            $this->db->where('kode_subunit', $subunit);
            $this->db->where('tw', $tw);
            $this->db->where('tahun_key', $this->data['tahunkey']);
            $data = $this->db->get('f_tindak_lanjut_tw')->result();
           	$this->data['next_tw'] = $data;
            
            
		 	$this->render('evaluasi/permasalahan/next_tw');

		 }else{
		 	$this->render('evaluasi/permasalahan/next_tw');
		 }
	}

	public function add_next_tw()
	{
		
		$tindak_lanjut = $this->input->post('tindak_lanjut');
		$triwulan = $this->input->post('Triwulan');
		$hash = $this->input->post('hash');
		$hash = base64_decode($hash);

		$kode = explode('.', $hash);

        $unit = implode('.', [$kode[0],$kode[1],$kode[2]]);
        $subunit = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);



		$insert = array(
			'kode_unit' 	=> $unit,
			'kode_subunit' 	=> $subunit,
			'tw' 			=> $triwulan,
			'tahun_key' 	=> $this->data['tahunkey'],
			'tahun' 		=> $this->data['tahun'],
			// 'pendorong' 	=> $penghambat,
			'tindak_lanjut' => $tindak_lanjut
		);
		
		$this->db->insert('f_tindak_lanjut_tw', $insert);

		header('Content-Type: application/json');

		$this->session->set_flashdata('status_input', 'berhasil menambahkan faktor tindak lanjut');
		$this->response(['status'=>true],200);  
	}


	public function hapus_next_tw()
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('f_tindak_lanjut_tw');

		$this->session->set_flashdata('status_input', 'berhasil menghapus data faktor tindak lanjut');

		header('Content-Type: application/json');
		$this->response(['status'=>true],200);  
	}

	public function update_next_tw()
	{
		$id = $this->input->post('pk');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		$update = array($name => $value);
		$this->db->where('id', $id);
		$this->db->update('f_tindak_lanjut_tw', $update);
		$this->session->set_flashdata('status_input', 'berhasil menambahkan update data faktor tindak lanjut');

		header('Content-Type: application/json');
		$this->response(['status'=>true],200);  

		
	}

	public function next_rkpd()
	{
		$this->data['hash'] = '';
		$this->data['bhash'] = '';

		 if ($this->input->get('hash')) {
		 	$hash = base64_decode($this->input->get('hash'));
		 	$tw = $this->input->get('tw');
		 	$this->data['tw'] = $tw;

            $kode = explode('.', $hash);
            $hashs = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);

            $unit = implode('.', [$kode[0],$kode[1],$kode[2]]);
       		$subunit = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);

            $this->data['hash'] = $hashs;
            $this->data['bhash'] = base64_encode($hashs);
            

            $this->db->where('kode_subunit', $subunit);
            $this->db->where('tahun_key', $this->data['tahunkey']);
            $data = $this->db->get('f_tindak_lanjut_rkpd')->result();
           	$this->data['next_tw'] = $data;
            
            
		 	$this->render('evaluasi/permasalahan/next_rkpd');

		 }else{
		 	$this->render('evaluasi/permasalahan/next_rkpd');
		 }
	}

	public function add_next_rkpd()
	{
		
		$tindak_lanjut = $this->input->post('tindak_lanjut');
		$triwulan = $this->input->post('Triwulan');
		$hash = $this->input->post('hash');
		$hash = base64_decode($hash);

		$kode = explode('.', $hash);

        $unit = implode('.', [$kode[0],$kode[1],$kode[2]]);
        $subunit = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);



		$insert = array(
			'kode_unit' 	=> $unit,
			'kode_subunit' 	=> $subunit,
			'tahun_key' 	=> $this->data['tahunkey'],
			'tahun' 		=> $this->data['tahun'],
			// 'pendorong' 	=> $penghambat,
			'tindak_lanjut' => $tindak_lanjut
		);
		
		$this->db->insert('f_tindak_lanjut_rkpd', $insert);

		header('Content-Type: application/json');

		$this->session->set_flashdata('status_input', 'berhasil menambahkan faktor tindak lanjut');
		$this->response(['status'=>true],200);  
	}


	public function hapus_next_rkpd()
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('f_tindak_lanjut_rkpd');

		$this->session->set_flashdata('status_input', 'berhasil menghapus data faktor tindak lanjut');

		header('Content-Type: application/json');
		$this->response(['status'=>true],200);  
	}

	public function update_next_rkpd()
	{
		$id = $this->input->post('pk');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		$update = array($name => $value);
		$this->db->where('id', $id);
		$this->db->update('f_tindak_lanjut_rkpd', $update);
		$this->session->set_flashdata('status_input', 'berhasil menambahkan update data faktor tindak lanjut');

		header('Content-Type: application/json');
		$this->response(['status'=>true],200);  

		
	}
}

/* End of file Permasalahan.php */
/* Location: .//G/www/2019/bojonegoro/monev/app/controllers/evaluasi/Permasalahan.php */