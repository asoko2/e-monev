<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misi extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('misi_m');
		$this->data['page_title'] = 'Master Data Misi';
        $this->data['window_title'] = 'Master Data Misi';
	}

	public function index()
	{
		$data = array();
        $data = $this->misi_m->getAll();
        $data = array_map(function($x){
            $x['aksi']  = Widget::dropdownAction('master/misi', ['kd_misi'=>$x['kd_misi']] , ['edit','delete']);
            return $x;
        }, $data);

		$this->data['data'] = $data;
        $this->render('master/misi/list');
	}

	public function add()
    {
        $data = array();
        $this->load->helper('form', 'url');
        
        if ($this->input->method() == 'post') {
           
            $param = $this->input->post();

            if (intval($param['id']) )  {
                
                if ($this->misi_m->add($param)) { 
                    $this->session->set_flashdata('status_input', 'Sukses Tambah Data');
                    redirect('master/misi','refresh');
                }
            }

            $this->data['data'] = $this->input->post();
            $this->data['data']['form_error'] = 'Kode Rekening Sudah Terdaftar !! silahkan menggunakan Kode yang lain';
            
            $this->render('master/misi/add');

        } else {

            $this->data['data']['id'] = '';
            $this->data['data']['uraian'] = '';
            $this->render('master/misi/add');
        }

        
    }

    public function edit()
    {
        $this->load->helper('form', 'url');
        $data = array();

 
        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->misi_m->update($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Update Data');
                redirect('master/misi','refresh');
            }
            $this->data['data'] = $this->input->post();
            $this->session->set_flashdata('status_input', 'Terjadi Kesalahan');
            $this->render('master/misi/edit');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->misi_m->get($param);

            if (count($this->data['data']) == 0) {
                redirect('master/misi','refresh');
            }

            $this->render('master/misi/edit');
        }
  
    }

    public function delete($value='')
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->misi_m->delete($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Hapus Data');
                redirect('master/misi','refresh');
            }
            $this->session->set_flashdata('status_input', 'Gagal Hapus Data');
            redirect('master/misi','refresh');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->misi_m->get($param);

            if (count($this->data['data']) == 0) {
                
                redirect('master/misi','refresh');
            }

            $this->render('master/misi/delete');
        }
    }
}

/* End of file Misi.php */
/* Location: .//G/www/2020/bojonegoro/2020/controllers/master/Misi.php */