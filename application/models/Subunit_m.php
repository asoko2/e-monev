<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subunit_m extends MY_Model {

    public $table = 'master_subunit';
    public $key = ['kode_urusan','kode_bidang','kode_unit','kode_subunit'];
    public $field = ['nama_subunit'];

    public function __construct()
    {
        parent::__construct();
    }

}

/* End of file Subunit_m.php */
/* Location: ./application/models/Subunit_m.php */
