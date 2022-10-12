<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('_e'))
{

    function _e($str ='', $default = '')
    {
       echo isset($str) ? $str : $default; 
    }
}

if ( ! function_exists('array_avg'))
{

    function array_avg($arr = [])
    {
       $a = array_filter($arr);
       $jml = count($a) > 0 ? count($a) : 1;

       return array_sum($a)/$jml; 
    }
}

if (! function_exists('uang')) {
    
    function uang($value)
    {
        if ($value == '') {
            return '';
        }
        return number_format($value,0,',','.');
    }
}

if (! function_exists('uangXls')) {
    
    function uangXls($value)
    {
        if ($value == '') {
            return '';
        }
        return number_format($value,0);
    }
}

if (! function_exists('persen')) {
    
    function persen($value)
    {
        if ($value == '' || $value == 0) {
            return '';
        }
        return number_format($value,2,',','.')  . '%';
    }
}

if (! function_exists('nilaiXls')) {
    function nilaiXls($nilai) {
        return number_format($nilai,2);
    }
}

if (! function_exists('nilai')) {
    function nilai($nilai) {
        return number_format($nilai,2,',','.');
    }
}



if ( ! function_exists('get_nama_opd'))
{

    function get_nama_opd($kode)
    {
        $opd = get_instance()->opd;
        $data = array_values(array_filter($opd, function($x) use ($kode) {
            return $x->id == $kode;
        })); 
        if (count($data) == 1 && isset($data[0])) {
            return $data[0]->nama;
        }
        return '';
    }
}

if ( ! function_exists('get_detil_opd'))
{

    function get_detil_opd($kode)
    {
        $opd = get_instance()->opd;
        $data = array_values(array_filter($opd, function($x) use ($kode) {
            return $x->id == $kode;
        })); 
        if (count($data) == 1 && isset($data[0])) {
            return $data[0];
        }
        return new stdClass;
    }
}

if ( ! function_exists('app'))
{

    function app($str)
    {
        $CI =& get_instance();
        return isset($CI->app->{$str}) ? $CI->app->{$str} : ''; 
    }
}

if ( ! function_exists('persen'))
{

    function persen($a,$b)
    {
        if ($b == 0) {
            return number_format(0,2) . '%';
        }
        $c = $a*100/$b;
        return number_format($c,2) . '%';
    }
}

if ( ! function_exists('array_random'))
{
    function array_random($arr, $num = 1) {
        shuffle($arr);
        
        $r = array();
        for ($i = 0; $i < $num; $i++) {
            $r[] = $arr[$i];
        }
        return $num == 1 ? $r[0] : $r;
    }
}

if ( ! function_exists('_n'))
{

    function _n($str ='', $default = 0)
    {
       return isset($str) && is_numeric($str) ? number_format($str,2) : $default; 
    }
}

if ( ! function_exists('_romawi'))
{

    function _romawi($str=1)
    {
        $rom = ['','I','II','III','IV'];
       echo $rom[$str]; 
    }
}



if ( ! function_exists('list_renstra'))
{

    function list_renstra()
    {
        $CI = & get_instance();

        $db = $CI->load->database('default', TRUE);

        $tahun = $db->get('master_renstra')->row_array();
        unset($tahun['id']);
        return array_values($tahun);
    }
}

if ( ! function_exists('_bulan'))
{

    function _bulan($bulan ='', $reserve = false)
    {
       $bln = ['Kosong','Januari','Februari','Maret','April',
                'Mei','Juni','Juli','Agustus','September',
                'Oktober','November','Desember'];
        if ($reserve) {
            $bln = array_flip($bln);
        }

        return $bln[$bulan];
    }
}

if ( ! function_exists('make_button'))
{

    function make_button($url ='', $state = 'all')
    {
        $separator = "&nbsp;&nbsp;";

        $button = "";
        if ($state == 'all') {
            $button .= $separator . "<a target='_blank' href='".$url."/print' class='btn btn-xs btn-labeled btn-success'><span class='btn-label icon fa fa-print'></span>Print</a>" ;
            $button .= $separator . "<a target='_blank' href='".$url."/excel' class='btn btn-xs btn-labeled btn-primary'><span class='btn-label icon fa fa-file-excel-o'></span>Excel</a>" ;
            // $button .= $separator . "<a target='_blank' href='".$url."/pdf' class='btn btn-xs btn-labeled btn-warning'><span class='btn-label icon fa fa-file-pdf-o'></span>PDF</a>" ;
        }
        echo $button;
    }
}

