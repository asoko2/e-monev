<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widget
{
    public static $opd = [];

    public static function namaOpd($kode = '')
    {
        if ($kode == '') {
            return $kode;
        }

        $kd = explode('.', $kode);
        $kds = $kd[0] .sprintf("%02d", $kd[1]) .sprintf("%02d", $kd[2]) .sprintf("%02d", $kd[3]);

        $CI = & get_instance();
        $db = $CI->load->database('default', TRUE);

        if (count(Widget::$opd) == 0) {
            $data = $db->get('vv_subunit')->result_array();
            foreach ($data as $v) {
                self::$opd[$v['id']] = $v['nama'];
            }
        }
        return self::$opd[$kds];
    }

    public static function detOpd($kode = '')
    {
        if ($kode == '') {
            return $kode;
        }

        $kd = explode('.', $kode);
        $kds = $kd[0] .sprintf("%02d", $kd[1]) .sprintf("%02d", $kd[2]) .sprintf("%02d", $kd[3]);

        $CI = & get_instance();
        $db = $CI->load->database('default', TRUE);

        
        $data = $db->get('vv_subunit')->result_array();

        $datas = array_values(array_filter($data, function($x) use($kds) {
                    return $x['id'] == $kds;
                }));

        return $datas[0];


    }



	public static function dropdownTahun()
	{
		$res = '';
		$CI = & get_instance();

        $db = $CI->load->database('default', TRUE);

		$tahun = $db->get('master_renstra')->row();
		foreach ($tahun as $k=>$v) {
            if ($k == 'id' || $k == 'renstra_awal') {
                continue;
            }

			$url = 'dashboard/tahun/' . $v;
			$res .= '<li><a href="'. site_url($url) .'">'.$v.'</a></li>';
		}
		
		return $res;
	}

    public static function dropdownModul($role=0)
    {
        $return ='';
        $CI = & get_instance();

        $db = $CI->load->database('default', TRUE);

        $data = $db->get('app_modul')->result_array();

        foreach ($data as $v) {
            $return .= '<li><a href="'. base_url($v['link']) .'">'.$v['nama'].'</a></li>';
        }

        return $return;
    }

	public static function renderMenu()
	{
		$CI =& get_instance();
		$level = $CI->ion_auth->user->level;

		$menu = $CI->load->view('menu/'.$level, [],true);

		echo $menu;
	}

    public static function dropdownAction($link, $data, $type = [])
    {
        $link = site_url($link);
        $param = '__=' . time();
        foreach ($data as $key => $value) {
            $param .= '&' . $key . '=' .trim($value);
        }

        $ret    = '<div class="btn-group">';
        $ret    .= '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
        $ret    .= 'Aksi&nbsp;<i class="fa fa-caret-down"></i></button>';
        $ret    .= '<ul class="dropdown-menu">';
        if (in_array('edit', $type)) {
            $ret    .= '<li><a href="'.$link. '/edit?'. $param.'">Ubah</a></li>';
        }
        if (in_array('delete', $type)) {
            $ret    .= '<li><a href="'.$link. '/delete?'. $param.'">Hapus</a></li>';
        }
        $ret    .= '</ul></div>';

        return $ret;
    }

    public static function selectSubunit($filter = [], $default = '')
    {
        $return ='<option></option>';
        $CI = & get_instance();
        $CI->load->model('subunit_m');

        $db = $CI->load->database('default', TRUE);


        $query = $db->select('u.kode_urusan, u.kode_bidang, u.kode_unit,
                        s.kode_subunit, u.nama_unit, s.nama_subunit')
                   ->from('master_unit u')
                   ->join('master_subunit s', 's.kode_urusan = u.kode_urusan AND s.kode_bidang = u.kode_bidang AND s.kode_unit = u.kode_unit', 'left');
        
        $result = $query->get()->result_array();

        $data = array_map(function($x) {
                    $kode = $x['kode_urusan'] 
                        . '.' . $x['kode_bidang'] 
                        . '.' . $x['kode_unit'] 
                        . '.' . $x['kode_subunit']; 
                    $x['kode'] = base64_encode($kode);
                    $x['hash'] = $kode;
                    $x['rek'] = kode_subunit($x);
                    $x['fil'] = kode_subunitx($x);
                    return $x;
                }, $result);

        if (count($filter )> 0 && $filter[0] != 'ALL') {
            $data = array_filter($data,function($x)use ($filter){
                return in_array($x['fil'], $filter);
            });
        }
        $group = array_group_by($data, 'nama_unit');


        foreach ($group as $key => $value) {
            $return .= '<optgroup label="'.$key.'">';

            foreach ($value as $v) {
                if ($v['hash'] == $default) {
                    $return .= '<option selected="selected" value="'.$v['kode'].'">'.$v['nama_subunit'].'</option>';
                } else {
                    $return .= '<option value="'.$v['kode'].'">'.$v['nama_subunit'].'</option>';
                }
            }

            $return .= '</optgroup>';
        }

        return $return;
    } 



    public function genRowProgram($data, $uang, $indi, $edit)
    {
        
    }
}

/* End of file Widget.php */
/* Location: ./application/libraries/Widget.php */
