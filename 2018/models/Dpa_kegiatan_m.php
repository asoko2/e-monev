<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dpa_kegiatan_m extends MY_Model {

    public $table = 'dpa_kegiatan';
    public $key = ['tahun','kode_urusan','kode_bidang','kode_unit','kode_subunit',
                    'kode_urusan1','kode_bidang1','kode_program','kode_kegiatan'];
    public $field = ['pagu_anggaran','kode_status','created_at','updated_at','created_by','updated_by','verified_by',];

    public function __construct()
    {
        parent::__construct();
    }

    public function daftarKegiatan($kode='')
    {
        $this->db->select('sb.kode_urusan,sb.kode_bidang,sb.kode_unit,sb.kode_subunit,
                    sb.kode_urusan1,sb.kode_bidang1,k.kode_program,k.kode_kegiatan,
                    p.nama_program,k.nama_kegiatan,IFNULL(ik.kode_kegiatan,0) AS pilih')
                ->from('master_subunit_bidang sb')
                ->join('master_program p', 'p.tahun = sb.tahun
                        AND p.kode_urusan = sb.kode_urusan1
                        AND p.kode_bidang = sb.kode_bidang1', 'inner')
                ->join('master_kegiatan k', 'k.tahun = p.tahun
                        AND k.kode_urusan = p.kode_urusan
                        AND k.kode_bidang = p.kode_bidang
                        AND k.kode_program = p.kode_program', 'inner')
                ->join('dpa_kegiatan ik', 'ik.tahun = sb.tahun
                        AND ik.kode_urusan = sb.kode_urusan
                        AND ik.kode_bidang = sb.kode_bidang
                        AND ik.kode_unit = sb.kode_unit
                        AND ik.kode_subunit = sb.kode_subunit
                        AND ik.kode_urusan1 = sb.kode_urusan1
                        AND ik.kode_bidang1 = sb.kode_bidang1
                        AND ik.kode_program = k.kode_program
                        AND ik.kode_kegiatan = k.kode_kegiatan', 'left');
        // $this->db->where('ik.tahun', $this->session->userdata('tahun'));
        $this->db->where('ik.kode_kegiatan', NULL);
        if (is_array($kode) && count($kode) ==4) {
            $this->db->where('sb.kode_urusan', $kode[0]);
            $this->db->where('sb.kode_bidang', $kode[1]);
            $this->db->where('sb.kode_unit', $kode[2]);
            $this->db->where('sb.kode_subunit', $kode[3]);
        }

        
        return $this->db->get()->result_array();

    }

    public function daftarKegiatanKeuangan($kode='')
    {
        $this->db->select('dk.tahun,dk.kode_urusan,dk.kode_bidang,
                        dk.kode_unit, dk.kode_subunit, dk.kode_urusan1, dk.kode_bidang1,
                        dk.kode_program,dk.kode_kegiatan,dk.pagu_anggaran,dk.created_at,
                        dk.updated_at,dk.created_by,dk.updated_by,dk.verified_by,dk.kode_status,
                        p.nama_program,k.nama_kegiatan')
                ->from('dpa_kegiatan dk')
                ->join('master_program p', 'p.tahun = dk.tahun
                        AND p.kode_urusan = dk.kode_urusan1
                        AND p.kode_bidang = dk.kode_bidang1
                        AND p.kode_program = dk.kode_program', 'inner')
                ->join('master_kegiatan k', 'k.tahun = p.tahun
                        AND k.kode_urusan = p.kode_urusan
                        AND k.kode_bidang = p.kode_bidang
                        AND k.kode_program = p.kode_program
                        AND k.kode_kegiatan = dk.kode_kegiatan', 'inner');
        $this->db->where('dk.tahun', $this->session->userdata('tahun'));
        if (is_array($kode) && count($kode) ==4) {
            $this->db->where('dk.kode_urusan', $kode[0]);
            $this->db->where('dk.kode_bidang', $kode[1]);
            $this->db->where('dk.kode_unit', $kode[2]);
            $this->db->where('dk.kode_subunit', $kode[3]);
        }
        return $this->db->get()->result_array();

    }

    public function insertKegiatan($sub, $data, $extra = [])
    {
        $subunit = explode('.', $sub);
        if (count($extra) == 0) {
            $extra = ['updated_at' => time()];
        }
        foreach ($data as $val) {
            $return = '';
            $kode = explode('.', $val);
            $param = $extra; 
            $param['tahun'] = $this->session->userdata('tahun'); 
            $param['kode_urusan'] = $subunit[0]; 
            $param['kode_bidang'] = $subunit[1]; 
            $param['kode_unit'] = $subunit[2]; 
            $param['kode_subunit'] = $subunit[3];
            $param['kode_urusan1'] = $kode[0]; 
            $param['kode_bidang1'] = $kode[1]; 
            $param['kode_program'] = $kode[2]; 
            $param['kode_kegiatan'] = $kode[3];
            
            $where = $this->filterKey($param);
            $field = $this->filterField($param);

            $all = array_merge($where,$field);

            $insert_text = $this->db->insert_string($this->table, $all);
            $return .= str_replace('INSERT', 'INSERT IGNORE', $insert_text);
            $this->db->query($return);
            
        }

        return true;
    }

    public function updatePagu($kode,$pagu)
    {
        if (count($kode) != 8) {
            return false;
        }

        $param['tahun'] = $this->session->userdata('tahun');
        $param['kode_urusan'] = $kode[0]; 
        $param['kode_bidang'] = $kode[1]; 
        $param['kode_unit'] = $kode[2]; 
        $param['kode_subunit'] = $kode[3];
        $param['kode_urusan1'] = $kode[4]; 
        $param['kode_bidang1'] = $kode[5]; 
        $param['kode_program'] = $kode[6]; 
        $param['kode_kegiatan'] = $kode[7];
        $param['pagu_anggaran'] = $pagu;
        
        return $this->update($param);
    }

    

}

/* End of file Dpa_kegiatan_m.php */
/* Location: ./application/models/Dpa_kegiatan_m.php */
