<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_m extends MY_Model {

    public $table = 'master_kegiatan';
    public $key = ['kode_urusan','kode_bidang','kode_program','kode_kegiatan'];
    public $field = ['nama_kegiatan'];

    public function __construct()
    {
        parent::__construct();
    }

}

/* End of file Kegiatan_m.php */
/* Location: ./application/models/Kegiatan_m.php */