if ( ! function_exists('arr_num'))
{

    function arr_num(array $data, $key, $comma = 0)
    {
       return isset($data[$key]) ? _e(number_format($data[$key], $comma)) : 0; 
    }
}

if ( ! function_exists('getTahunKey'))
{

    function getTahunKey($key)
    {
        $CI = & get_instance();

        $db = $CI->load->database('default', TRUE);

        $tahun = $db->get('master_renstra')->row_array();

        $tahun = array_flip($tahun);
        return isset($tahun[$key]) ? str_replace('renstra_', '', $tahun[$key]) : 0;
        

    }
}


if ( ! function_exists('make_editable'))
{

    function make_editable(array $data, $key, $options = [])
    {

        $class = 'e_' . $key;
        $return = '';

        // if ($data[$options['val']] == '') {
        //     $data[$options['val']] = '-';
        // }
        $return .= ' <a class="'.$class.'"';
        $return .= ' data-pk="'.$options['pk'].'">';
        $return .= $data[$options['val']];
        $return .= '</a>';


        return _e($return); 
    }
}


if ( ! function_exists('indiSatuan'))
{

    function indiSatuan($data)
    {
       if (isset($data['indikator']) && isset($data['satuan']))
            return _e($data['indikator'] . ' (' . $data['satuan'] . ')');
    }
}

if ( ! function_exists('bulan_to_tribulan'))
{

    function bulan_to_tribulan($data ='', $tb = 1, $tipe = 'target')
    {
        if ($tb < 1 && $tb > 5) {
            return 0;
        }

        if (! in_array($tipe, ['target','realisasi'])) {
            return 0;
        }

        $tw = [
            '1' => ['1','2','3'],
            '2' => ['4','5','6'],
            '3' => ['7','8','9'],
            '4' => ['10','11','12'],
            '5' => ['1','2','3','4','5','6','7','8','9','10','11','12']
        ];

        
        $ret = 0;
        foreach ($tw[$tb] as $v) {
            $key = $tipe . '_b' . $v;
            $ret = $ret + $data[$key];
        }
        return $ret;
    }
}

if ( ! function_exists('kode_kegiatan'))
{

    function kode_kegiatan($data)
    {
        if (isset($data['kode_urusan1'])) {
            return $data['kode_urusan1'] .'.'
                . sprintf("%02d", $data['kode_bidang1'])  . '.'
                . sprintf("%02d", $data['kode_program'])  . '.'
                . sprintf("%02d", $data['kode_kegiatan'])
                ; 
        }
        return $data['kode_urusan'] .'.'
            . sprintf("%02d", $data['kode_bidang'])  . '.'
            . sprintf("%02d", $data['kode_program'])  . '.'
            . sprintf("%02d", $data['kode_kegiatan'])
            ;
    }
}

if ( ! function_exists('kode_program'))
{

    function kode_program($data)
    {
        if (isset($data['kode_urusan1'])) {
            return $data['kode_urusan1'] .'.'
                . sprintf("%02d", $data['kode_bidang1'])  . '.'
                . sprintf("%02d", $data['kode_program'])
                ; 
        }
        return $data['kode_urusan'] .'.'
            . sprintf("%02d", $data['kode_bidang'])  . '.'
            . sprintf("%02d", $data['kode_program'])
            ;
    }
}

if ( ! function_exists('kode_bidang'))
{

    function kode_bidang($data)
    {
        if (isset($data['kode_urusan1'])) {
            return $data['kode_urusan1'] .'.'
                . sprintf("%02d", $data['kode_bidang1'])
                ; 
        }
        return $data['kode_urusan'] .'.'
            . sprintf("%02d", $data['kode_bidang'])
            ;
    }
}

if ( ! function_exists('kode_bidang_opd'))
{

    function kode_bidang_opd($data)
    {
        return $data['kode_urusan'] .'.'
            . sprintf("%02d", $data['kode_bidang'])
            ;
    }
}

