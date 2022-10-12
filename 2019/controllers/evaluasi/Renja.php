<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Renja extends User_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Data Renja';
        $this->data['window_title'] = 'Data Renja';

        $this->load->helper('form');

        $this->load->model('dpa_kegiatan_m');
    }

    public function target()
    {
         $this->data['page_title'] = 'Data Target Renja';
        $this->data['window_title'] = 'Data Target Renja';
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

            $kegiatan = $this->db->get('vv_target_renja')->result_array();

            $program_id = array_unique(array_map(function($x){
                return $x['program_id'];
            }, $kegiatan));

            $kegiatan_id = array_unique(array_map(function($x){
                return $x['kegiatan_id'];
            }, $kegiatan));

            $indikator_capaian = [];
            $indikator_keluaran = [];

            if (count($kegiatan) > 0) {
                $indikator_capaian = $this->db->where_in('program_id', $program_id)
                                    ->get('kegiatan_capaian')
                                    ->result_array();

                $indikator_keluaran = $this->db->where_in('kegiatan_id', $kegiatan_id)
                                    ->get('kegiatan_keluaran')
                                    ->result_array();
            }
            
            $kegiatan = array_map(function($x){
                $x['kode_subunit'] = kode_subunit($x);
                $x['kode_kegiatan'] = kode_kegiatan($x);
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
            $this->data['indikator_keluaran'] = $indikator_keluaran;
            $this->render('evaluasi/renja/target');


        } else {
            $this->data['data'] =[];
            $this->render('evaluasi/renja/target');
        }

    }

    public function realisasi()
    {
        $this->data['page_title'] = 'Data Realisasi Renja';
        $this->data['window_title'] = 'Data Realisasi Renja';
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

            $kegiatan = $this->db->get('vv_target_renja')->result_array();

            $program_id = array_unique(array_map(function($x){
                return $x['program_id'];
            }, $kegiatan));

            $kegiatan_id = array_unique(array_map(function($x){
                return $x['kegiatan_id'];
            }, $kegiatan));

            $indikator_capaian = [];
            $indikator_keluaran = [];

            if (count($kegiatan) > 0) {
                $indikator_capaian = $this->db->where_in('program_id', $program_id)
                                    ->get('kegiatan_capaian')
                                    ->result_array();

                $indikator_keluaran = $this->db->where_in('kegiatan_id', $kegiatan_id)
                                    ->get('kegiatan_keluaran')
                                    ->result_array();
            }
            
            $kegiatan = array_map(function($x){
                $x['kode_subunit'] = kode_subunit($x);
                $x['kode_kegiatan'] = kode_kegiatan($x);
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
            $this->data['indikator_keluaran'] = $indikator_keluaran;
            $this->render('evaluasi/renja/realisasi');


        } else {
             $this->data['data'] = [];
             $this->render('evaluasi/renja/realisasi');
        }

    }

    public function upload()
    {
        $this->data['page_title'] = 'Data Realisasi Renja';
        $this->data['window_title'] = 'Data Realisasi Renja';
        $this->data['hash'] = '';
        $this->data['bhash'] = '';

        $id_indikator = $this->input->get('id');
        $this->db->select('
            program.kode_program,
            program.sasaran,
            master_program.nama_program,
            program.kode_urusan,
            program.kode_bidang,
            program.kode_subunit,
            program.kode_urusan1,
            program.kode_bidang1,
            program.kode_unit,
            kegiatan_capaian.*
        ');
        $this->db->where('kegiatan_capaian.id', $id_indikator);
        $this->db->join('program', 'kegiatan_capaian.program_id = program.id');
        $this->db->join('master_program', 'program.kode_urusan = master_program.kode_urusan AND program.kode_bidang = master_program.kode_bidang AND program.kode_program = master_program.kode_program');
        $data_rkpd = $this->db->get('kegiatan_capaian', 1)->row();
        if ($data_rkpd !== null) {
            $this->data['rkpd'] = $data_rkpd;
            // get data data pendukung
            $this->db->where('id', $data_rkpd->id);
            $this->db->where('tahun_ke', $this->data['tahunkey']);
            $pendukung = $this->db->get('data_pendukung', 1)->row();
             $this->data['pendukung'] = $pendukung;

            $this->render('evaluasi/renja/upload');
        }else{
            $this->data['data'] =[];
            $this->render('evaluasi/renja/upload');
        }
    	
    }

    public function data_pendukung()
    {
        $id = intval($this->input->post('id'));
        $tahun_ke = intval($this->input->post('tahun_ke'));
        $update = array(
            'id'       =>  $id,
            'tahun_ke' =>  $tahun_ke,
            'note_tw1' => $this->input->post('note_tw1'),
            'note_tw2' => $this->input->post('note_tw2'),
            'note_tw3' => $this->input->post('note_tw3'),
            'note_tw4' => $this->input->post('note_tw4')
        );

        $this->db->replace('data_pendukung', $update);

        header('Content-Type: application/json');

        // $this->session->set_flashdata('status_input', 'berhasil menambahkan faktor penghambat');
        $this->response(['status'=>true],200);  

    }

}

/* End of file Dpa.php */
/* Location: ./application/controllers/evaluasi/Dpa.php */
