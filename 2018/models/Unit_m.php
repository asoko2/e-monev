<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_m extends MY_Model {

    public $table = 'master_unit';
    public $key = ['kode_urusan','kode_bidang','kode_unit'];
    public $field = ['nama_unit'];

    public function __construct()
    {
        parent::__construct();
    }

}

/* End of file Unit_m.php */
/* Location: ./application/models/Unit_m.php */
