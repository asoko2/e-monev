<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Urusan extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('urusan_m');

        $this->data['page_title'] = 'Master Data Urusan';
        $this->data['window_title'] = 'Master Data Urusan';
    }
    public function index()
    {

        $data = $this->urusan_m->getFilter(['tahun'=>$this->session->userdata('tahun')]);

        $data = array_map(function($x){
            $x['aksi']  = Widget::dropdownAction('master/urusan', ['kode_urusan'=>$x['kode_urusan']], ['edit','delete']);
            return $x;
        }, $data);

        $this->data['data'] = $data;
        $this->render('master/urusan/list');
    }

    public function add()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();

            if (intval($param['kode_urusan']) > 0)  {
                
                if ($this->urusan_m->add($param)) { 
                    $this->session->set_flashdata('status_input', 'Sukses Tambah Data');
                    redirect('master/urusan','refresh');
                }
            }

            $this->data['data'] = $this->input->post();
            $this->data['data']['form_error'] = 'Kode Rekening Sudah Terdaftar !! silahkan menggunakan Kode yang lain';
            
            $this->render('master/urusan/add');

        } else {

            $this->data['data']['kode_urusan'] = '';
            $this->data['data']['nama_urusan'] = '';
            $this->render('master/urusan/add');
        }
  
    }

    public function edit()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->urusan_m->update($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Update Data');
                redirect('master/urusan','refresh');
            }
            $this->data['data'] = $this->input->post();
            $this->session->set_flashdata('status_input', 'Terjadi Kesalahan');
            $this->render('master/urusan/edit');

        } else {
            
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->urusan_m->get($param);

            if (count($this->data['data']) == 0) {
                redirect('master/urusan','refresh');
            }

            $this->render('master/urusan/edit');
        }
  
    }

    public function delete()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
           
            if ($this->urusan_m->delete($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Hapus Data');
                redirect('master/urusan','refresh');
            }
            $this->session->set_flashdata('status_input', 'Gagal Hapus Data');
            redirect('master/urusan','refresh');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->urusan_m->get($param);

            if (count($this->data['data']) == 0) {
                
                redirect('master/urusan','refresh');
            }

            $this->render('master/urusan/delete');
        }
    }

}

/* End of file Urusan.php */
/* Location: ./application/controllers/master/Urusan.php */
