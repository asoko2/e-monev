<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Renja2 extends User_Controller {

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
echo "<pre>";            
var_dump ($kegiatan);
            die();

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
            $this->data['data'] =[];
            $this->render('evaluasi/renja/realisasi');
        }

    }

}

/* End of file Dpa.php */
/* Location: ./application/controllers/evaluasi/Dpa.php */
