<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash
{
    protected $ci;

    protected $db;
    
    public $odata;

    public $data;

    public function __construct($param)
    {
        $this->ci =& get_instance();
        $this->db = $this->ci->load->database('default', TRUE);
        if (isset($param)) {
            $this->fecth_data($param);
        } else {
            $this->fecth_data('');
        }
    }


    protected function fecth_data($param)
    {
        $kode = explode('.', $param['kode']);
        $tw = $param['tw'];
        $th = $param['th'];
        if (count($kode) == 4) {
            $this->db->where('kode_urusan', $kode[0]);
            $this->db->where('kode_bidang', $kode[1]);
            $this->db->where('kode_unit', $kode[2]);
            $this->db->where('kode_subunit', $kode[3]);
        }

        $kegiatan = $this->db->get('vv_target_renja')->result_array();

        $kegiatan = array_filter($kegiatan, function($x) use ($th) {
            return $x["t_tahun_{$th}"] != 0;
        });

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

        $indikator_keluaran = array_map(function($x) use ($tw, $th){
            $x['col1'] = $x['t_renstra_0'];
            $x['col2'] = 0;
            $x['col3'] = $x["t_tahun_$th"];
            if ($tw == 1) {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = 0;
                $x['col6'] = 0;
                $x['col7'] = 0;
            } else if ($tw == 2) {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = $x["r_tahun_{$th}_b6"];
                $x['col6'] = 0;
                $x['col7'] = 0;
            } else  if ($tw == 3) {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = $x["r_tahun_{$th}_b6"];
                $x['col6'] = $x["r_tahun_{$th}_b7"];
                $x['col7'] = 0;
            } else  {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = $x["r_tahun_{$th}_b6"];
                $x['col6'] = $x["r_tahun_{$th}_b7"];
                $x['col7'] = $x["r_tahun_{$th}_b8"];
            }
            
            for ($i=1; $i < $th; $i++) { 
                $x['col2'] = $x['col2'] + $x["r_renstra_$i"];
            }
            $x['col8'] = 0;
            for ($i=5; $i < $tw+5; $i++) { 
                $x['col8'] = $x['col8'] + $x["r_tahun_{$th}_b{$i}"];
            }
            $c3 = ($x['col3'] == 0) ? 1 : $x['col3'];
            $c1 = ($x['col1'] == 0) ? 1 : $x['col1'];
            $x['col9'] = ($x['col8'] / $c3) *100;
            $x['col10'] = ($x['col8'] + $x['col2']);
            $x['col11'] = ($x['col10'] / $c1) *100;
            return $x;
        }, $indikator_keluaran);

        $indikator_capaian = array_map(function($x) use ($tw, $th){
            $x['col1'] = $x['t_renstra_0'];
            $x['col2'] = 0;
            $x['col3'] = $x["t_tahun_$th"];
            if ($tw == 1) {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = 0;
                $x['col6'] = 0;
                $x['col7'] = 0;
            } else if ($tw == 2) {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = $x["r_tahun_{$th}_b6"];
                $x['col6'] = 0;
                $x['col7'] = 0;
            } else  if ($tw == 3) {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = $x["r_tahun_{$th}_b6"];
                $x['col6'] = $x["r_tahun_{$th}_b7"];
                $x['col7'] = 0;
            } else  {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = $x["r_tahun_{$th}_b6"];
                $x['col6'] = $x["r_tahun_{$th}_b7"];
                $x['col7'] = $x["r_tahun_{$th}_b8"];
            }
            
            for ($i=1; $i < $th; $i++) { 
                $x['col2'] = $x['col2'] + $x["r_renstra_$i"];
            }
            $x['col8'] = 0;
            for ($i=5; $i < $tw+5; $i++) { 
                $x['col8'] = $x['col8'] + $x["r_tahun_{$th}_b{$i}"];
            }
            $c3 = ($x['col3'] == 0) ? 1 : $x['col3'];
            $c1 = ($x['col1'] == 0) ? 1 : $x['col1'];
            $x['col9'] = ($x['col8'] / $c3) *100;
            $x['col10'] = ($x['col8'] + $x['col2']);
            $x['col11'] = ($x['col10'] / $c1) *100;
            return $x;
        }, $indikator_capaian);
        $kegiatan = array_map(function($x) use ($tw, $th){
            $x['col1'] = $x['t_renstra_0'];
            $x['col2'] = 0;
            $x['col3'] = $x["t_tahun_$th"];
            if ($tw == 1) {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = 0;
                $x['col6'] = 0;
                $x['col7'] = 0;
            } else if ($tw == 2) {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = $x["r_tahun_{$th}_b6"];
                $x['col6'] = 0;
                $x['col7'] = 0;
            } else  if ($tw == 3) {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = $x["r_tahun_{$th}_b6"];
                $x['col6'] = $x["r_tahun_{$th}_b7"];
                $x['col7'] = 0;
            } else  {
                $x['col4'] = $x["r_tahun_{$th}_b5"];
                $x['col5'] = $x["r_tahun_{$th}_b6"];
                $x['col6'] = $x["r_tahun_{$th}_b7"];
                $x['col7'] = $x["r_tahun_{$th}_b8"];
            }
            
            for ($i=1; $i < $th; $i++) { 
                $x['col2'] = $x['col2'] + $x["r_renstra_$i"];
            }
            $x['col8'] = 0;
            for ($i=5; $i < $tw+5; $i++) { 
                $x['col8'] = $x['col8'] + $x["r_tahun_{$th}_b{$i}"];
            }
            $c3 = ($x['col3'] == 0) ? 1 : $x['col3'];
            $c1 = ($x['col1'] == 0) ? 1 : $x['col1'];
            $x['col9'] = ($x['col8'] / $c3) *100;
            $x['col10'] = ($x['col8'] + $x['col2']);
            $x['col11'] = ($x['col10'] / $c1) *100;
            return $x;
        }, $kegiatan);

        $this->odata['kegiatan'] = $kegiatan;
        $this->odata['indikator_keluaran'] = $indikator_keluaran;
        $this->odata['indikator_capaian'] = $indikator_capaian;
    }


    public function jumlah_program_renstra()
    {
        $jml = array_unique(array_map(function($x){
                return $x['program_id'];
            }, $this->odata['kegiatan']));

        return count($jml);
    }


    public function jumlah_kegiatan_renstra()
    {
        $jml = $this->odata['kegiatan'];

        return count($jml);
    }

    public function jumlah_keluaran_renstra()
    {
        $jml = array_unique(array_map(function($x){
                return $x['kegiatan_id'];
            }, $this->odata['indikator_keluaran']));;

        return count($jml);
    }

    public function jumlah_capaian_renstra()
    {
        $jml = array_unique(array_map(function($x){
                return $x['program_id'];
            }, $this->odata['indikator_capaian']));;

        return count($jml);
    }

    

}

/* End of file Dash.php */
/* Location: ./application/libraries/Dash.php */
