<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rpjm extends User_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Data Renstra';
        $this->data['window_title'] = 'Data Renstra';

        $this->load->helper('form');

        $this->load->model('dpa_kegiatan_m');
    }

    public function index()
    {
        $this->data['hash'] = '';
        $this->data['bhash'] = '';
        if ($this->input->get('hash')) {
            $hash = base64_decode($this->input->get('hash'));

            $kode = explode('.', $hash);
            
            
            $hashs = implode('.', [$kode[0],$kode[1],$kode[2],$kode[3]]);
            $this->data['hash'] = $hashs;
            $this->data['bhash'] = base64_encode($hashs);

            
            $this->db->where('kode_urusan', $kode[0]);
            $this->db->where('kode_bidang', $kode[1]);
            $this->db->where('kode_unit', $kode[2]);
            $this->db->where('kode_subunit', $kode[3]);

            $kegiatan = $this->db->where('is_rpjm',1)->get('vv_target_rpjm')->result_array();

            $program_id = array_unique(array_map(function($x){
                return $x['program_id'];
            }, $kegiatan));

            $indikator_capaian = [];

            if (count($kegiatan) > 0) {
                $indikator_capaian = $this->db->where_in('program_id', $program_id)
                                    ->get('kegiatan_capaian')
                                    ->result_array();
            }
            
            $kegiatan = array_map(function($x){
                $x['kode_subunit'] = kode_subunit($x);
                $x['kode_program'] = kode_program($x);
                $x['kode_bidang'] = kode_bidang($x);
            return $x;
            }, $kegiatan);

            $kegiatan = array_group_by_x($kegiatan, 
                        'kode_urusan1|nama_urusan', 
                        'kode_bidang1|nama_bidang',
                        'kode_program|nama_program|program_id'
                    );
            // var_dump ($kegiatan);
            // die();

            $this->data['data'] = $kegiatan;
            $this->data['indikator_capaian'] = $indikator_capaian;
            $this->render('evaluasi/rpjm/list');


        } else {
            $this->data['data'] =[];
            $this->render('evaluasi/rpjm/list');
        }

    }

   
    public function tambah($hash = '')
    {
        if ($hash == '')
            redirect('evaluasi/rpjm','refresh');

        $bhash = $hash;
        $hash = base64_decode($hash);
        $kode = explode('.', $hash);

        $this->db->where('kode_urusan', $kode[0]);
        $this->db->where('kode_bidang', $kode[1]);
        $this->db->where('kode_unit', $kode[2]);
        $this->db->where('kode_subunit', $kode[3]);

        $kegiatan = $this->db->get('vv_rpjm_belum_diambil')->result_array();

        foreach ($kegiatan as $k=>$v) {
            if ($v['kode_program'] > 14)
                continue;

            if (kode_bidang($v) == kode_bidang_opd($v))
                continue;

            unset($kegiatan[$k]);
        }

        $kegiatan = array_map(function($x){
            $x['kode_subunit'] = kode_subunit($x);
            $x['kode_program'] = kode_program($x);
            $x['kode_bidang'] = kode_bidang($x);
        return $x;
        }, $kegiatan);

        $kegiatan = array_group_by_x($kegiatan, 
                    'kode_urusan1|nama_urusan', 
                    'kode_bidang1|nama_bidang'
                );
        // var_dump ($kegiatan);
        // die();
        $this->data['data'] = $kegiatan;
        $this->data['hash'] = $hash;

        $this->render('evaluasi/rpjm/add');

    }

   
    public function tambah_indikator_capaian($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('status_add_indikator', 'Gagal menambah Indikator Capaian');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

        $check = count($this->db->where('id', $id)->get('program')->result_array()) == 1? true :false;

        if ($check) {
            $this->db->insert('kegiatan_capaian', [
                'program_id' => $id,
                'indikator' => 'silahkan di isi indikator',
                'satuan' => 'ubahsatuan'
            ]);
        }

        $this->session->set_flashdata('status_add_indikator', 'Sukses menambah Indikator Capaian');
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

   
    public function hapus_indikator_capaian($id = 0)
    {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

        $check = count($this->db->where('id', $id)->get('kegiatan_capaian')->result_array()) == 1? true :false;

        if ($check) {
            $this->db->where('id', $id)->delete('kegiatan_capaian');
        }

        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

   
    public function hapus_indikator_keluaran($id = 0)
    {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

        $check = count($this->db->where('id', $id)->get('kegiatan_keluaran')->result_array()) == 1? true :false;

        if ($check) {
            $this->db->where('id', $id)->delete('kegiatan_keluaran');
        }

        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

   
    public function tambah_indikator_keluaran($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('status_add_indikator', 'Gagal menambah Indikator Keluaran');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $check = count($this->db->where('id', $id)->get('kegiatan')->result_array()) == 1? true :false;

        if ($check) {
            $this->db->insert('kegiatan_keluaran', [
                'kegiatan_id' => $id,
                'indikator' => 'silahkan di isi indikator',
                'satuan' => 'ubahsatuan'
            ]);
        }

        $this->session->set_flashdata('status_add_indikator', 'Sukses menambah Indikator Keluaran');
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function tambah_kegiatan()
    {
        $post = $this->input->post();
        // echo "<pre>";
        // print_r($post);
        // die();

        if (isset($post)) {
            $sub = $post['kode_subunit'];
            unset($post['kode_subunit']);

            $subunit = explode('.', $sub);
           
            $next = [];
            foreach ($post as $key => $dd) {
                $p = explode('_', $key);
                if ($dd > 0) {
                    $this->db->where('id', $dd)->update('program', ['is_rpjm'=>1]);
                } else {
                    $this->db->insert('program', [
                        'kode_urusan' => $subunit[0],
                        'kode_bidang' => $subunit[1],
                        'kode_unit' => $subunit[2],
                        'kode_subunit' => $subunit[3],
                        'kode_urusan1' => $p[0],
                        'kode_bidang1' => $p[1],
                        'kode_program' => $p[2],
                        'sasaran' => 'isian sasaran',
                        'is_rpjm' => 1
                    ]);
                    
                }
            }
            
            redirect('evaluasi/rpjm?hash=' .base64_encode($post['kode_subunit']),'refresh');
        }
        redirect('evaluasi/rpjm/tambah/' .base64_encode($post['kode_subunit']),'refresh');

    }

    public function ubah_pagu()
    {
        
        var_dump($this->input->post());
    }
    public function hapus_program($kode)
    {
        $this->db->where('id', $kode);   
        $this->db->update('program', ['is_rpjm'=>0]);
        redirect($_SERVER['HTTP_REFERER'],'refresh');
        
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



    public function perm()
    {
        $data = [];
        $perm = ['rentsra_kegiatan','renstra_capaian','renstra_keluaran'];
        $perms = [
            'capaian','kegiatan','keluaran'
        ];

        foreach ($perm as $v) {
            array_push($data, [
                'm_key' => $v . '_add',
                'm_val' => 'aktif',
                'm_desc' => strtoupper('tambah ' . str_replace('_', ' ', $v))
            ]);
            array_push($data, [
                'm_key' => $v . '_edit',
                'm_val' => 'aktif',
                'm_desc' => strtoupper('ubah ' . str_replace('_', ' ', $v))
            ]);
            array_push($data, [
                'm_key' => $v . '_delete',
                'm_val' => 'aktif',
                'm_desc' => strtoupper('hapus ' . str_replace('_', ' ', $v))
            ]);
        }

        foreach ($perms as $v) {
            array_push($data, [
                'm_key' => $v . '_add',
                'm_val' => 1,
                'm_desc' => strtoupper('tambah ' . str_replace('_', ' ', $v))
            ]);
            array_push($data, [
                'm_key' => $v . '_edit',
                'm_val' => 1,
                'm_desc' => strtoupper('ubah ' . str_replace('_', ' ', $v))
            ]);
            array_push($data, [
                'm_key' => $v . '_delete',
                'm_val' => 1,
                'm_desc' => strtoupper('hapus ' . str_replace('_', ' ', $v))
            ]);
        }
    }
}

/* End of file Dpa.php */
/* Location: ./application/controllers/evaluasi/Dpa.php */
