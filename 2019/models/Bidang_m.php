<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang_m extends MY_Model {

    public $table = 'master_bidang';
    public $key = ['kode_urusan','kode_bidang'];
    public $field = ['nama_bidang'];

    public function __construct()
    {
        parent::__construct();
    }

}

/* End of file Bidang_m.php */
/* Location: ./application/models/Bidang_m.php */
