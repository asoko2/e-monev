<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visi extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('visi_m');
		$this->data['page_title'] = 'Master Data Visi';
        $this->data['window_title'] = 'Master Data Visi';
	}
	public function index()
	{
		 $data = $this->misi_m->getAll();
        $data = array_map(function($x){
            $x['aksi']  = Widget::dropdownAction('master/misi', ['id'=>$x['id']] , ['edit','delete']);
            return $x;
        }, $data);

		$this->data['data'] = $data;
        $this->render('master/misi/list');
	}

}

/* End of file Visi.php */
/* Location: .//G/www/2020/bojonegoro/2020/controllers/master/Visi.php */