<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misi_m extends MY_Model {

	public $table = 'master_misi';
    public $key = ['id'];
    public $field = ['uraian'];

	public function __construct()
    {
        parent::__construct();
    }

}

/* End of file Misi_m.php */
/* Location: .//G/www/2020/bojonegoro/2020/models/Misi_m.php */