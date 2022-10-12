<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_m extends CI_Model {


    public function __construct()
    {
        parent::__construct();

    }

    public function dataKeuangan($kode)
    {
        $modelToLoad = ['keuangan_m'];
        $CI =& get_instance();
        $kodes = explode('.', $kode);
        $filter = ['kode_urusan'=>$kodes[0],'kode_bidang'=>$kodes[1],
                    'kode_unit'=>$kodes[2],'kode_subunit'=>$kodes[3]];
        foreach ($modelToLoad as $v) {
            $CI->load->model($v);
            $nm = str_replace('_m', '', $v);
            $data[$nm] = $CI->{$v}->getFilter($filter);

            if (count($data[$nm]) > 0) {
                $data[$nm] = array_map(function($x) use ($nm) {
                    
                    if ($nm == 'keuangan') {
                        $x['target_tw1'] = bulan_to_tribulan($x, 1, 'target');
                        $x['target_tw2'] = bulan_to_tribulan($x, 2, 'target');
                        $x['target_tw3'] = bulan_to_tribulan($x, 3, 'target');
                        $x['target_tw4'] = bulan_to_tribulan($x, 4, 'target');
                        $x['target_th'] = bulan_to_tribulan($x, 5, 'target');
                        $x['realisasi_tw1'] = bulan_to_tribulan($x, 1, 'realisasi');
                        $x['realisasi_tw2'] = bulan_to_tribulan($x, 2, 'realisasi');
                        $x['realisasi_tw3'] = bulan_to_tribulan($x, 3, 'realisasi');
                        $x['realisasi_tw4'] = bulan_to_tribulan($x, 4, 'realisasi');
                        $x['realisasi_th'] = bulan_to_tribulan($x, 5, 'realisasi');
                    }
                    return $x;
                }, $data[$nm]);
            }

        }

        $data['kegiatan'] = $this->_listKegiatan(array_values($filter));

        $data['kegiatan'] = array_map(function($x){

            $x['kode_subunit'] = kode_subunit($x);
            $x['kode_kegiatan'] = kode_kegiatan($x);
            $x['kode_program'] = kode_program($x);
            $x['kode_bidang'] = kode_bidang($x);
            $x['kode_urusan'] = kode_urusan($x);
            
            $x['pk'] = $x['kode_subunit'] . '.' . $x['kode_kegiatan'];
            
            return $x;
        },$data['kegiatan']);

        $data['keuangan'] = array_map(function($x){

            $x['kode_subunit'] = kode_subunit($x);
            $x['kode_kegiatan'] = kode_kegiatan($x);
            $x['kode_program'] = kode_program($x);
            $x['kode_bidang'] = kode_bidang($x);
            $x['kode_urusan'] = kode_urusan($x);
            
            $x['pk'] = $x['kode_subunit'] . '.' . $x['kode_kegiatan'];
            return $x;
        },$data['keuangan']);

        $data['kegiatan'] = array_group_by_x($data['kegiatan'], 'kode_urusan|nama_urusan', 'kode_bidang|nama_bidang', 'kode_program|nama_program');
        $data['keuangan'] = array_group_by($data['keuangan'], 'kode_kegiatan');

        return $data; 
    }

    public function dataIndikator($kode)
    {
        $modelToLoad = ['keluaran_m','capaian_m'];
        $CI =& get_instance();
        $kodes = explode('.', $kode);
        $filter = ['kode_urusan'=>$kodes[0],'kode_bidang'=>$kodes[1],
                    'kode_unit'=>$kodes[2],'kode_subunit'=>$kodes[3]];
        foreach ($modelToLoad as $v) {
            $CI->load->model($v);
            $nm = str_replace('_m', '', $v);
            $data[$nm] = $CI->{$v}->getFilter($filter);

            if (count($data[$nm]) > 0) {
                $data[$nm] = array_map(function($x){
                    $x['kode_subunit'] = kode_subunit($x);
                    if (isset($x['kode_kegiatan'])) {
                        $x['kode_kegiatan'] = kode_kegiatan($x);
                    }
                    $x['kode_program'] = kode_program($x);
                    $x['kode_bidang'] = kode_bidang($x);
                    $x['kode_urusan'] = kode_urusan($x);
                    $x['target_tw1'] = bulan_to_tribulan($x, 1, 'target');
                    $x['target_tw2'] = bulan_to_tribulan($x, 2, 'target');
                    $x['target_tw3'] = bulan_to_tribulan($x, 3, 'target');
                    $x['target_tw4'] = bulan_to_tribulan($x, 4, 'target');
                    $x['target_th'] = bulan_to_tribulan($x, 5, 'target');
                    $x['realisasi_tw1'] = bulan_to_tribulan($x, 1, 'realisasi');
                    $x['realisasi_tw2'] = bulan_to_tribulan($x, 2, 'realisasi');
                    $x['realisasi_tw3'] = bulan_to_tribulan($x, 3, 'realisasi');
                    $x['realisasi_tw4'] = bulan_to_tribulan($x, 4, 'realisasi');
                    $x['realisasi_th'] = bulan_to_tribulan($x, 5, 'realisasi');
                    return $x;
                }, $data[$nm]);

                if ($nm == 'keuangan') {
                    $data['keuangan_program'] = array_group_by($data[$nm], 'kode_program');
                }

                if ($nm == 'capaian') {
                    $data[$nm] = array_group_by($data[$nm], 'kode_program');
                }

                if ($nm == 'keluaran') {
                    $data[$nm] = array_group_by($data[$nm], 'kode_kegiatan');
                }
            }

        }

        $data['kegiatan'] = $this->_listKegiatan(array_values($filter));

        $data['kegiatan'] = array_map(function($x){

            $x['kode_subunit'] = kode_subunit($x);
            $x['kode_kegiatan'] = kode_kegiatan($x);
            $x['kode_program'] = kode_program($x);
            $x['kode_bidang'] = kode_bidang($x);
            $x['kode_urusan'] = kode_urusan($x);
            $x['pk'] = $x['kode_subunit'] . '.' . $x['kode_kegiatan'];
            $x['pkp'] = $x['kode_subunit'] . '.' . $x['kode_program'];
            return $x;
        },$data['kegiatan']);


        $data['kegiatan'] = array_group_by_x($data['kegiatan'], 'kode_urusan|nama_urusan', 'kode_bidang|nama_bidang', 'kode_program|nama_program');

        return $data; 
    }

    public function buildLaporan($kode)
    {
        $modelToLoad = ['keuangan_m','keluaran_m','capaian_m'];
        $CI =& get_instance();
        $kodes = explode('.', $kode);
        $filter = ['kode_urusan'=>$kodes[0],'kode_bidang'=>$kodes[1],
                    'kode_unit'=>$kodes[2],'kode_subunit'=>$kodes[3]];
        foreach ($modelToLoad as $v) {
            $CI->load->model($v);
            $nm = str_replace('_m', '', $v);
            $data[$nm] = $CI->{$v}->getFilter($filter);

            if (count($data[$nm]) > 0) {
                $data[$nm] = array_map(function($x){
                    $x['kode_subunit'] = kode_subunit($x);
                    if (isset($x['kode_kegiatan'])) {
                        $x['kode_kegiatan'] = kode_kegiatan($x);
                    }
                    $x['kode_program'] = kode_program($x);
                    $x['kode_bidang'] = kode_bidang($x);
                    $x['kode_urusan'] = kode_urusan($x);
                    $x['target_tw1'] = bulan_to_tribulan($x, 1, 'target');
                    $x['target_tw2'] = bulan_to_tribulan($x, 2, 'target');
                    $x['target_tw3'] = bulan_to_tribulan($x, 3, 'target');
                    $x['target_tw4'] = bulan_to_tribulan($x, 4, 'target');
                    $x['target_th'] = bulan_to_tribulan($x, 5, 'target');
                    $x['realisasi_tw1'] = bulan_to_tribulan($x, 1, 'realisasi');
                    $x['realisasi_tw2'] = bulan_to_tribulan($x, 2, 'realisasi');
                    $x['realisasi_tw3'] = bulan_to_tribulan($x, 3, 'realisasi');
                    $x['realisasi_tw4'] = bulan_to_tribulan($x, 4, 'realisasi');
                    $x['realisasi_th'] = bulan_to_tribulan($x, 5, 'realisasi');
                    return $x;
                }, $data[$nm]);

                if ($nm == 'keuangan') {
                    $data['keuangan_program'] = array_group_by($data[$nm], 'kode_program');
                }

                if ($nm == 'capaian') {
                    $data[$nm] = array_group_by($data[$nm], 'kode_program');
                }

                if ($nm == 'keluaran') {
                    $data[$nm] = array_group_by($data[$nm], 'kode_kegiatan');
                }
            }

        }

        $data['kegiatan'] = $this->_listKegiatan(array_values($filter));

        $data['kegiatan'] = array_map(function($x){

            $x['kode_subunit'] = kode_subunit($x);
            $x['kode_kegiatan'] = kode_kegiatan($x);
            $x['kode_program'] = kode_program($x);
            $x['kode_bidang'] = kode_bidang($x);
            $x['kode_urusan'] = kode_urusan($x);
            
            return $x;
        },$data['kegiatan']);

        $data['kegiatan'] = array_group_by_x($data['kegiatan'], 'kode_urusan|nama_urusan', 'kode_bidang|nama_bidang', 'kode_program|nama_program');

        return $data; 
    }

    protected function _listKegiatan($kode)
    {
        $this->db->select('a.kode_urusan,a.kode_bidang,a.kode_unit, a.kode_subunit, a.kode_urusan1,
                        a.kode_bidang1, a.kode_program, a.kode_kegiatan,
                        a.pagu_anggaran, b.nama_urusan, c.nama_bidang, d.nama_program,
                        e.nama_kegiatan, f.nama_subunit')
                ->from('dpa_kegiatan a')
                ->join('master_urusan b', 'b.tahun = a.tahun AND b.kode_urusan = a.kode_urusan1', 'inner')
                ->join('master_bidang c', 'c.tahun = a.tahun AND c.kode_urusan = a.kode_urusan1 AND c.kode_bidang = a.kode_bidang1')
                ->join('master_program d', 'd.tahun = a.tahun AND d.kode_urusan = a.kode_urusan1 AND d.kode_bidang = a.kode_bidang1 AND d.kode_program = a.kode_program')
                ->join('master_kegiatan e', 'e.tahun = a.tahun AND e.kode_urusan = a.kode_urusan1 AND e.kode_bidang = a.kode_bidang1 AND e.kode_program = a.kode_program AND e.kode_kegiatan = a.kode_kegiatan')
                ->join('master_subunit f', 'f.tahun = a.tahun AND f.kode_urusan = a.kode_urusan AND f.kode_bidang = a.kode_bidang AND f.kode_unit = a.kode_unit AND f.kode_subunit = a.kode_subunit');
        if (is_array($kode) && count($kode) ==4) {
            $this->db->where('a.kode_urusan', $kode[0]);
            $this->db->where('a.kode_bidang', $kode[1]);
            $this->db->where('a.kode_unit', $kode[2]);
            $this->db->where('a.kode_subunit', $kode[3]);
        }
        return $this->db->get()->result_array();
    }

}

/* End of file Input_m.php */
/* Location: ./application/models/Input_m.php */
