<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bantuan extends CI_Model {

	protected $_disalowed_char = array('');

	public function buildTree(array &$elements, $parentId = 0)
    {
        $branch = array();

        foreach ($elements as $element) {
            if ($element->parent == $parentId) {
                $children = self::buildTree($elements, $element->id);
                if ($children) {
                    $element->state = 'closed';
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function setting()
    {
        return $this->db->get('ref_config')->row();
    }

    public function kegiatan_keuangan($opd = 1010101, $periode =1)
    {
        $return = array();

        /**
         * urusan
         */

        $this->db->where('kode_opd', $opd);
        $this->db->order_by('kd_urusan1', 'asc');
        $this->db->order_by('kd_bidang1', 'asc');
        $this->db->order_by('kd_program', 'asc');
        $this->db->order_by('kd_kegiatan', 'asc');
       
        $urusan = $this->db->get('vw_laporan_renja_urusan');

        /**
         * bidang
         */

        $this->db->where('kode_opd', $opd);
        $this->db->order_by('kd_urusan1', 'asc');
        $this->db->order_by('kd_bidang1', 'asc');
        $this->db->order_by('kd_program', 'asc');
        $this->db->order_by('kd_kegiatan', 'asc');
       
        $bidang = $this->db->get('vw_laporan_renja_bidang');

        /**
         * program
         */

        $this->db->where('kode_opd', $opd);
        $this->db->order_by('kd_urusan1', 'asc');
        $this->db->order_by('kd_bidang1', 'asc');
        $this->db->order_by('kd_program', 'asc');
        $this->db->order_by('kd_kegiatan', 'asc');
       
        $program = $this->db->get('vw_laporan_renja_program');

        /**
         * kegiatan
         */
        $this->db->where('kode_opd', $opd);
        $this->db->order_by('kd_urusan1', 'asc');
        $this->db->order_by('kd_bidang1', 'asc');
        $this->db->order_by('kd_program', 'asc');
        $this->db->order_by('kd_kegiatan', 'asc');
       
        $kegiatan = $this->db->get('vv_kegiatan_keuangan');
        
        $return['urusan'] = $urusan->result();
        $return['bidang'] = $bidang->result();
        $return['program'] = array_map(function($p) use ($periode) {
                if ($periode == 1){
                    $p->realisasi_tahunan = ($p->realisasi_tw1);
                } else if ($periode == 2){
                    $p->realisasi_tahunan = (
                        $p->realisasi_tw1 +
                        $p->realisasi_tw2) 
                    ;
                } else if ($periode == 3){
                    $p->realisasi_tahunan = (
                        $p->realisasi_tw1 +
                        $p->realisasi_tw2 +
                        $p->realisasi_tw3) 
                    ;
                } else if ($periode == 4){
                    $p->realisasi_tahunan = (
                        $p->realisasi_tw1 +
                        $p->realisasi_tw2 +
                        $p->realisasi_tw3 +
                        $p->realisasi_tw4) 
                    ;
                }
                return $p;
            }
            , $program->result());

        $return['kegiatan'] = array_map(function($p) use ($periode) {
                if ($periode == 1){
                    $p->realisasi_tahunan = ($p->realisasi_tw1);
                } else if ($periode == 2){
                    $p->realisasi_tahunan = (
                        $p->realisasi_tw1 +
                        $p->realisasi_tw2) 
                    ;
                } else if ($periode == 3){
                    $p->realisasi_tahunan = (
                        $p->realisasi_tw1 +
                        $p->realisasi_tw2 +
                        $p->realisasi_tw3) 
                    ;
                } else if ($periode == 4){
                    $p->realisasi_tahunan = (
                        $p->realisasi_tw1 +
                        $p->realisasi_tw2 +
                        $p->realisasi_tw3 +
                        $p->realisasi_tw4) 
                    ;
                }
                return $p;
            }
            , $kegiatan->result());

        return $return;
    }

    public function kegiatan_indikator($opd = 1010101)
    {
        $return = array();

        /**
         * program indikator
         */

        $this->db->where('kd_urusan', substr($opd,0,1));
        $this->db->where('kd_bidang', substr($opd,1,2));
        $this->db->where('kd_unit', substr($opd,3,2));
        $this->db->where('kd_sub_unit', substr($opd,-2));
        $this->db->order_by('kd_urusan1', 'asc');
        $this->db->order_by('kd_bidang1', 'asc');
        $this->db->order_by('kd_program', 'asc');
        $this->db->order_by('urut', 'asc');
       
        $program_indikator = $this->db->get('vv_indikator_program');
        
        /**
         * program
         */

        $this->db->where('kd_urusan', substr($opd,0,1));
        $this->db->where('kd_bidang', substr($opd,1,2));
        $this->db->where('kd_unit', substr($opd,3,2));
        $this->db->where('kd_sub_unit', substr($opd,-2));
        $this->db->order_by('kd_urusan1', 'asc');
        $this->db->order_by('kd_bidang1', 'asc');
        $this->db->order_by('kd_program', 'asc');
       
        $program_keterangan = $this->db->get('vv_keterangan_program');

        /**
         * kegiatan
         */
        $this->db->where('kd_urusan', substr($opd,0,1));
        $this->db->where('kd_bidang', substr($opd,1,2));
        $this->db->where('kd_unit', substr($opd,3,2));
        $this->db->where('kd_sub_unit', substr($opd,-2));
        $this->db->order_by('kd_urusan1', 'asc');
        $this->db->order_by('kd_bidang1', 'asc');
        $this->db->order_by('kd_program', 'asc');
        $this->db->order_by('kd_kegiatan', 'asc');
        $this->db->order_by('urut', 'asc');
       
        $kegiatan_indikator = $this->db->get('vv_indikator_kegiatan');
        
        $return['kegiatan_indikator'] = $kegiatan_indikator->result();
        $return['program_keterangan'] = $program_keterangan->result();
        $return['program_indikator'] = $program_indikator->result();

        return $return;
    }

    public function indi_program($opd,$kode, $periode = 1)
    {
        $this->db->where('kode_opd', $opd);
        $this->db->where('kode_program', $kode);
        $this->db->order_by('kd_urusan1', 'asc');
        $this->db->order_by('kd_bidang1', 'asc');
        $this->db->order_by('kd_program', 'asc');
        $this->db->order_by('urut', 'asc');
        
        $program_indikator = $this->db->get('vv_indikator_program');

        $data = array_map(function($d) use ($periode){
                $d->target_tahunan = $d->komulatif == 0 ? 
                                        $d->target_tw4 :
                                        $d->target_tw1 +
                                        $d->target_tw2 +
                                        $d->target_tw3 +
                                        $d->target_tw4;
                if ($d->komulatif == 0) {
                    $d->realisasi_tahunan = ($d->{"realisasi_tw$periode"});
                } else if ($periode == 1){
                    $d->realisasi_tahunan = ($d->realisasi_tw1);
                } else if ($periode == 2){
                    $d->realisasi_tahunan = ($d->realisasi_tw1 +
                        $d->realisasi_tw2) 
                    ;
                } else if ($periode == 3){
                    $d->realisasi_tahunan = ($d->realisasi_tw1 +
                        $d->realisasi_tw2 +
                        $d->realisasi_tw3 )
                    ;
                } else if ($periode == 4){
                    $d->realisasi_tahunan =  (
                        $d->realisasi_tw1 +
                        $d->realisasi_tw2 +
                        $d->realisasi_tw3 +
                        $d->realisasi_tw4 )
                    ;
                }

                return $d;
            }
        , $program_indikator->result());

        return $data;
    }

    public function indi_kegiatan($opd,$kode,$periode)
    {
        $this->db->where('kode_opd', $opd);
        $this->db->where('kode_kegiatan', $kode);
        $this->db->order_by('kd_urusan1', 'asc');
        $this->db->order_by('kd_bidang1', 'asc');
        $this->db->order_by('kd_program', 'asc');
        $this->db->order_by('urut', 'asc');
        
        $program_indikator = $this->db->get('vv_indikator_kegiatan');
        $data = array_map(function($d) use ($periode){
                $d->target_tahunan = $d->komulatif == 0 ? 
                                        $d->target_tw4 :
                                        $d->target_tw1 +
                                        $d->target_tw2 +
                                        $d->target_tw3 +
                                        $d->target_tw4;
                if ($d->komulatif == 0) {
                    $d->realisasi_tahunan = ($d->{"realisasi_tw$periode"});
                } else if ($periode == 1){
                    $d->realisasi_tahunan = ($d->realisasi_tw1);
                } else if ($periode == 2){
                    $d->realisasi_tahunan = ($d->realisasi_tw1 +
                        $d->realisasi_tw2) 
                    ;
                } else if ($periode == 3){
                    $d->realisasi_tahunan = ($d->realisasi_tw1 +
                        $d->realisasi_tw2 +
                        $d->realisasi_tw3 )
                    ;
                } else if ($periode == 4){
                    $d->realisasi_tahunan =  (
                        $d->realisasi_tw1 +
                        $d->realisasi_tw2 +
                        $d->realisasi_tw3 +
                        $d->realisasi_tw4 )
                    ;
                }

                return $d;
            }
        , $program_indikator->result());

        return $data;
    }

    public function ket_program($opd,$kode)
    {
        $this->db->where('kode_opd', $opd);
        $this->db->where('kode_program', $kode);
        
        $program_indikator = $this->db->get('vv_keterangan_program');

        return $program_indikator->row();
    }

    public function getOpd($kode)
    {
        $this->db->where('kode_opd', $kode);
        return $this->db->get('vv_unit_jabatan')->row();
    }

    public function keterisianOpd()
    {
        return $this->db->get('vv_stt_input')->result();
    }

    public function kinerjaOutput()
    {
        return $this->db->query("
            SELECT sip.opd, ROUND(AVG((sip.r/sip.t)*100)) as kinerja from (SELECT opd, if(target=0,1,target) as t, if(realisasi=0,0,realisasi) as r from (SELECT
            IF(IFNULL(ta_kegiatan_indikator.komulatif,1) = 0,
                GREATEST(IFNULL(ta_kegiatan_indikator.target_tw4,0),
                    IFNULL(ta_kegiatan_indikator.target_tw1,0),
            IFNULL(ta_kegiatan_indikator.target_tw2,0),
            IFNULL(ta_kegiatan_indikator.target_tw3,0)
                ),
                ROUND(
            IFNULL(ta_kegiatan_indikator.target_tw1,0)+
            IFNULL(ta_kegiatan_indikator.target_tw2,0)+
            IFNULL(ta_kegiatan_indikator.target_tw3,0)+
            IFNULL(ta_kegiatan_indikator.target_tw4,0))) AS target,
            IF(IFNULL(ta_kegiatan_indikator.komulatif,1) = 0,
                GREATEST(IFNULL(ta_kegiatan_indikator.realisasi_tw4,0),
                    IFNULL(ta_kegiatan_indikator.realisasi_tw2,0),
                    IFNULL(ta_kegiatan_indikator.realisasi_tw1,0),
                    IFNULL(ta_kegiatan_indikator.realisasi_tw3,0)),
            ROUND(IFNULL(ta_kegiatan_indikator.realisasi_tw1,0)+
            IFNULL(ta_kegiatan_indikator.realisasi_tw2,0)+
            IFNULL(ta_kegiatan_indikator.realisasi_tw3,0)+
            IFNULL(ta_kegiatan_indikator.realisasi_tw4,0))) AS realisasi,
            ref_sub_unit.nm_sub_unit as opd
            FROM
            ta_kegiatan
            LEFT JOIN ta_kegiatan_indikator ON ta_kegiatan_indikator.kd_urusan = ta_kegiatan.kd_urusan AND ta_kegiatan_indikator.kd_bidang = ta_kegiatan.kd_bidang AND ta_kegiatan_indikator.kd_unit = ta_kegiatan.kd_unit AND ta_kegiatan_indikator.kd_sub_unit = ta_kegiatan.kd_sub_unit AND ta_kegiatan_indikator.kd_urusan1 = ta_kegiatan.kd_urusan1 AND ta_kegiatan_indikator.kd_bidang1 = ta_kegiatan.kd_bidang1 AND ta_kegiatan_indikator.kd_program = ta_kegiatan.kd_program AND ta_kegiatan_indikator.kd_kegiatan = ta_kegiatan.kd_kegiatan
            INNER JOIN ref_sub_unit ON ta_kegiatan.kd_urusan = ref_sub_unit.kd_urusan AND ta_kegiatan.kd_bidang = ref_sub_unit.kd_bidang AND ta_kegiatan.kd_unit = ref_sub_unit.kd_unit AND ta_kegiatan.kd_sub_unit = ref_sub_unit.kd_sub_unit
            ) as oke)as sip
            GROUP BY sip.opd
        ")->result();
    }

    public function avgKinerjaOutput($opd='', $program = '', $periode = 0)
    {
        // return [
        //     "opd" => $opd,
        //     "program" => $program,
        //     "periode" => $periode,
        // ];

        $this->db->where('kode_opd', $opd);
        $this->db->where('kode_program', $program);
        
        $indi = $this->db->get('vv_indikator_kegiatan');
        $indikator = $indi->result();
        
        $hasil = $this->hitungRataRata($indikator, $periode);
        // $hasil['program'] = $program;
        // return $hasil;
        $hasil['predikat'] = array_map(function($d){
            $data = $d *1;
            if ($data <= 50 ) {
                $d = 'Sangat Rendah';
                return $d;
            } elseif ($data <= 65 ) {
                $d = 'Rendah';
                return $d;
            } elseif ($data <= 75 ) {
                $d = 'Sedang';
                return $d;
            } elseif ($data <= 90 ) {
                $d = 'Tinggi';
                return $d;
            } else {
                $d = 'Sangat Tinggi';
                return $d;
            }
        }, $hasil);

        return $hasil;        
    }


    public function hitungRataRata($data, $periode)
    {
        $hasil_periode = [];
        $hasil_renstra = [];
        foreach ($data as $k => $v) {
            if ($v->komulatif == 1) {
                $target = $v->target_tw1 +$v->target_tw2 + $v->target_tw3 + $v->target_tw4;
                if ($periode == 1) {
                    $realisasi = $v->realisasi_tw1;
                } else if ($periode == 2) {
                    $realisasi = $v->realisasi_tw1 + $v->realisasi_tw2;
                } else if ($periode == 3) {
                    $realisasi = $v->realisasi_tw1 + $v->realisasi_tw2 + $v->realisasi_tw3;
                } else if ($periode == 4) {
                    $realisasi = $v->realisasi_tw1 + $v->realisasi_tw2 
                                + $v->realisasi_tw3 + $v->realisasi_tw4;
                }
                $realisasi_renstra = $realisasi + $v->realisasi_renstra; 
            } else {
                $target = $v->{"target_tw". $periode};
                $realisasi = $v->{"realisasi_tw". $periode};
                $realisasi_renstra = $v->realisasi_renstra + $realisasi; 
            }
              
            array_push($hasil_periode, number_format(($realisasi / $target), 2));
            array_push($hasil_renstra, number_format(($realisasi_renstra / $v->target_rentra), 2));
        }
        $return_periode = ((array_sum($hasil_periode) / count($hasil_periode)) * 100);
        $return_renstra = ((array_sum($hasil_renstra) / count($hasil_renstra)) * 100);
        
        // return [
        //     'periode' => $hasil_periode,
        //     'renstra' => $hasil_renstra
        // ];
        return [
            'periode' => $return_periode,
            'renstra' => $return_renstra
        ];
    }

    

}

/* End of file Bantuan.php */
/* Location: .//D/LAMPP/htdocs/app_data/spm/models/Bantuan.php */