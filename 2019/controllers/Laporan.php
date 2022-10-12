<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends User_Controller {

    public function realisasi_keuangan()
    {
        $this->_calculate_realisasi_keuangan();

        $this->load->helper('xcrud');         
        $xcrud = xcrud_get_instance();
        $xcrud->table('tabel_grafik_keuangan');
        $xcrud->table_name('Prosentase Realisasi Keuangan OPD');

        $xcrud->unset_add();
        $xcrud->unset_edit();
        $xcrud->unset_remove();
        $xcrud->unset_view();
        $xcrud->unset_numbers();
        $xcrud->unset_search();

        
        $this->data['content'] = $xcrud->render();

        $this->data['judul'] = 'Prosentase Realisasi Keuangan OPD';
        $this->render('administrasi/user');
    }

    public function realisasi_keluaran()
    {
        $this->_calculate_realisasi_keluaran();

        $this->load->helper('xcrud');         
        $xcrud = xcrud_get_instance();
        $xcrud->table('tabel_grafik_keluaran');
        $xcrud->table_name('Prosentase Realisasi Keluaran OPD');

        $xcrud->unset_add();
        $xcrud->unset_edit();
        $xcrud->unset_remove();
        $xcrud->unset_view();
        $xcrud->unset_numbers();
        $xcrud->unset_search();

        
        $this->data['content'] = $xcrud->render();

        $this->data['judul'] = 'Prosentase Realisasi Keluaran OPD';
        $this->render('administrasi/user');
    }

    protected function _calculate_realisasi_keluaran()
    {
        $this->db->from('tabel_grafik_keluaran'); 
        $this->db->truncate();

        $query = "
            INSERT INTO tabel_grafik_keluaran
            select a.kode,a.opd,
            ((a.tw1)*100)/a.dpa as tw1,
            ((a.tw1+a.tw2)*100)/a.dpa as tw2,
            ((a.tw1+a.tw2+a.tw3)*100)/a.dpa as tw3,
            ((a.tw1+a.tw2+a.tw3+a.tw4)*100)/a.dpa as tw4
            from 
            (SELECT
            concat(
                            lpad(
                                `a`.`kode_urusan`,
                                1,
                                0
                            ),'.',
                            lpad(
                                `a`.`kode_bidang`,
                                2,
                                0
                            ),'.',
                            lpad(
                                `a`.`kode_unit`,
                                2,
                                0
                            ),'.',
                            lpad(
                                `a`.`kode_subunit`,
                                2,
                                0
                            )
                        ) AS kode,
            a.nama_subunit AS opd,
            Sum(IFNULL(kegiatan_keluaran.r_tahun_5_b5,0)) AS tw1,
            Sum(IFNULL(kegiatan_keluaran.r_tahun_5_b6,0)) AS tw2,
            Sum(IFNULL(kegiatan_keluaran.r_tahun_5_b7,0)) AS tw3,
            Sum(IFNULL(kegiatan_keluaran.r_tahun_5_b8,0)) AS tw4,
            Sum(IFNULL(kegiatan_keluaran.t_tahun_5,0)) AS dpa
            FROM
            master_subunit AS a
            INNER JOIN program AS b ON b.kode_urusan = a.kode_urusan AND b.kode_bidang = a.kode_bidang AND b.kode_unit = a.kode_unit AND b.kode_subunit = a.kode_subunit
            INNER JOIN kegiatan ON kegiatan.program_id = b.id
            INNER JOIN kegiatan_keluaran ON kegiatan_keluaran.kegiatan_id = kegiatan.id
            WHERE
            kegiatan_keluaran.t_tahun_5 > 0
            GROUP BY
            a.nama_subunit
            ) as a
        ";

        $this->db->query($query);
    }

    protected function _calculate_realisasi_keuangan()
    {
        $this->db->from('tabel_grafik_keuangan'); 
        $this->db->truncate();

        $query = "
            INSERT INTO tabel_grafik_keuangan
            select a.kode,a.opd,
            ((a.tw1)*100)/a.dpa as tw1,
            ((a.tw1+a.tw2)*100)/a.dpa as tw2,
            ((a.tw1+a.tw2+a.tw3)*100)/a.dpa as tw3,
            ((a.tw1+a.tw2+a.tw3+a.tw4)*100)/a.dpa as tw4
            from 
            (SELECT
            concat(
                lpad(
                    `master_subunit`.`kode_urusan`,
                    1,
                    0
                ),'.',
                lpad(
                    `master_subunit`.`kode_bidang`,
                    2,
                    0
                ),'.',
                lpad(
                    `master_subunit`.`kode_unit`,
                    2,
                    0
                ),'.',
                lpad(
                    `master_subunit`.`kode_subunit`,
                    2,
                    0
                )
            ) AS `kode`,
            master_subunit.nama_subunit as opd,
            SUM(IFNULL(kegiatan.r_tahun_5_b5,0)) as tw1,
            SUM(IFNULL(kegiatan.r_tahun_5_b6,0)) as tw2,
            SUM(IFNULL(kegiatan.r_tahun_5_b7,0)) as tw3,
            SUM(IFNULL(kegiatan.r_tahun_5_b8,0)) as tw4,
            SUM(IFNULL(kegiatan.t_tahun_5,0)) as dpa
            FROM
            master_subunit
            INNER JOIN program ON program.kode_urusan = master_subunit.kode_urusan AND program.kode_bidang = master_subunit.kode_bidang AND program.kode_unit = master_subunit.kode_unit AND program.kode_subunit = master_subunit.kode_subunit
            INNER JOIN kegiatan ON kegiatan.program_id = program.id
            WHERE kegiatan.t_tahun_5 > 0
            GROUP BY master_subunit.nama_subunit) as a
        ";

        $this->db->query($query);
    }

    public function rkpd_propinsi()
    {
        $this->load->helper('global');
        set_time_limit(0);
        $get = $this->input->get();
        $periode = $this->input->get('periode');


        $opd = $this->input->get('opd');
        $format = $this->input->get('format');
        $tgl = $this->input->get('tanggal');
        $tanggal = date('m/d/Y');
        $data['tanggal'] = $tanggal;
        $data['tw'] = substr($periode,-1);
        $data['rpjmd'] = $this->db->get('master_renstra')->row();
        $data['config'] = $this->session->all_userdata();
    
        $data['m_dpa'] = $this->db->get('vr_rkpd_dpa')->result_array();
        $data['m_outcome'] = $this->db->get('vr_rkpd_program')->result_array();
        $data['m_output'] = $this->db->get('vr_rkpd_kegiatan')->result_array();
        $data['m_urusan'] = $this->db->get('vr_ref_urusan')->result_array();
        $data['m_bidang'] = $this->db->get('vr_ref_bidang')->result_array();
        $data['m_opd'] = $this->db->get('vr_ref_opd')->result_array();
        $data['m_program'] = $this->db->get('vr_ref_program')->result_array();

        if ($format == 'xls'){
            
            $html = $this->load->view('evaluasi/laporan/rkpd2/main', $data, TRUE);
            $breaks = array(","," ","&");
            $nama_lap = "LAPORAN_RKPD.xls";

            $html = str_replace("width=\"31cm\"", "", $html);
            $html = str_replace("width=15", "", $html);
            $html = str_replace("width=10", "", $html);
            $html = str_replace("width=20", "", $html);
            $html = str_replace("width=13", "", $html);

            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$nama_lap"); 
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            echo $html;
        }else {
            
            $html = $this->load->view('css_pdf', array(), TRUE);
            $html = $this->load->view('evaluasi/laporan/rkpd2/main', $data, TRUE);
            $breaks = array(","," ","&");

            echo $html;
        }
        
    }

    public function rkpd_propinsi2()
    {
        $this->load->helper('global');
        set_time_limit(0);
        $get = $this->input->get();
        $periode = $this->input->get('periode');

        $opd = $this->input->get('opd');
        $format = $this->input->get('format');
        $tgl = $this->input->get('tanggal');
        $tanggal = date('m/d/Y');
        $data['tanggal'] = $tanggal;
        $data['tw'] = substr($periode,-1);
        $data['m_dpa'] = $this->db->get('vr_rkpd_dpa')->result_array();
        $data['m_outcome'] = $this->db->get('vr_rkpd_program')->result_array();
        $data['m_output'] = $this->db->get('vr_rkpd_kegiatan')->result_array();
        $data['m_urusan'] = $this->db->get('vr_ref_urusan')->result_array();
        $data['m_bidang'] = $this->db->get('vr_ref_bidang')->result_array();
        $data['m_opd'] = $this->db->get('vr_ref_opd')->result_array();
        $data['m_program'] = $this->db->get('vr_ref_program')->result_array();
        $data['rpjmd'] = $this->db->get('master_renstra')->row();
        $data['config'] = $this->session->all_userdata();

       
        if ($format == 'xls'){
            
            $html = $this->load->view('evaluasi/laporan/rkpd2/main2', $data, TRUE);
            $breaks = array(","," ","&");
            $nama_lap = "LAPORAN_RKPD.xls";

            $html = str_replace("width=\"31cm\"", "", $html);
            $html = str_replace("width=15", "", $html);
            $html = str_replace("width=10", "", $html);
            $html = str_replace("width=20", "", $html);
            $html = str_replace("width=13", "", $html);

            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$nama_lap"); 
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            echo $html;
        }else {
            
            $html = $this->load->view('css_pdf', array(), TRUE);
            $html = $this->load->view('evaluasi/laporan/rkpd2/main2', $data, TRUE);
            $breaks = array(","," ","&");

            echo $html;
        }
        
    }

    public function print_e58($format = null)
    {
        $this->load->helper('global');
        $this->load->model('sasaran_m');
        set_time_limit(0);
        $get = $this->input->get();
        $periode = $this->input->get('periode');

        $opd = $this->input->get('opd');
        // $format = $this->input->get('format');
        $tgl = $this->input->get('tanggal');
        $tanggal = date('m/d/Y');
        $data['tanggal'] = $tanggal;
        $data['tw'] = substr($periode,-1);
        $tahun = $this->session->userdata('tahun');
        $thn_rpjmd = $this->db->get('master_renstra')->row();
        $tahun_ke = ($tahun - $thn_rpjmd->renstra_1)+1;
         
        $data['rpjmd'] = $thn_rpjmd;
        $data['config'] = $this->session->all_userdata();
        // var_dump ($data['config']);
     
        $sasaran = $this->sasaran_m->getAll();
        foreach ($sasaran as $key => $value) {
             $rpjm [$value['kode_sasaran']]= $value;
             $in_sasaran [$value['kode_sasaran']] = $value['kode_sasaran'];
        }
        // get _program = 
        $this->db->where('is_rpjm',1);
        $this->db->where_in('sasaran_rpjm',$in_sasaran);
        foreach ($this->db->get('vv_target_rpjm')->result() as $key => $value) {
            $capaian = array();
            for ($i=1; $i <= $tahun_ke; $i++) { 
                $capaian ['r'] [] = $value->{'r_rpjm_'.$i};

            }

            for ($i=1; $i <= 5; $i++) { 
                if ($i <= $tahun_ke) {
                    $value->{'r_rpjm_'.$i} = $value->{'r_rpjm_'.$i} + $value->{'r_rpjm_'.($i-1)};
                }else{
                    $value->{'r_rpjm_'.$i} = $value->{'r_rpjm_'.($i-1)};
                } 
            }

            $capaian ['t'] = $value->t_rpjm_1+$value->t_rpjm_2+$value->t_rpjm_3+$value->t_rpjm_4+$value->t_rpjm_5;

            $value->c_rpjm_1 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_1/$capaian ['t'])*100) ;
            $value->c_rpjm_2 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_2/$capaian ['t'])*100) ;
            $value->c_rpjm_3 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_3/$capaian ['t'])*100) ;
            $value->c_rpjm_4 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_4/$capaian ['t'])*100) ;
            $value->c_rpjm_5 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_5/$capaian ['t'])*100) ;
 
            
            $value->c_rpjm  =  array_sum($capaian ['r']);
            $value->rasio_rpjm  = ($capaian ['t'] == 0) ? 100 : ($value->c_rpjm/$capaian ['t'])*100 ;
            // $value->rasio_rpjm  = ($capaian ['t'] == 0) ? 100 : ($value->c_rpjm/$capaian ['t'])*100 ;

            $value->c_rpjm  =  nilai($value->c_rpjm);
            $value->rasio_rpjm  =  nilai($value->rasio_rpjm);
            $value->akhir_rpjm  =  nilai($capaian ['t']);
            $rpjm [$value->sasaran_rpjm] ['program'] [$value->program_id] = $value;
            $in_program [$value->program_id] = $value->program_id;
        }



        // get indikator keluaran
        $this->db->select('
            vv_kegiatan_capaian.*,
            vv_target_rpjm.sasaran_rpjm
        ');
        $this->db->where_in('vv_kegiatan_capaian.program_id', $in_program);
        $this->db->where('is_rpjm', 1);
        $this->db->join('vv_target_rpjm', 'vv_kegiatan_capaian.program_id = vv_target_rpjm.program_id');
        foreach ($this->db->get('vv_kegiatan_capaian')->result() as $key => $value) {
             $capaian = array();
            // cek jenis indikator
            switch ($value->jenis_indikator) {
                case 'Komulatif':
                        // $value->t_rpjm_1 = $value->t_rpjm_1;
                        // $value->t_rpjm_2 = $value->t_rpjm_2 + $value->t_rpjm_1;
                        // $value->t_rpjm_3 = $value->t_rpjm_3 + $value->t_rpjm_2;
                        // $value->t_rpjm_4 = $value->t_rpjm_4 + $value->t_rpjm_3;
                        // $value->t_rpjm_5 = $value->t_rpjm_5 + $value->t_rpjm_4;

                        $value->r_rpjm_1 = $value->r_rpjm_1;
                        $value->r_rpjm_2 = $value->r_rpjm_2 + $value->r_rpjm_1;
                        $value->r_rpjm_3 = $value->r_rpjm_3 + $value->r_rpjm_2;
                        $value->r_rpjm_4 = $value->r_rpjm_4 + $value->r_rpjm_3;
                        $value->r_rpjm_5 = $value->r_rpjm_5 + $value->r_rpjm_4;



                        $value->c_rpjm_1 = ($value->t_rpjm_1 == 0) ? 100 : nilai(($value->r_rpjm_1/$value->t_rpjm_1)*100) ;
                        $value->c_rpjm_2 = ($value->t_rpjm_2 == 0) ? 100 : nilai(($value->r_rpjm_2/$value->t_rpjm_2)*100) ;
                        $value->c_rpjm_3 = ($value->t_rpjm_3 == 0) ? 100 : nilai(($value->r_rpjm_3/$value->t_rpjm_3)*100) ;
                        $value->c_rpjm_4 = ($value->t_rpjm_4 == 0) ? 100 : nilai(($value->r_rpjm_4/$value->t_rpjm_4)*100) ;
                        $value->c_rpjm_5 = ($value->t_rpjm_5 == 0) ? 100 : nilai(($value->r_rpjm_5/$value->t_rpjm_5)*100) ;

                        $value->c_rpjm = $value->r_rpjm_6;

                        
                        $value->c_rpjm = $value->{'r_rpjm_'.$tahun_ke};
                        $target_total = $value->t_rpjm_1+$value->t_rpjm_2+$value->t_rpjm_3+$value->t_rpjm_4+$value->t_rpjm_5;
                        $value->rasio_rpjm  = ($target_total == 0) ? 100 : nilai(($value->c_rpjm/$target_total)*100) ; 


                        $value->t_rpjm_1 = nilai($value->t_rpjm_1);
                        $value->t_rpjm_2 = nilai($value->t_rpjm_2);
                        $value->t_rpjm_3 = nilai($value->t_rpjm_3);
                        $value->t_rpjm_4 = nilai($value->t_rpjm_4);
                        $value->t_rpjm_5 = nilai($value->t_rpjm_5);
                        
                      

                        $value->r_rpjm_1 = nilai($value->r_rpjm_1);
                        $value->r_rpjm_2 = nilai($value->r_rpjm_2);
                        $value->r_rpjm_3 = nilai($value->r_rpjm_3);
                        $value->r_rpjm_4 = nilai($value->r_rpjm_4);
                        $value->r_rpjm_5 = nilai($value->r_rpjm_5);
                         


                    break;

                case 'Positif':
                        $value->c_rpjm_1 = ($value->t_rpjm_1 == 0) ? 100 : nilai(($value->r_rpjm_1/$value->t_rpjm_1)*100);
                        $value->c_rpjm_2 = ($value->t_rpjm_2 == 0) ? 100 : nilai(($value->r_rpjm_2/$value->t_rpjm_2)*100);
                        $value->c_rpjm_3 = ($value->t_rpjm_3 == 0) ? 100 : nilai(($value->r_rpjm_3/$value->t_rpjm_3)*100);
                        $value->c_rpjm_4 = ($value->t_rpjm_4 == 0) ? 100 : nilai(($value->r_rpjm_4/$value->t_rpjm_4)*100); 
                        $value->c_rpjm_5 = ($value->t_rpjm_5 == 0) ? 100 : nilai(($value->r_rpjm_5/$value->t_rpjm_5)*100);

                        $value->t_rpjm_1 = nilai($value->t_rpjm_1);
                        $value->t_rpjm_2 = nilai($value->t_rpjm_2);
                        $value->t_rpjm_3 = nilai($value->t_rpjm_3);
                        $value->t_rpjm_4 = nilai($value->t_rpjm_4);
                        $value->t_rpjm_5 = nilai($value->t_rpjm_5);
                        
                        $value->r_rpjm_1 = nilai($value->r_rpjm_1);
                        $value->r_rpjm_2 = nilai($value->r_rpjm_2);
                        $value->r_rpjm_3 = nilai($value->r_rpjm_3);
                        $value->r_rpjm_4 = nilai($value->r_rpjm_4);
                        $value->r_rpjm_5 = nilai($value->r_rpjm_5);

                        $value->c_rpjm = $value->r_rpjm_6;

                        $value->rasio_rpjm  = ($value->t_rpjm_5 == 0) ? 100 : ($value->{'r_rpjm_'.$tahun_ke}/$value->t_rpjm_5)*100; 
                    break;

                case 'Negatif':
                        $value->c_rpjm_1 = ($value->r_rpjm_1 == 0) ? 100 : nilai(($value->t_rpjm_1/$value->r_rpjm_1)*100);
                        $value->c_rpjm_2 = ($value->r_rpjm_2 == 0) ? 100 : nilai(($value->t_rpjm_2/$value->r_rpjm_2)*100);
                        $value->c_rpjm_3 = ($value->r_rpjm_3 == 0) ? 100 : nilai(($value->t_rpjm_3/$value->r_rpjm_3)*100);
                        $value->c_rpjm_4 = ($value->r_rpjm_4 == 0) ? 100 : nilai(($value->t_rpjm_4/$value->r_rpjm_4)*100); 
                        $value->c_rpjm_5 = ($value->r_rpjm_5 == 0) ? 100 : nilai(($value->t_rpjm_5/$value->r_rpjm_5)*100);

                        $value->rasio_rpjm  = ($value->r_rpjm_5 == 0) ? 100 : ($value->t_rpjm_5/$value->{'r_rpjm_'.$tahun_ke})*100; 

                        $value->t_rpjm_1 = nilai($value->t_rpjm_1);
                        $value->t_rpjm_2 = nilai($value->t_rpjm_2);
                        $value->t_rpjm_3 = nilai($value->t_rpjm_3);
                        $value->t_rpjm_4 = nilai($value->t_rpjm_4);
                        $value->t_rpjm_5 = nilai($value->t_rpjm_5);
                        
                      

                        $value->r_rpjm_1 = nilai($value->r_rpjm_1);
                        $value->r_rpjm_2 = nilai($value->r_rpjm_2);
                        $value->r_rpjm_3 = nilai($value->r_rpjm_3);
                        $value->r_rpjm_4 = nilai($value->r_rpjm_4);
                        $value->r_rpjm_5 = nilai($value->r_rpjm_5);
                        $value->c_rpjm = $value->t_rpjm_6;
                    break;

                 case 'Variable':
                        $value->c_rpjm_1 = '-';
                        $value->c_rpjm_2 = '-';
                        $value->c_rpjm_3 = '-';
                        $value->c_rpjm_4 = '-';
                        $value->c_rpjm_5 = '-';
                        $value->c_rpjm = $value->r_rpjm_6;

                        $value->rasio_rpjm  ='-';

                    break;
                
                default:
                    # code...
                    break;
            }
          
            $rpjm [$value->sasaran_rpjm] ['program'] [$value->program_id]->indikator [] = $value;
        }
       
        $data ['rpjm'] = $rpjm;

        // faktor2 faktor
        $this->db->start_cache();
        $this->db->where('tahun', $tahun);
        $this->db->stop_cache();
        $data ['penghambat'] = $this->db->get('f_penghambat_rpjmd')->result();
        $data ['pendorong'] = $this->db->get('f_pendorong_rpjmd')->result();
        $data ['tl_rkpd'] = $this->db->get('f_tindak_lanjut_rkpd_rpjmd')->result();
        $data ['tl_rpjm'] = $this->db->get('f_tindak_lanjut_rpjmd')->result();

        $this->db->flush_cache();

        if ($format == 'xls') {
            $html = $this->load->view('evaluasi/laporan/rpjm/print', $data, TRUE);
            $breaks = array(","," ","&");
            $nama_lap = "Laporan rpjm.xls";

            $html = str_replace("width=\"31cm\"", "", $html);
            $html = str_replace("width=15", "", $html);
            $html = str_replace("width=10", "", $html);
            $html = str_replace("width=20", "", $html);
            $html = str_replace("width=13", "", $html);

            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$nama_lap"); 
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            echo $html;
        } else {
            $html = $this->load->view('evaluasi/laporan/rpjm/print', $data, TRUE);
            echo $html;
        }
        
         
      

    }

    public function excel_e58()
    {
        $this->load->helper('global');
        $this->load->model('sasaran_m');
        set_time_limit(0);
        $get = $this->input->get();
        $periode = $this->input->get('periode');

        $opd = $this->input->get('opd');
        $format = $this->input->get('format');
        $tgl = $this->input->get('tanggal');
        $tanggal = date('m/d/Y');
        $data['tanggal'] = $tanggal;
        $data['tw'] = substr($periode,-1);
        $tahun = $this->session->userdata('tahun');
        $thn_rpjmd = $this->db->get('master_renstra')->row();
        $tahun_ke = ($tahun - $thn_rpjmd->renstra_1)+1;
         
        $data['rpjmd'] = $thn_rpjmd;
        $data['config'] = $this->session->all_userdata();
        // var_dump ($data['config']);
     
        $sasaran = $this->sasaran_m->getAll();
        foreach ($sasaran as $key => $value) {
             $rpjm [$value['kode_sasaran']]= $value;
             $in_sasaran [$value['kode_sasaran']] = $value['kode_sasaran'];
        }
        // get _program = 
        $this->db->where('is_rpjm',1);
        $this->db->where_in('sasaran_rpjm',$in_sasaran);
        foreach ($this->db->get('vv_target_rpjm')->result() as $key => $value) {
            $capaian = array();
            for ($i=1; $i <= $tahun_ke; $i++) { 
                $capaian ['r'] [] = $value->{'r_rpjm_'.$i};

            }

            for ($i=1; $i <= 5; $i++) { 
                if ($i <= $tahun_ke) {
                    $value->{'r_rpjm_'.$i} = $value->{'r_rpjm_'.$i} + $value->{'r_rpjm_'.($i-1)};
                }else{
                    $value->{'r_rpjm_'.$i} = $value->{'r_rpjm_'.($i-1)};
                } 
            }

            $capaian ['t'] = $value->t_rpjm_1+$value->t_rpjm_2+$value->t_rpjm_3+$value->t_rpjm_4+$value->t_rpjm_5;

            $value->c_rpjm_1 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_1/$capaian ['t'])*100) ;
            $value->c_rpjm_2 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_2/$capaian ['t'])*100) ;
            $value->c_rpjm_3 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_3/$capaian ['t'])*100) ;
            $value->c_rpjm_4 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_4/$capaian ['t'])*100) ;
            $value->c_rpjm_5 = ($capaian ['t'] == 0) ? 100 : (($value->r_rpjm_5/$capaian ['t'])*100) ;
 
            
            $value->c_rpjm  =  array_sum($capaian ['r']);
            $value->rasio_rpjm  = ($capaian ['t'] == 0) ? 100 : ($value->c_rpjm/$capaian ['t'])*100 ;
            // $value->rasio_rpjm  = ($capaian ['t'] == 0) ? 100 : ($value->c_rpjm/$capaian ['t'])*100 ;

            $value->c_rpjm  =  nilai($value->c_rpjm);
            $value->rasio_rpjm  =  nilai($value->rasio_rpjm);
            $value->akhir_rpjm  =  nilai($capaian ['t']);
            $rpjm [$value->sasaran_rpjm] ['program'] [$value->program_id] = $value;
            $in_program [$value->program_id] = $value->program_id;
        }



        // get indikator keluaran
        $this->db->select('
            vv_kegiatan_capaian.*,
            vv_target_rpjm.sasaran_rpjm
        ');
        $this->db->where_in('vv_kegiatan_capaian.program_id', $in_program);
        $this->db->join('vv_target_rpjm', 'vv_kegiatan_capaian.program_id = vv_target_rpjm.program_id');
        foreach ($this->db->get('vv_kegiatan_capaian')->result() as $key => $value) {
             $capaian = array();
            // cek jenis indikator
            switch ($value->jenis_indikator) {
                case 'Komulatif':
                        // $value->t_rpjm_1 = $value->t_rpjm_1;
                        // $value->t_rpjm_2 = $value->t_rpjm_2 + $value->t_rpjm_1;
                        // $value->t_rpjm_3 = $value->t_rpjm_3 + $value->t_rpjm_2;
                        // $value->t_rpjm_4 = $value->t_rpjm_4 + $value->t_rpjm_3;
                        // $value->t_rpjm_5 = $value->t_rpjm_5 + $value->t_rpjm_4;

                        $value->r_rpjm_1 = $value->r_rpjm_1;
                        $value->r_rpjm_2 = $value->r_rpjm_2 + $value->r_rpjm_1;
                        $value->r_rpjm_3 = $value->r_rpjm_3 + $value->r_rpjm_2;
                        $value->r_rpjm_4 = $value->r_rpjm_4 + $value->r_rpjm_3;
                        $value->r_rpjm_5 = $value->r_rpjm_5 + $value->r_rpjm_4;



                        $value->c_rpjm_1 = ($value->t_rpjm_1 == 0) ? 100 : nilai(($value->r_rpjm_1/$value->t_rpjm_1)*100) ;
                        $value->c_rpjm_2 = ($value->t_rpjm_2 == 0) ? 100 : nilai(($value->r_rpjm_2/$value->t_rpjm_2)*100) ;
                        $value->c_rpjm_3 = ($value->t_rpjm_3 == 0) ? 100 : nilai(($value->r_rpjm_3/$value->t_rpjm_3)*100) ;
                        $value->c_rpjm_4 = ($value->t_rpjm_4 == 0) ? 100 : nilai(($value->r_rpjm_4/$value->t_rpjm_4)*100) ;
                        $value->c_rpjm_5 = ($value->t_rpjm_5 == 0) ? 100 : nilai(($value->r_rpjm_5/$value->t_rpjm_5)*100) ;

                        $value->c_rpjm = $value->r_rpjm_6;

                        
                        $value->c_rpjm = $value->{'r_rpjm_'.$tahun_ke};
                        $target_total = $value->t_rpjm_1+$value->t_rpjm_2+$value->t_rpjm_3+$value->t_rpjm_4+$value->t_rpjm_5;
                        $value->rasio_rpjm  = ($target_total == 0) ? 100 : nilai(($value->c_rpjm/$target_total)*100) ; 


                        $value->t_rpjm_1 = nilai($value->t_rpjm_1);
                        $value->t_rpjm_2 = nilai($value->t_rpjm_2);
                        $value->t_rpjm_3 = nilai($value->t_rpjm_3);
                        $value->t_rpjm_4 = nilai($value->t_rpjm_4);
                        $value->t_rpjm_5 = nilai($value->t_rpjm_5);
                        
                      

                        $value->r_rpjm_1 = nilai($value->r_rpjm_1);
                        $value->r_rpjm_2 = nilai($value->r_rpjm_2);
                        $value->r_rpjm_3 = nilai($value->r_rpjm_3);
                        $value->r_rpjm_4 = nilai($value->r_rpjm_4);
                        $value->r_rpjm_5 = nilai($value->r_rpjm_5);
                         


                    break;

                case 'Positif':
                        $value->c_rpjm_1 = ($value->t_rpjm_1 == 0) ? 100 : nilai(($value->r_rpjm_1/$value->t_rpjm_1)*100);
                        $value->c_rpjm_2 = ($value->t_rpjm_2 == 0) ? 100 : nilai(($value->r_rpjm_2/$value->t_rpjm_2)*100);
                        $value->c_rpjm_3 = ($value->t_rpjm_3 == 0) ? 100 : nilai(($value->r_rpjm_3/$value->t_rpjm_3)*100);
                        $value->c_rpjm_4 = ($value->t_rpjm_4 == 0) ? 100 : nilai(($value->r_rpjm_4/$value->t_rpjm_4)*100); 
                        $value->c_rpjm_5 = ($value->t_rpjm_5 == 0) ? 100 : nilai(($value->r_rpjm_5/$value->t_rpjm_5)*100);

                        $value->t_rpjm_1 = nilai($value->t_rpjm_1);
                        $value->t_rpjm_2 = nilai($value->t_rpjm_2);
                        $value->t_rpjm_3 = nilai($value->t_rpjm_3);
                        $value->t_rpjm_4 = nilai($value->t_rpjm_4);
                        $value->t_rpjm_5 = nilai($value->t_rpjm_5);
                        
                        $value->r_rpjm_1 = nilai($value->r_rpjm_1);
                        $value->r_rpjm_2 = nilai($value->r_rpjm_2);
                        $value->r_rpjm_3 = nilai($value->r_rpjm_3);
                        $value->r_rpjm_4 = nilai($value->r_rpjm_4);
                        $value->r_rpjm_5 = nilai($value->r_rpjm_5);

                        $value->c_rpjm = $value->r_rpjm_6;

                        $value->rasio_rpjm  = ($value->t_rpjm_5 == 0) ? 100 : ($value->{'r_rpjm_'.$tahun_ke}/$value->t_rpjm_5)*100; 
                    break;

                case 'Negatif':
                        $value->c_rpjm_1 = ($value->r_rpjm_1 == 0) ? 100 : nilai(($value->t_rpjm_1/$value->r_rpjm_1)*100);
                        $value->c_rpjm_2 = ($value->r_rpjm_2 == 0) ? 100 : nilai(($value->t_rpjm_2/$value->r_rpjm_2)*100);
                        $value->c_rpjm_3 = ($value->r_rpjm_3 == 0) ? 100 : nilai(($value->t_rpjm_3/$value->r_rpjm_3)*100);
                        $value->c_rpjm_4 = ($value->r_rpjm_4 == 0) ? 100 : nilai(($value->t_rpjm_4/$value->r_rpjm_4)*100); 
                        $value->c_rpjm_5 = ($value->r_rpjm_5 == 0) ? 100 : nilai(($value->t_rpjm_5/$value->r_rpjm_5)*100);

                        $value->rasio_rpjm  = ($value->r_rpjm_5 == 0) ? 100 : ($value->t_rpjm_5/$value->{'r_rpjm_'.$tahun_ke})*100; 

                        $value->t_rpjm_1 = nilai($value->t_rpjm_1);
                        $value->t_rpjm_2 = nilai($value->t_rpjm_2);
                        $value->t_rpjm_3 = nilai($value->t_rpjm_3);
                        $value->t_rpjm_4 = nilai($value->t_rpjm_4);
                        $value->t_rpjm_5 = nilai($value->t_rpjm_5);
                        
                      

                        $value->r_rpjm_1 = nilai($value->r_rpjm_1);
                        $value->r_rpjm_2 = nilai($value->r_rpjm_2);
                        $value->r_rpjm_3 = nilai($value->r_rpjm_3);
                        $value->r_rpjm_4 = nilai($value->r_rpjm_4);
                        $value->r_rpjm_5 = nilai($value->r_rpjm_5);
                        $value->c_rpjm = $value->t_rpjm_6;
                    break;

                 case 'Variable':
                        $value->c_rpjm_1 = '-';
                        $value->c_rpjm_2 = '-';
                        $value->c_rpjm_3 = '-';
                        $value->c_rpjm_4 = '-';
                        $value->c_rpjm_5 = '-';
                        $value->c_rpjm = $value->r_rpjm_6;

                        $value->rasio_rpjm  ='-';

                    break;
                
                default:
                    # code...
                    break;
            }
          
            $rpjm [$value->sasaran_rpjm] ['program'] [$value->program_id]->indikator [] = $value;
        }
       
        $data ['rpjm'] = $rpjm;

        // faktor2 faktor
        $this->db->start_cache();
        $this->db->where('tahun', $tahun);
        $this->db->stop_cache();
        $data ['penghambat'] = $this->db->get('f_penghambat_rpjmd')->result();
        $data ['pendorong'] = $this->db->get('f_pendorong_rpjmd')->result();
        $data ['tl_rkpd'] = $this->db->get('f_tindak_lanjut_rkpd_rpjmd')->result();
        $data ['tl_rpjm'] = $this->db->get('f_tindak_lanjut_rpjmd')->result();

        $this->db->flush_cache();
         
        $html = $this->load->view('evaluasi/laporan/rpjm/print', $data, TRUE);
        echo $html;

    }

    public function rpjm()
    {
        $this->load->view('evaluasi/laporan/rpjm/list', array());
    }
}

/* End of file Administrasi.php */
/* Location: ./application/controllers/Administrasi.php */
