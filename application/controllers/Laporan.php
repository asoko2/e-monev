<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Admin_Controller {

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
}

/* End of file Administrasi.php */
/* Location: ./application/controllers/Administrasi.php */
