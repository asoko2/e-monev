<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('program_m');

        $this->data['page_title'] = 'Master Data program';
        $this->data['window_title'] = 'Master Data program';
    }
    public function index()
    {

        $data = $this->program_m->getFilter(['tahun'=>$this->session->userdata('tahun')]);

        $data = array_map(function($x){
            $x['aksi']  = Widget::dropdownAction('master/program', 
                        ['kode_urusan'=>$x['kode_urusan']
                        ,'kode_bidang'=>$x['kode_bidang']
                        ,'kode_program'=>$x['kode_program']]
                        , ['edit','delete']);
            return $x;
        }, $data);

        $this->data['data'] = $data;
        $this->render('master/program/list');
    }

    public function add()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();

            if (intval($param['kode_urusan']) > 0 && intval($param['kode_bidang']) > 0 && intval($param['kode_program']) > 0)  {
                
                if ($this->program_m->add($param)) { 
                    $this->session->set_flashdata('status_input', 'Sukses Tambah Data');
                    redirect('master/program','refresh');
                }
            }

            $this->data['data'] = $this->input->post();
            $this->data['data']['form_error'] = 'Kode Rekening Sudah Terdaftar !! silahkan menggunakan Kode yang lain';
            
            $this->render('master/program/add');

        } else {

            $this->data['data']['kode_urusan'] = '';
            $this->data['data']['kode_bidang'] = '';
            $this->data['data']['kode_program'] = '';
            $this->data['data']['nama_program'] = '';
            $this->render('master/program/add');
        }
  
    }

    public function edit()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            
            if ($this->program_m->update($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Update Data');
                redirect('master/program','refresh');
            }
            $this->data['data'] = $this->input->post();
            $this->session->set_flashdata('status_input', 'Terjadi Kesalahan');
            $this->render('master/program/edit');

        } else {
            
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->program_m->get($param);

            if (count($this->data['data']) == 0) {
                redirect('master/program','refresh');
            }

            $this->render('master/program/edit');
        }
  
    }

    public function delete()
    {
        $this->load->helper('form', 'url');

        if ($this->input->method() == 'post') {
            
            $param = $this->input->post();
            if ($this->program_m->delete($param)) { 
                $this->session->set_flashdata('status_input', 'Sukses Hapus Data');
                redirect('master/program','refresh');
            }
            $this->session->set_flashdata('status_input', 'Gagal Hapus Data');
            redirect('master/program','refresh');

        } else {
            
            $param =  $this->removeParam($this->input->get(),'__');

            $this->data['data'] = $this->program_m->get($param);

            if (count($this->data['data']) == 0) {
                
                redirect('master/program','refresh');
            }

            $this->render('master/program/delete');
        }
    }

}

/* End of file Program.php */
/* Location: ./application/controllers/master/Program.php */
