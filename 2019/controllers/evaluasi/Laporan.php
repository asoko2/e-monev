<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends User_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Laporan';
        $this->data['window_title'] = 'Laporan';

        $this->load->helper('form');
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

            $this->render('evaluasi/laporan/list');


        } else {
            $this->data['data'] =[];
            $this->render('evaluasi/laporan/list');
        }
    }

    public function triwulan($opd,$tw, $mode ='print')
    {
        $this->load->library('dash', ['kode'=>$opd, 'tw'=>$tw, 'th'=>$this->data['tahunkey']]);
         $this->load->model('permasalahan');

        $kegiatan = array_group_by_x($this->dash->odata['kegiatan'], 
                        'kode_urusan1|nama_urusan', 
                        'kode_bidang1|nama_bidang',
                        'kode_program|nama_program|program_id'
                    );
        // var_dump ($kegiatan);
        // die();
        $this->data['data'] = $kegiatan;
        $this->data['permasalahan'] = $this->permasalahan->faktor(['kode'=>$opd, 'tw'=>$tw, 'th'=>$this->data['tahunkey']]);
        $this->data['indikator_capaian'] = $this->dash->odata['indikator_capaian'];
        $this->data['indikator_keluaran'] = $this->dash->odata['indikator_keluaran'];

        $this->data['tw'] = $tw;
        $this->data['opd'] = $opd;
        if ($mode == 'print') {
            $this->cetak('evaluasi/laporan/triwulan/'.$mode);
        } else {
            $html = $this->load->view('evaluasi/laporan/triwulan/'.$mode, $this->data, TRUE);
            $nama_lap = "LAPORAN RENJAA OPD  " . Widget::namaOpd($opd) .
                    ".xls";

            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$nama_lap"); 
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            echo $html;
        }
        

    }

    public function triwulan_full($opd,$tw, $mode ='print')
    {
        $this->load->library('dash', ['kode'=>$opd, 'tw'=>$tw, 'th'=>$this->data['tahunkey']]);
        $this->load->model('permasalahan');

        $kegiatan = array_group_by_x($this->dash->odata['kegiatan'], 
                        'kode_urusan1|nama_urusan', 
                        'kode_bidang1|nama_bidang',
                        'kode_program|nama_program|program_id'
                    );
        // var_dump ($kegiatan);
        // var_dump ($this->dash->odata);
        // die();
        // die();
        $this->data['data'] = $kegiatan;
        $this->data['permasalahan'] = $this->permasalahan->faktor(['kode'=>$opd, 'tw'=>$tw, 'th'=>$this->data['tahunkey']]);
        $this->data['indikator_capaian'] = $this->dash->odata['indikator_capaian'];
        $this->data['indikator_keluaran'] = $this->dash->odata['indikator_keluaran'];
        $this->data['tw'] = $tw;
        $this->data['opd'] = $opd;

        if ($mode == 'print') {
            $this->cetak('evaluasi/laporan/triwulan_full/'.$mode);
        } else {
            $html = $this->load->view('evaluasi/laporan/triwulan_full/'.$mode, $this->data, TRUE);
            $nama_lap = "LAPORAN RENJAA OPD  " . Widget::namaOpd($opd) .
                    ".xls";

            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$nama_lap"); 
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            echo $html;
        }
        

    }

    public function rkpd($opd,$tw, $mode ='print')
    {
        $this->load->library('dash', ['kode'=>$opd, 'tw'=>$tw, 'th'=>$this->data['tahunkey']]);
         $this->load->model('permasalahan');

        $kegiatan = array_group_by_x($this->dash->odata['kegiatan'], 
                        'kode_urusan1|nama_urusan', 
                        'kode_bidang1|nama_bidang',
                        'kode_program|nama_program|program_id'
                    );
        // var_dump ($kegiatan);
        // die();
        $this->data['data'] = $kegiatan;
        $this->data['indikator_capaian'] = $this->dash->odata['indikator_capaian'];
        $this->data['permasalahan'] = $this->permasalahan->faktor(['kode'=>$opd, 'tw'=>$tw, 'th'=>$this->data['tahunkey']]);
        $this->data['indikator_keluaran'] = $this->dash->odata['indikator_keluaran'];
        $this->data['tw'] = $tw;
        $this->data['opd'] = $opd;
        if ($mode == 'print') {
            $this->cetak('evaluasi/laporan/rkpd/'.$mode);
        } else if ($mode == 'excel'){
            $html = $this->load->view('evaluasi/laporan/rkpd/'.$mode, $this->data, TRUE);
            $nama_lap = "LAPORAN RKPD OPD  " . Widget::namaOpd($opd) . ".xls";

            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$nama_lap"); 
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            echo $html;
        }

    }

    public function coba()
    {
        $this->load->library('dash', ['kode'=>'1.1.1.1']);

        var_dump($this->dash->jumlah_kegiatan_renstra());
        var_dump($this->dash->jumlah_program_renstra());
        var_dump($this->dash->jumlah_capaian_renstra());
        var_dump($this->dash->jumlah_keluaran_renstra());
        
        die();
    }

    

}

/* End of file Laporan.php */
/* Location: ./application/controllers/evaluasi/Laporan.php */
