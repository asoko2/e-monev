<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('bidang_m');

        $this->data['page_title'] = 'Master Data bidang';
        $this->data['window_title'] = 'Master Data bidang';
    }
    public function index()
    {

        $data = $this->bidang_m->getFilter(['tahun'=>$this->session->userdata('tahun')]);

        $data = array_map(function($x){
            $x['aksi']  = Widget::dropdownAction('master/bidang', ['kode_urusan'=>$x['kode_urusan'],'kode_bidang'=>$x['kode_bidang']], ['edit','delete']);
            return $x;
        }, $data);

        $this->data['data'] = $data;
        $this->render('master/bidang/list');
    }

    public function add()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();

            if (intval($param['kode_urusan']) > 0 && intval($param['kode_bidang']) > 0)  {
                if ($this->bidang_m->add($param)) { 
                    $this->session->set_flashdata('status_input', 'Sukses Tambah Data');
                    redirect('master/bidang','refresh');
                }
            }

            $this->data['data'] = $this->input->post();
            $this->data['data']['form_error'] = 'Kode Rekening Sudah Terdaftar !! silahkan menggunakan Kode yang lain';
            
            $this->render('master/bidang/add');

        } else {

            $this->data['data']['kode_urusan'] = '';
            $this->data['data']['kode_bidang'] = '';
            $this->data['data']['nama_bidang'] = '';
            $this->render('master/bidang/add');
        }
  
    }

    public function edit()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->bidang_m->update($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Update Data');
                redirect('master/bidang','refresh');
            }
            $this->data['data'] = $this->input->post();
            $this->session->set_flashdata('status_input', 'Terjadi Kesalahan');
            $this->render('master/bidang/edit');

        } else {
            
            
            $param =  $this->removeParam($this->input->get(),'__');

           $this->data['data'] = $this->bidang_m->get($param);

            if (count($this->data['data']) == 0) {
                redirect('master/bidang','refresh');
            }

            $this->render('master/bidang/edit');
        }
  
    }

    public function delete()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
           
            if ($this->bidang_m->delete($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Hapus Data');
                redirect('master/bidang','refresh');
            }
            $this->session->set_flashdata('status_input', 'Gagal Hapus Data');
            redirect('master/bidang','refresh');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->bidang_m->get($param);

            if (count($this->data['data']) == 0) {
                
                redirect('master/bidang','refresh');
            }

            $this->render('master/bidang/delete');
        }
    }

}

/* End of file Bidang.php */
/* Location: ./application/controllers/master/Bidang.php */
