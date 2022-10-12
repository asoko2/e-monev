<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dpa extends User_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Data DPA';
        $this->data['window_title'] = 'Data DPA';

        $this->load->helper('form');

        $this->load->model('dpa_kegiatan_m');
    }

    public function index()
    {
        $this->data['hash'] = '';
        if ($this->input->get('hash')) {
            $hash = base64_decode($this->input->get('hash'));

            $kode = explode('.', $hash);
            
            
            $hashs = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);
            $this->data['hash'] = $hashs;

            $kegiatan = $this->dpa_kegiatan_m->daftarKegiatanKeuangan($kode);

            $data = array_map(function($x){
                $x['kode_kegiatan'] = kode_kegiatan($x);
                $x['kode_program'] = kode_program($x);
            return $x;
            }, $kegiatan);

            $this->data['data'] = array_group_by($data,'kode_program');
            $this->render('evaluasi/dpa/list');


        } else {
            $this->data['data'] =[];
            $this->render('evaluasi/dpa/list');
        }

    }

   
    public function tambah($hash = '')
    {
        if ($hash == '')
            redirect('evaluasi/dpa','refresh');

        $kode = explode('.', $hash);

        $data = $this->dpa_kegiatan_m->daftarKegiatan($kode);

        $diolah = array_map(function($x){
            $x['kode_kegiatan'] = kode_kegiatan($x);
            $x['kode_program'] = kode_program($x);
            return $x;
        }, $data);

        $this->data['data'] = array_group_by($diolah,'kode_program');
        $this->data['hash'] = $hash;

        $this->render('evaluasi/dpa/add');

    }

   
    public function tambah_indikator_program($hash = '')
    {
        if ($hash == '')
            redirect('evaluasi/dpa','refresh');

        if ($this->input->post('indikator') && $this->input->post('satuan')) {
            $this->load->model('capaian_m');

            $pk = explode('.', $hash);
            array_unshift($pk, $this->session->userdata('tahun'));
            $no_urut = $this->capaian_m->key;
            unset($no_urut[8]);
            $filter = array_combine($no_urut, $pk);
    
            $urut = $this->capaian_m->getFilter($filter);
            $last = 1;
            if (count($urut) > 0) {
                $last = $urut[count($urut)-1]['urut'] +1;
            }
            array_push($pk, $last);
            $data = array_combine($this->capaian_m->key, $pk);
            $data['indikator'] = $this->input->post('indikator');
            $data['satuan'] = $this->input->post('satuan');
            // var_dump ($data);
            // die();

            $this->capaian_m->add($data);
            $newhash = implode('.', [$pk[1],$pk[2],$pk[3],$pk[4]]);            
            redirect('evaluasi/dpa/indikator_program/'.$hash.'/' .base64_encode($newhash),'refresh');
        }

        $this->data['program'] = base64_decode($this->input->get_post('__'));
        $this->data['hash'] = $hash;

        $this->render('evaluasi/dpa/add_indikator_capaian');

    }

   
    public function tambah_indikator_kegiatan($hash = '')
    {
        if ($hash == '')
            redirect('evaluasi/dpa','refresh');

        if ($this->input->post('indikator') && $this->input->post('satuan')) {
            $this->load->model('keluaran_m');

            $pk = explode('.', $hash);
            array_unshift($pk, $this->session->userdata('tahun'));
            $no_urut = $this->keluaran_m->key;
            unset($no_urut[9]);
            $filter = array_combine($no_urut, $pk);
    
            $urut = $this->keluaran_m->getFilter($filter);
            $last = 1;
            if (count($urut) > 0) {
                $last = $urut[count($urut)-1]['urut'] +1;
            }
            array_push($pk, $last);
            $data = array_combine($this->keluaran_m->key, $pk);
            $data['indikator'] = $this->input->post('indikator');
            $data['satuan'] = $this->input->post('satuan');
            

            $this->keluaran_m->add($data);
            $newhash = implode('.', [$pk[1],$pk[2],$pk[3],$pk[4]]);            
            redirect('evaluasi/dpa/indikator_kegiatan/'.$hash.'/' .base64_encode($newhash),'refresh');
        }

        $this->data['kegiatan'] = base64_decode($this->input->get_post('__'));
        $this->data['hash'] = $hash;

        $this->render('evaluasi/dpa/add_indikator');

    }

    public function tambah_kegiatan()
    {
        $post = $this->input->post();

        if (isset($post['kode'])) {
            $this->dpa_kegiatan_m->insertKegiatan($post['kode_subunit'],$post['kode']);

            redirect('evaluasi/dpa?hash=' .base64_encode($post['kode_subunit']),'refresh');
        }
        redirect('evaluasi/dpa/tambah/' .$post['kode_subunit'],'refresh');

    }

    public function ubah_pagu()
    {
        
        var_dump($this->input->post());
    }

    public function hapus_kegiatan($kode,$hash)
    {

        if (explode('hash=', $_SERVER['HTTP_REFERER'])[1] == $hash) {
            $pk = explode('.', $kode);
            array_unshift($pk, $this->session->userdata('tahun'));
            $data = array_combine($this->dpa_kegiatan_m->key, $pk);
           
            $this->dpa_kegiatan_m->delete($data);
            redirect($_SERVER['HTTP_REFERER'],'refresh');
        }
        else {
            redirect($_SERVER['HTTP_REFERER'],'refresh');
        }
    }

    public function hapus_indikator_kegiatan($kode,$hash)
    {
        $this->load->model('keluaran_m');
        
            $pk = explode('.', $kode);
            array_unshift($pk, $this->session->userdata('tahun'));
            $data = array_combine($this->keluaran_m->key, $pk);
           
            $this->keluaran_m->delete($data);
            redirect($_SERVER['HTTP_REFERER'],'refresh');
        
    }

    public function hapus_indikator_program($kode,$hash)
    {
        $this->load->model('capaian_m');
        
            $pk = explode('.', $kode);
            array_unshift($pk, $this->session->userdata('tahun'));
            $data = array_combine($this->capaian_m->key, $pk);
           
            $this->capaian_m->delete($data);
            redirect($_SERVER['HTTP_REFERER'],'refresh');
        
    }

    public function indikator_kegiatan($kode,$hash)
    {
        $this->load->model('keluaran_m');
        $this->load->model('kegiatan_m');
        if (strpos($kode, base64_decode($hash)) !== false) {
            $this->data['page_title'] = 'Indikator Keluaran Kegiatan';
            $this->data['window_title'] = 'Indikator Keluaran Kegiatan';

            $pk = explode('.', $kode);
            array_unshift($pk, $this->session->userdata('tahun'));
            $filter = array_combine($this->dpa_kegiatan_m->key, $pk);
            
            $data = $this->keluaran_m->getFilter($filter);

            $data = array_map(function($x){
                $kode_subunit = kode_subunit($x);
                $kode_kegiatan = kode_kegiatan($x);
                $x['pk'] = $kode_subunit . '.' .$kode_kegiatan . '.' .$x['urut'];
                return $x;
            }, $data);

            $this->data['hash'] = $hash;
            $this->data['data'] = $data;
            $this->data['kode'] = $kode;

            $this->data['kegiatan'] = $this->kegiatan_m->getFilter($filter)[0]['nama_kegiatan'];
            $this->render('evaluasi/dpa/indikator_keluaran');
        }
        else {
            redirect($_SERVER['HTTP_REFERER'],'refresh');
        }
    }

    public function indikator_program($kode,$hash)
    {
        $this->load->model('capaian_m');
        $this->load->model('program_m');
        if (strpos($kode, base64_decode($hash)) !== false) {
            $this->data['page_title'] = 'Indikator Capaian Program';
            $this->data['window_title'] = 'Indikator Capaian Program';

            $pk = explode('.', $kode);
            array_unshift($pk, $this->session->userdata('tahun'));

            $key = $this->capaian_m->key;
            unset($key[8]);

            $filter = array_combine($key, $pk);
            
            $data = $this->capaian_m->getFilter($filter);

            $data = array_map(function($x){
                $kode_subunit = kode_subunit($x);
                $kode_program = kode_program($x);
                $x['pk'] = $kode_subunit . '.' .$kode_program . '.' .$x['urut'];
                return $x;
            }, $data);

            $this->data['hash'] = $hash;
            $this->data['data'] = $data;
            $this->data['kode'] = $kode;

            $this->data['program'] = $this->program_m->getFilter($filter)[0]['nama_program'];
            $this->render('evaluasi/dpa/indikator_capaian');
        }
        else {
            redirect($_SERVER['HTTP_REFERER'],'refresh');
        }
    }
}

/* End of file Dpa.php */
/* Location: ./application/controllers/evaluasi/Dpa.php */
