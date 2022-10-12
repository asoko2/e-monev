<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('unit_m');

        $this->data['page_title'] = 'Master Data unit';
        $this->data['window_title'] = 'Master Data unit';
    }
    public function index()
    {

        $data = $this->unit_m->getFilter(['tahun'=>$this->session->userdata('tahun')]);

        $data = array_map(function($x){
            $x['aksi']  = Widget::dropdownAction('master/unit', ['kode_urusan'=>$x['kode_urusan'],'kode_bidang'=>$x['kode_bidang'],'kode_unit'=>$x['kode_unit']], ['edit','delete']);
            return $x;
        }, $data);

        $this->data['data'] = $data;
        $this->render('master/unit/list');
    }

    public function add()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();

            if (intval($param['kode_urusan']) > 0 && intval($param['kode_bidang']) > 0 && intval($param['kode_unit']) > 0)  {
                
                if ($this->unit_m->add($param)) { 
                    $this->session->set_flashdata('status_input', 'Sukses Tambah Data');
                    redirect('master/unit','refresh');
                }
            }

            $this->data['data'] = $this->input->post();
            $this->data['data']['form_error'] = 'Kode Rekening Sudah Terdaftar !! silahkan menggunakan Kode yang lain';
            
            $this->render('master/unit/add');

        } else {

            $this->data['data']['kode_urusan'] = '';
            $this->data['data']['kode_bidang'] = '';
            $this->data['data']['kode_unit'] = '';
            $this->data['data']['nama_unit'] = '';
            $this->render('master/unit/add');
        }
  
    }

    public function edit()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->unit_m->update($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Update Data');
                redirect('master/unit','refresh');
            }
            $this->data['data'] = $this->input->post();
            $this->session->set_flashdata('status_input', 'Terjadi Kesalahan');
            $this->render('master/unit/edit');

        } else {
            
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->unit_m->get($param);

            if (count($this->data['data']) == 0) {
                redirect('master/unit','refresh');
            }

            $this->render('master/unit/edit');
        }
  
    }

    public function delete()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->unit_m->delete($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Hapus Data');
                redirect('master/unit','refresh');
            }
            $this->session->set_flashdata('status_input', 'Gagal Hapus Data');
            redirect('master/unit','refresh');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->unit_m->get($param);

            if (count($this->data['data']) == 0) {
                
                redirect('master/unit','refresh');
            }

            $this->render('master/unit/delete');
        }
    }

}

/* End of file unit.php */
/* Location: ./application/controllers/master/unit.php */
