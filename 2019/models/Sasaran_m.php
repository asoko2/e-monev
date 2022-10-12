<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Sasaran_m extends MY_Model {
	
	public $table = 'master_sasaran';
    public $key = ['kode_sasaran'];
    public $field = ['uraian'];

    public function __construct()
    {
        parent::__construct();
    }
}

/* End of file Sasaran_m.php */
/* Location: .//G/www/2020/bojonegoro/2020/models/Sasaran_m.php */