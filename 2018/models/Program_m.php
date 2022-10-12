<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_m extends MY_Model {

    public $table = 'master_program';
    public $key = ['kode_urusan','kode_bidang','kode_program'];
    public $field = ['nama_program'];

    public function __construct()
    {
        parent::__construct();
    }

}

/* End of file Program_m.php */
/* Location: ./application/models/Program_m.php */
