<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_m extends MY_Model {

    public $table = 'dpa_kegiatan_hasil';
    public $key = ['tahun','kode_urusan','kode_bidang','kode_unit','kode_subunit','kode_urusan1','kode_bidang1','kode_program','kode_kegiatan','urut'];
    public $field = ['indikator', 'satuan', 'target_renstra', 'target_b1', 'target_b2', 'target_b3', 'target_b4', 'target_b5', 'target_b6', 'target_b7', 'target_b8', 'target_b9', 'target_b10', 'target_b11', 'target_b12', 'realisasi_renstra', 'realisasi_b1', 'realisasi_b2', 'realisasi_b3', 'realisasi_b4', 'realisasi_b5', 'realisasi_b6', 'realisasi_b7', 'realisasi_b8', 'realisasi_b9', 'realisasi_b10', 'realisasi_b11', 'realisasi_b12', 'status_renstra', 'status_b1', 'status_b2', 'status_b3', 'status_b4', 'status_b5', 'status_b6', 'status_b7', 'status_b8', 'status_b9', 'status_b10', 'status_b11', 'status_b12'];

    public function __construct()
    {
        parent::__construct();
    }

}

/* End of file Hasil_m.php */
/* Location: ./application/models/Hasil_m.php */
