<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenisindikator_m extends MY_Model {

	public $table = 'master_jenis_indikator';
    public $key = ['id'];
    public $field = ['uraian'];

    public function __construct()
    {
    	parent::__construct();
    	//Do your magic here
    }
}

/* End of file Jenisindikator_m.php */
/* Location: .//G/www/2020/bojonegoro/2020/models/Jenisindikator_m.php */