if ( ! function_exists('kode_urusan'))
{

    function kode_urusan($data)
    {
        if (isset($data['kode_urusan1'])) {
            return $data['kode_urusan1']; 
        }
        return $data['kode_urusan'];
    }
}

if ( ! function_exists('kode_unit'))
{

    function kode_unit($data)
    {
        return $data['kode_urusan'] .'.'
            . sprintf("%02d", $data['kode_bidang'])  . '.'
            . sprintf("%02d", $data['kode_unit'])
            ;
    }
}

if ( ! function_exists('make_switchbox'))
{

    function make_switchbox($name, $value, $check = 0, $arr = TRUE)
    {
        $selected = intval($check) == 0 ? '' : ' checked="checked" ';
        $value = 'value="'. $value .'" ';
        $name = $arr == TRUE ? ' name="'. $name .'[]"': 'name="'. $name .'" ';
        return '<input class="myswitch" type="checkbox" '.$name. $value. $selected .'>';
    }
}

if ( ! function_exists('kode_subunit'))
{

    function kode_subunit($data)
    {
        return $data['kode_urusan'] .'.'
            . sprintf("%02d", $data['kode_bidang'])  . '.'
            . sprintf("%02d", $data['kode_unit'])  . '.'
            . sprintf("%02d", $data['kode_subunit']);
    }
}

if ( ! function_exists('kode_subunitx'))
{

    function kode_subunitx($data)
    {
        return $data['kode_urusan']
            . sprintf("%02d", $data['kode_bidang'])
            . sprintf("%02d", $data['kode_unit'])
            . sprintf("%02d", $data['kode_subunit']);
    }
}

if (!function_exists('array_group_by')) {
    /**
     * Groups an array by a given key.
     *
     * Groups an array into arrays by a given key, or set of keys, shared between all array members.
     *
     * Based on {@author Jake Zatecky}'s {@link https://github.com/jakezatecky/array_group_by array_group_by()} function.
     * This variant allows $key to be closures.
     *
     * @param array $array   The array to have grouping performed on.
     * @param mixed $key,... The key to group or split by. Can be a _string_,
     *                       an _integer_, a _float_, or a _callable_.
     *
     *                       If the key is a callback, it must return
     *                       a valid key from the array.
     *
     *                       If the key is _NULL_, the iterated element is skipped.
     *
     *                       ```
     *                       string|int callback ( mixed $item )
     *                       ```
     *
     * @return array|null Returns a multidimensional array or `null` if `$key` is invalid.
     */
    function array_group_by(array $array, $key)
    {
        if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key) ) {
            trigger_error('array_group_by(): The key should be a string, an integer, or a callback', E_USER_ERROR);
            return null;
        }
        $func = (!is_string($key) && is_callable($key) ? $key : null);
        $_key = $key;
        // Load the new array, splitting by the target key
        $grouped = [];
        foreach ($array as $value) {
            $key = null;
            if (is_callable($func)) {
                $key = call_user_func($func, $value);
            } elseif (is_object($value) && isset($value->{$_key})) {
                $key = $value->{$_key};
            } elseif (isset($value[$_key])) {
                $key = $value[$_key];
            }
            if ($key === null) {
                continue;
            }
            $grouped[$key][] = $value;
        }
        // Recursively build a nested grouping if more parameters are supplied
        // Each grouped array value is grouped according to the next sequential key
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $key => $value) {
                $params = array_merge([ $value ], array_slice($args, 2, func_num_args()));
                $grouped[$key] = call_user_func_array('array_group_by', $params);
            }
        }
        return $grouped;
    }
}

