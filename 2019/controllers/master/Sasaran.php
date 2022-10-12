<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran extends Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('sasaran_m');

        $this->data['page_title'] = 'Master Data Sasaran';
        $this->data['window_title'] = 'Master Data Sasaran';
    }

	public function index()
	{
		$data = array();
        $data = $this->sasaran_m->getAll();
        $data = array_map(function($x){
            $x['aksi']  = Widget::dropdownAction('master/sasaran', ['kode_sasaran'=>$x['kode_sasaran']] , ['edit','delete']);
            return $x;
        }, $data);

		$this->data['data'] = $data;
        $this->render('master/sasaran/list');
	}

    public function add()
    {
        $data = array();
        $this->load->helper('form', 'url');
        
        if ($this->input->method() == 'post') {
           
            $param = $this->input->post();

            if (intval($param['kode_sasaran']) )  {
                
                if ($this->sasaran_m->add($param)) { 
                    $this->session->set_flashdata('status_input', 'Sukses Tambah Data');
                    redirect('master/sasaran','refresh');
                }
            }

            $this->data['data'] = $this->input->post();
            $this->data['data']['form_error'] = 'Kode Rekening Sudah Terdaftar !! silahkan menggunakan Kode yang lain';
            
            $this->render('master/sasaran/add');

        } else {

            $this->data['data']['kode_sasaran'] = '';
            $this->data['data']['uraian'] = '';
            $this->render('master/sasaran/add');
        }

        
    }

    public function edit()
    {
        $this->load->helper('form', 'url');
        $data = array();

 
        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->sasaran_m->update($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Update Data');
                redirect('master/sasaran','refresh');
            }
            $this->data['data'] = $this->input->post();
            $this->session->set_flashdata('status_input', 'Terjadi Kesalahan');
            $this->render('master/sasaran/edit');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->sasaran_m->get($param);

            if (count($this->data['data']) == 0) {
                redirect('master/sasaran','refresh');
            }

            $this->render('master/sasaran/edit');
        }
  
    }

    public function delete($value='')
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->sasaran_m->delete($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Hapus Data');
                redirect('master/sasaran','refresh');
            }
            $this->session->set_flashdata('status_input', 'Gagal Hapus Data');
            redirect('master/sasaran','refresh');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->sasaran_m->get($param);

            if (count($this->data['data']) == 0) {
                
                redirect('master/sasaran','refresh');
            }

            $this->render('master/sasaran/delete');
        }
    }

}

/* End of file Sasaran.php */
/* Location: .//G/www/2020/bojonegoro/2020/controllers/master/Sasaran.php */