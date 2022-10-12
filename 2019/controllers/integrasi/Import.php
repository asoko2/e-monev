<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	public function index()
	{
		
	}

	public function anggaran_realisasi()
	{
		$this->db->select("*,(SELECT cek_subunit.`procedure` FROM cek_subunit WHERE	cek_subunit.kd_sub_opd = concat(vv_target_renja.kode_urusan,'.',vv_target_renja.kode_bidang,'.',vv_target_renja.kode_unit,'.',vv_target_renja.kode_subunit)) as sub_or_not, 
			concat(vv_target_renja.kode_urusan,'.',vv_target_renja.kode_bidang,'.',vv_target_renja.kode_unit,'.',vv_target_renja.kode_subunit) as kd_sub
			");
		// $this->db->where('`kode_urusan`', 4);
		// $this->db->where('`kode_bidang`', 1);
		// $this->db->where('`kode_unit`', 3);
		foreach ($this->db->get('vv_target_renja')->result() as $key => $value) {
			
			
			if ($value->sub_or_not == 1) {
				$this->anggaran_realisasi_server_subunit($value);
			} else {
				$this->anggaran_realisasi_server_opd($value);
			}
			
		}
	}

	protected function anggaran_realisasi_server_opd($value)
	{
		$tgl_range_awal = array();
		$tgl_range_akhir = array();
		$headers = array('Accept' => 'application/json', 'X-API-KEY' => 'ffe77c534abb7c3e8d82fa90845e2e3109eb5d5e');

		$tgl_range_awal = array('2020-01-01','2020-04-01','2020-07-01','2020-10-01');
		$tgl_range_akhir = array('2020-03-31','2020-06-30','2020-10-31','2020-12-31');


		
		$tahun_ke = 2;
		$tahun = 2020;
		

		$detail = array();
		
		

		
		$kd_urusan 		= $value->kode_urusan;
		$kd_bidang 		= $value->kode_bidang;
		$kd_unit 		= $value->kode_unit;
		$kd_subunit 		= $value->kode_subunit;
		$kd_urusan1 	= $value->kode_urusan1;
		$kd_bidang1 	= $value->kode_bidang1;
		$kd_program 	= $value->kode_program;
		$kd_kegiatan 	= $value->kode_kegiatan;

		$kd_rekening = $kd_urusan1.'.'.$kd_bidang1.'.'.$kd_program.'.'.$kd_kegiatan;
		$detail [] = array(
			'nama_kegiatan'	=> $value->nama_kegiatan
		);

		foreach ($tgl_range_awal as $key_tgl => $tgl_awal) {
			try {
		   		$request = Requests::get('http://localhost/2020/integrasi/perbendaharaan/monev_serapan_sampai_dengan_sub_opd?Kd_Urusan='.$kd_urusan.'&Kd_Bidang='.$kd_bidang.'&Kd_Unit='.$kd_unit.'&Kd_Sub='.$kd_subunit.'&Kd_Urusan1='.$kd_urusan1.'&Kd_Bidang1='.$kd_bidang1.'&Kd_Program='.$kd_program.'&Kd_Kegiatan='.$kd_kegiatan.'&awal='.$tgl_awal.'&akhir='.$tgl_range_akhir[$key_tgl] , $headers);
			} catch (Exception $e) {
				sleep(2);
				try {
			   		$request = Requests::get('http://localhost/2020/integrasi/perbendaharaan/monev_serapan_sampai_dengan_sub_opd?Kd_Urusan='.$kd_urusan.'&Kd_Bidang='.$kd_bidang.'&Kd_Unit='.$kd_unit.'&Kd_Sub='.$kd_subunit.'&Kd_Urusan1='.$kd_urusan1.'&Kd_Bidang1='.$kd_bidang1.'&Kd_Program='.$kd_program.'&Kd_Kegiatan='.$kd_kegiatan.'&awal='.$tgl_awal.'&akhir='.$tgl_range_akhir[$key_tgl] , $headers);
				} catch (Exception $e) {
					sleep(2);
					try {
				   		$request = Requests::get('http://localhost/2020/integrasi/perbendaharaan/monev_serapan_sampai_dengan_sub_opd?Kd_Urusan='.$kd_urusan.'&Kd_Bidang='.$kd_bidang.'&Kd_Unit='.$kd_unit.'&Kd_Sub='.$kd_subunit.'&Kd_Urusan1='.$kd_urusan1.'&Kd_Bidang1='.$kd_bidang1.'&Kd_Program='.$kd_program.'&Kd_Kegiatan='.$kd_kegiatan.'&awal='.$tgl_awal.'&akhir='.$tgl_range_akhir[$key_tgl] , $headers);
					} catch (Exception $e) {
						$this->output
			             	->set_content_type('application/json')
			             	->set_output(json_encode($e->getMessage()));
						die();
					}
				}
			}
			// var_dump ($request);
			// die();
			$data = json_decode($request->body);
			
			
			
			$update = array(
				'r_tahun_2_b'.($key_tgl + 5)	 => floatval($data->nilai)
			);

		
			

			$nilai = floatval($data->nilai);
			$this->db->where('id', $value->kegiatan_id);
			$this->db->update('kegiatan', $update);
			
			var_dump($this->db->last_query());
			echo "<br>";
			echo "\n";
			
		}
		
	
		$this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($detail));
		
	}

	protected function anggaran_realisasi_server_subunit($value)
	{
		
		$headers = array('Accept' => 'application/json', 'X-API-KEY' => 'ffe77c534abb7c3e8d82fa90845e2e3109eb5d5e');

		$tgl_range_awal = array('2020-01-01','2020-04-01','2020-07-01','2020-10-01');
		$tgl_range_akhir = array('2020-03-31','2020-06-30','2020-10-31','2020-12-31');


		
		$tahun_ke = 2;
		$tahun = 2020;
		

		$detail = array();


		$kd_urusan 		= $value->kode_urusan;
		$kd_bidang 		= $value->kode_bidang;
		$kd_unit 		= $value->kode_unit;
		$kd_sub_unit 	= $value->kode_subunit;
		$kd_urusan1 	= $value->kode_urusan1;
		$kd_bidang1 	= $value->kode_bidang1;
		$kd_program 	= $value->kode_program;
		$kd_kegiatan 	= $value->kode_kegiatan;


		$detail [] = array(
			'nama_kegiatan'	=> $value->nama_kegiatan
		);

		

		foreach ($tgl_range_awal as $key_tgl => $tgl_awal) {
			try {
		   		$request = Requests::get('http://localhost/2020/integrasi/perbendaharaan/monev_serapan_sampai_dengan_sub_opd?Kd_Sub='.$kd_sub_unit.'&Kd_Urusan='.$kd_urusan.'&Kd_Bidang='.$kd_bidang.'&Kd_Unit='.$kd_unit.'&Kd_Urusan1='.$kd_urusan1.'&Kd_Bidang1='.$kd_bidang1.'&Kd_Program='.$kd_program.'&Kd_Kegiatan='.$kd_kegiatan.'&awal='.$tgl_awal.'&akhir='.$tgl_range_akhir[$key_tgl] , $headers);
			} catch (Exception $e) {
				sleep(2);
				try {
			   		$request = Requests::get('http://localhost/2020/integrasi/perbendaharaan/monev_serapan_sampai_dengan_sub_opd?Kd_Sub='.$kd_sub_unit.'&Kd_Urusan='.$kd_urusan.'&Kd_Bidang='.$kd_bidang.'&Kd_Unit='.$kd_unit.'&Kd_Urusan1='.$kd_urusan1.'&Kd_Bidang1='.$kd_bidang1.'&Kd_Program='.$kd_program.'&Kd_Kegiatan='.$kd_kegiatan.'&awal='.$tgl_awal.'&akhir='.$tgl_range_akhir[$key_tgl] , $headers);
				} catch (Exception $e) {
					sleep(2);
					try {
				   		$request = Requests::get('http://localhost/2020/integrasi/perbendaharaan/monev_serapan_sampai_dengan_sub_opd?Kd_Sub='.$kd_sub_unit.'&Kd_Urusan='.$kd_urusan.'&Kd_Bidang='.$kd_bidang.'&Kd_Unit='.$kd_unit.'&Kd_Urusan1='.$kd_urusan1.'&Kd_Bidang1='.$kd_bidang1.'&Kd_Program='.$kd_program.'&Kd_Kegiatan='.$kd_kegiatan.'&awal='.$tgl_awal.'&akhir='.$tgl_range_akhir[$key_tgl] , $headers);
					} catch (Exception $e) {
						$this->output
		             	->set_content_type('application/json')
		             	->set_output(json_encode($e->getMessage()));
						die();
					}
				}
			}
			
			$data = json_decode($request->body);
			
			
			
			$update = array(
				'r_tahun_2_b'.($key_tgl + 5)	 => floatval($data->nilai)
			);

		
			

			$nilai = floatval($data->nilai);
			$this->db->where('id', $value->kegiatan_id);
			$this->db->update('kegiatan', $update);
			
			var_dump($this->db->last_query());
			echo "<br>";
			echo "\n";
		
		}

		$this->output
             	->set_content_type('application/json')
             	->set_output(json_encode($detail));
	}

}

/* End of file Import 2.php */
/* Location: .//C/Users/Fila/AppData/Local/Temp/fz3temp-2/Import 2.php */