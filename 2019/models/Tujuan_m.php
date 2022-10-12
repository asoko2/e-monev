<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tujuan_m extends MY_Model {

	public $table = 'tujuan';
    public $key = ['kd_tujuan','kd_misi','id_visi'];
    public $field = ['nama_program'];

     public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		
	}

}

/* End of file Tujuan_m.php */
/* Location: .//G/www/2020/bojonegoro/2020/models/Tujuan_m.php */