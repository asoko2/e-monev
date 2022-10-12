<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urusan_m extends MY_Model {

    public $table = 'master_urusan';
    public $key = ['kode_urusan'];
    public $field = ['nama_urusan'];

    public function __construct()
    {
        parent::__construct();
    }

}

/* End of file Urusan_m.php */
/* Location: ./application/models/Urusan_m.php */
