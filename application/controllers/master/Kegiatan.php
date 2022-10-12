<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kegiatan_m');

        $this->data['page_title'] = 'Master Data kegiatan';
        $this->data['window_title'] = 'Master Data kegiatan';
    }
    public function index()
    {

        $data = $this->kegiatan_m->getFilter(['tahun'=>$this->session->userdata('tahun')]);

        $data = array_map(function($x){
            $x['aksi']  = Widget::dropdownAction('master/kegiatan', ['kode_urusan'=>$x['kode_urusan'],'kode_bidang'=>$x['kode_bidang'],'kode_program'=>$x['kode_program'],'kode_kegiatan'=>$x['kode_kegiatan']], ['edit','delete']);
            return $x;
        }, $data);

        $this->data['data'] = $data;
        $this->render('master/kegiatan/list');
    }

    public function add()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();

            if (intval($param['kode_urusan']) > 0 && intval($param['kode_bidang']) > 0 && intval($param['kode_program']) > 0 && intval($param['kode_kegiatan']) > 0)  {
                
                if ($this->kegiatan_m->add($param)) { 
                    $this->session->set_flashdata('status_input', 'Sukses Tambah Data');
                    redirect('master/kegiatan','refresh');
                }
            }

            $this->data['data'] = $this->input->post();
            $this->data['data']['form_error'] = 'Kode Rekening Sudah Terdaftar !! silahkan menggunakan Kode yang lain';
            
            $this->render('master/kegiatan/add');

        } else {

            $this->data['data']['kode_urusan'] = '';
            $this->data['data']['kode_bidang'] = '';
            $this->data['data']['kode_program'] = '';
            $this->data['data']['kode_kegiatan'] = '';
            $this->data['data']['nama_kegiatan'] = '';
            $this->render('master/kegiatan/add');
        }
  
    }

    public function edit()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->kegiatan_m->update($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Update Data');
                redirect('master/kegiatan','refresh');
            }
            $this->data['data'] = $this->input->post();
            $this->session->set_flashdata('status_input', 'Terjadi Kesalahan');
            $this->render('master/kegiatan/edit');

        } else {
            
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->kegiatan_m->get($param);

            if (count($this->data['data']) == 0) {
                redirect('master/kegiatan','refresh');
            }

            $this->render('master/kegiatan/edit');
        }
  
    }

    public function delete()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->kegiatan_m->delete($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Hapus Data');
                redirect('master/kegiatan','refresh');
            }
            $this->session->set_flashdata('status_input', 'Gagal Hapus Data');
            redirect('master/kegiatan','refresh');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->kegiatan_m->get($param);

            if (count($this->data['data']) == 0) {
                
                redirect('master/kegiatan','refresh');
            }

            $this->render('master/kegiatan/delete');
        }
    }

}

/* End of file kegiatan.php */
/* Location: ./application/controllers/master/kegiatan.php */
