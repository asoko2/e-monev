<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permasalahan extends CI_Model {

	public function faktor($params)
	{
		$tw = $params['tw'];
		$sub_unit = $params['kode'];
		$tahun_key = $params['th'];

		$this->db->where('kode_subunit', $sub_unit);
		$this->db->where('tw', $tw);
		$this->db->where('tahun_key', $tahun_key);
		$data = $this->db->get('f_penghambat')->result();

		$penghambat = array();
		$next_tw = array();
		$next_rkpd = array();
		$pendorong = array();

		foreach ($data as $key => $element) {
			if ($element->penghambat != '' || $element->penghambat != null) {
                	$penghambat []= $element->penghambat;
            }

            if ($tw == 4) {
            	if ($element->tindak_lanjut != '' || isset($element->tindak_lanjut) == true) {
            		$next_rkpd [] = $element->tindak_lanjut;
            	}
            } else {
            	if ($element->tindak_lanjut != '' || isset($element->tindak_lanjut) == true) {
            		$next_tw [] = $element->tindak_lanjut;
            	}
            }
		}

		$this->db->where('kode_subunit', $sub_unit);
		$this->db->where('tw', $tw);
		$this->db->where('tahun_key', $tahun_key);
		$data = $this->db->get('f_pendorong')->result();

		foreach ($data as $key => $element) {
			if ($element->pendorong != '' || $element->penghambat != null) {
                	$pendorong []= $element->pendorong;
            }

           
		}

		$this->db->where('kode_subunit', $sub_unit);
		$this->db->where('tw', $tw);
		$this->db->where('tahun_key', $tahun_key);
		$data = $this->db->get('f_tindak_lanjut_tw')->result();

		foreach ($data as $key => $element) {
			if ($element->tindak_lanjut != '' || $element->tindak_lanjut != null) {
                	$next_tw []= $element->tindak_lanjut;
            }
           
		}

		$this->db->where('kode_subunit', $sub_unit);
		$this->db->where('tahun_key', $tahun_key);
		$data = $this->db->get('f_tindak_lanjut_rkpd')->result();

		foreach ($data as $key => $element) {
			if ($element->tindak_lanjut != '' || $element->tindak_lanjut != null) {
                	$next_rkpd []= $element->tindak_lanjut;
            }
           
		}

		
		$return = array(
			'penghambat'	=> $penghambat,
			'next_rkpd'		=> $next_rkpd,
			'next_tw'		=> $next_tw,
			'pendorong'		=> $pendorong
		);
		
		return $return;

	}

	

}

/* End of file Permasalahan.php */
/* Location: .//G/www/2019/bojonegoro/monev/app/models/Permasalahan.php */