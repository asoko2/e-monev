<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capaian_m extends MY_Model {

    public $table = 'dpa_kegiatan_capaian';
    public $key = ['tahun','kode_urusan','kode_bidang','kode_unit','kode_subunit','kode_urusan1','kode_bidang1','kode_program','urut'];
    public $field = ['indikator', 'satuan', 'target_renstra', 'target_b1', 'target_b2', 'target_b3', 'target_b4', 'target_b5', 'target_b6', 'target_b7', 'target_b8', 'target_b9', 'target_b10', 'target_b11', 'target_b12', 'realisasi_renstra', 'realisasi_b1', 'realisasi_b2', 'realisasi_b3', 'realisasi_b4', 'realisasi_b5', 'realisasi_b6', 'realisasi_b7', 'realisasi_b8', 'realisasi_b9', 'realisasi_b10', 'realisasi_b11', 'realisasi_b12', 'status_renstra', 'status_b1', 'status_b2', 'status_b3', 'status_b4', 'status_b5', 'status_b6', 'status_b7', 'status_b8', 'status_b9', 'status_b10', 'status_b11', 'status_b12'];

    public function __construct()
    {
        parent::__construct();
    }

    public function updateField($kode,$update = [])
    {
        if (count($kode) != 8) {
            return false;
        }
        if (empty($update)) {
            return false;
        }
        $param = $update;
        $param['tahun'] = $this->session->userdata('tahun');
        $param['kode_urusan'] = $kode[0]; 
        $param['kode_bidang'] = $kode[1]; 
        $param['kode_unit'] = $kode[2]; 
        $param['kode_subunit'] = $kode[3];
        $param['kode_urusan1'] = $kode[4]; 
        $param['kode_bidang1'] = $kode[5]; 
        $param['kode_program'] = $kode[6]; 
        $param['urut'] = $kode[7];
        
        return $this->update($param);
    }

}

/* End of file Capaian_m.php */
/* Location: ./application/models/Capaian_m.php */
