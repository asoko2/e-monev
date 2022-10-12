<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subunit extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('subunit_m');

        $this->data['page_title'] = 'Master Data subunit';
        $this->data['window_title'] = 'Master Data subunit';
    }
    public function index()
    {

        $data = $this->subunit_m->getFilter(['tahun'=>$this->session->userdata('tahun')]);

        $data = array_map(function($x){
            $x['aksi']  = Widget::dropdownAction('master/subunit', ['kode_urusan'=>$x['kode_urusan'],'kode_bidang'=>$x['kode_bidang'],'kode_unit'=>$x['kode_unit'],'kode_subunit'=>$x['kode_subunit']], ['edit','delete']);
            return $x;
        }, $data);

        $this->data['data'] = $data;
        $this->render('master/subunit/list');
    }

    public function add()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();

            if (intval($param['kode_urusan']) > 0 && intval($param['kode_bidang']) > 0 && intval($param['kode_unit']) > 0 && intval($param['kode_subunit']) > 0)  {
                
                if ($this->subunit_m->add($param)) { 
                    $this->session->set_flashdata('status_input', 'Sukses Tambah Data');
                    redirect('master/subunit','refresh');
                }
            }

            $this->data['data'] = $this->input->post();
            $this->data['data']['form_error'] = 'Kode Rekening Sudah Terdaftar !! silahkan menggunakan Kode yang lain';
            
            $this->render('master/subunit/add');

        } else {

            $this->data['data']['kode_urusan'] = '';
            $this->data['data']['kode_bidang'] = '';
            $this->data['data']['kode_unit'] = '';
            $this->data['data']['kode_subunit'] = '';
            $this->data['data']['nama_subunit'] = '';
            $this->render('master/subunit/add');
        }
  
    }

    public function edit()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->subunit_m->update($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Update Data');
                redirect('master/subunit','refresh');
            }
            $this->data['data'] = $this->input->post();
            $this->session->set_flashdata('status_input', 'Terjadi Kesalahan');
            $this->render('master/subunit/edit');

        } else {
            
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->subunit_m->get($param);

            if (count($this->data['data']) == 0) {
                redirect('master/subunit','refresh');
            }

            $this->render('master/subunit/edit');
        }
  
    }

    public function delete()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->subunit_m->delete($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Hapus Data');
                redirect('master/subunit','refresh');
            }
            $this->session->set_flashdata('status_input', 'Gagal Hapus Data');
            redirect('master/subunit','refresh');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->subunit_m->get($param);

            if (count($this->data['data']) == 0) {
                
                redirect('master/subunit','refresh');
            }

            $this->render('master/subunit/delete');
        }
    }

}

/* End of file subunit.php */
/* Location: ./application/controllers/master/subunit.php */