if (!function_exists('array_group_by_x')) {
    /**
     * Groups an array by a given key.
     *
     * Groups an array into arrays by a given key, or set of keys, shared between all array members.
     *
     * Based on {@author Jake Zatecky}'s {@link https://github.com/jakezatecky/array_group_by array_group_by()} function.
     * This variant allows $key to be closures.
     *
     * @param array $array   The array to have grouping performed on.
     * @param mixed $key,... The key to group or split by. Can be a _string_,
     *                       an _integer_, a _float_, or a _callable_.
     *
     *                       If the key is a callback, it must return
     *                       a valid key from the array.
     *
     *                       If the key is _NULL_, the iterated element is skipped.
     *
     *                       ```
     *                       string|int callback ( mixed $item )
     *                       ```
     *
     * @return array|null Returns a multidimensional array or `null` if `$key` is invalid.
     */
    function array_group_by_x(array $array, $key)
    {
        if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key) ) {
            trigger_error('array_group_by(): The key should be a string, an integer, or a callback', E_USER_ERROR);
            return null;
        }
        $func = (!is_string($key) && is_callable($key) ? $key : null);
        $keyx = explode('|', $key);
        $_key = $keyx[0];
        if (count($keyx) == 2) {
            $_key2 = $keyx[1];
        }
        if (count($keyx) == 3) {
            $_key2 = $keyx[1];
            $_key3 = $keyx[2];
        }
        // Load the new array, splitting by the target key
        $grouped = [];
        foreach ($array as $value) {
            $key = null;
            if (count($keyx) == 3) {
                if (is_callable($func)) {
                    $key = call_user_func($func, $value);
                } elseif (is_object($value) && isset($value->{$_key}) && isset($value->{$_key2}) && isset($value->{$_key3})) {
                    $key = $value->{$_key} . '|' .$value->{$_key2} . '|' .$value->{$_key3} ;
                } elseif (isset($value[$_key]) && isset($value[$_key2]) && isset($value[$_key3])) {
                    $key = $value[$_key] .'|'.$value[$_key2] .'|'. $value[$_key3];
                }
                if ($key === null) {
                    continue;
                }    
            } else if (count($keyx) == 2) {
                if (is_callable($func)) {
                    $key = call_user_func($func, $value);
                } elseif (is_object($value) && isset($value->{$_key}) && isset($value->{$_key2})) {
                    $key = $value->{$_key} . '|' .$value->{$_key2} ;
                } elseif (isset($value[$_key]) && isset($value[$_key2])) {
                    $key = $value[$_key] .'|'.$value[$_key2];
                }
                if ($key === null) {
                    continue;
                }    
            } else {
                if (is_callable($func)) {
                    $key = call_user_func($func, $value);
                } elseif (is_object($value) && isset($value->{$_key})) {
                    $key = $value->{$_key};
                } elseif (isset($value[$_key])) {
                    $key = $value[$_key];
                }
                if ($key === null) {
                    continue;
                }
            }
            
            $grouped[$key][] = $value;
        }
        // Recursively build a nested grouping if more parameters are supplied
        // Each grouped array value is grouped according to the next sequential key
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $key => $value) {
                $params = array_merge([ $value ], array_slice($args, 2, func_num_args()));
                $grouped[$key] = call_user_func_array('array_group_by_x', $params);
            }
        }
        return $grouped;
    }
}

if ( ! function_exists('capaianTarget'))
{
    function capaianTarget($a, $bln=1) {
      
      if ($bln == 1 ) {
        if ($a > 19) {
          return 'Tinggi';
        }  else if ($a > 10) {
          return 'Sedang';
        }  else {
          return 'Rendah';
        }
      } else if ($bln == 2) {
        if ($a > 54) {
          return 'Tinggi';
        }  else if ($a > 35) {
          return 'Sedang';
        }  else {
          return 'Rendah';
        }
      } else if ($bln == 11) {
        if ($a > 84) {
          return 'Tinggi';
        }  else if ($a > 68) {
          return 'Sedang';
        }  else {
          return 'Rendah';
        }
      } else {
        if ($a > 90) {
          return 'Tinggi';
        }  else if ($a > 84) {
          return 'Sedang';
        }  else {
          return 'Rendah';
        }
      }  
    }
}

if ( ! function_exists('predikat'))
{
    function predikat ($a) {
      
      if ($a <= 50) {
        return 'Sangat Rendah';
      }  else if ($a <= 65) {
        return 'Rendah';
      }  else if ($a <= 75) {
        return 'Sedang';
      }  else if ($a <= 90) {
        return 'Tinggi';
      }  else if ($a <= 100) {
        return 'Sangat Tinggi';
      } else {
        return 'Sangat Tinggi';
      }
    }
}

/* End of file MY_string_helper.php */
/* Location: ./application/helpers/MY_string_helper.php */
