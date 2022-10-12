<?php

if (! function_exists('count_recursive')) {
	
	function count_recursive($subject, $search)
	{
		$i = 0;
		foreach ($subject as $k => $val) {
			$match = count($search);
			$res_match = 0;
			foreach ($search as $key => $value) {
				if (property_exists($val, $key)) {
					// return $key;
					if ($val->{$key} == $value) {
						$res_match + 1;
					}
				}
			}

			if ($match == $res_match) {
				$i++;
			}			
		}

		// return count($jml) == 0 ? 1 : count($jml);
		return ($i);
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

if (! function_exists('persen')) {
    
    function persen($value)
    {
        if ($value == '' || $value == 0) {
            return '0%';
        }
        return number_format($value,2,',','.')  . '%';
    }
}

if (! function_exists('persens')) {
    
    function persens($value)
    {
        if ($value == '' || $value == 0) {
            return '0%';
        }
        return number_format($value,7,',','.')  . '%';
    }
}

if (! function_exists('persentase')) {
	
	function persentase($v1, $v2)
	{
        $value = ($v1/$v2)*100;
		if ($value == '' || $value == 0) {
			return '0%';
		}
		return number_format($value,2,',','.')  . '%';
	}
}

if (! function_exists('nilai')) {
    function nilai($nilai) {
        return number_format($nilai,2,',','.');
    }
}

if ( ! function_exists('tgl_indo'))
{
    function tgl_indo($tgl)
    {
        $swap = explode(' ',$tgl);
        $ubah = gmdate($swap[0], time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan.' '.$tahun;
    }
}

if ( ! function_exists('tgl_jam_indo'))
{
    function tgl_jam_indo($tgl)
    {
        $swap = explode(' ',$tgl);
        $ubah = gmdate($swap[0], time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan.' '.$tahun . ' jam ' . $swap[1];
    }
}

if ( ! function_exists('bulan'))
{
    function bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}

if ( ! function_exists('predikats'))
{
    function predikats ($a) {
      $a = $a*100;
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

if ( ! function_exists('predikatss'))
{
    function predikatss ($a,$b) {
      $a = ($a/$b)*100;
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

if ( ! function_exists('capaianTarget'))
{
    function capaianTarget($a, $bln=1) {
      
      if ($bln < 5 ) {
        if ($a > 19) {
          return 'Tinggi';
        }  else if ($a > 10) {
          return 'Sedang';
        }  else {
          return 'Rendah';
        }
      } else if ($bln < 8) {
        if ($a > 54) {
          return 'Tinggi';
        }  else if ($a > 35) {
          return 'Sedang';
        }  else {
          return 'Rendah';
        }
      } else if ($bln < 11) {
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

if ( ! function_exists('namaTw'))
{
    function namaTw($bln=1) {
      
      if ($bln < 5 ) {
       return 'Triwulan I';
      } else if ($bln < 8) {
        return 'Triwulan II';
      } else if ($bln < 11) {
        return 'Triwulan III';
      } else {
          return 'Triwulan IV';
      }  
    }
}

if ( ! function_exists('nama_hari'))
{
    function nama_hari($tanggal)
    {
        $ubah = gmdate($tanggal, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];

        $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
        $nama_hari = "";
        if($nama=="Sunday") {$nama_hari="Minggu";}
        else if($nama=="Monday") {$nama_hari="Senin";}
        else if($nama=="Tuesday") {$nama_hari="Selasa";}
        else if($nama=="Wednesday") {$nama_hari="Rabu";}
        else if($nama=="Thursday") {$nama_hari="Kamis";}
        else if($nama=="Friday") {$nama_hari="Jumat";}
        else if($nama=="Saturday") {$nama_hari="Sabtu";}
        return $nama_hari;
    }
}

if ( ! function_exists('hitung_mundur'))
{
    function hitung_mundur($wkt)
    {
        $waktu=array(   365*24*60*60    => "tahun",
                        30*24*60*60     => "bulan",
                        7*24*60*60      => "minggu",
                        24*60*60        => "hari",
                        60*60           => "jam",
                        60              => "menit",
                        1               => "detik");

        $hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
        $hasil = array();
        if($hitung<5)
        {
            $hasil = 'kurang dari 5 detik yang lalu';
        }
        else
        {
            $stop = 0;
            foreach($waktu as $periode => $satuan)
            {
                if($stop>=6 || ($stop>0 && $periode<60)) break;
                $bagi = floor($hitung/$periode);
                if($bagi > 0)
                {
                    $hasil[] = $bagi.' '.$satuan;
                    $hitung -= $bagi*$periode;
                    $stop++;
                }
                else if($stop>0) $stop++;
            }
            $hasil=implode(' ',$hasil).' yang lalu';
        }
        return $hasil;
    }
}

if (! function_exists('kekata')) {
    function kekata($x) {
        $x = abs($x);
        $angka = array("", "satu", "dua", "tiga", "empat", "lima",
        "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($x <12) {
            $temp = " ". $angka[$x];
        } else if ($x <20) {
            $temp = kekata($x - 10). " belas";
        } else if ($x <100) {
            $temp = kekata($x/10)." puluh". kekata($x % 10);
        } else if ($x <200) {
            $temp = " seratus" . kekata($x - 100);
        } else if ($x <1000) {
            $temp = kekata($x/100) . " ratus" . kekata($x % 100);
        } else if ($x <2000) {
            $temp = " seribu" . kekata($x - 1000);
        } else if ($x <1000000) {
            $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
        } else if ($x <1000000000) {
            $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
        } else if ($x <1000000000000) {
            $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
        } else if ($x <1000000000000000) {
            $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
        }     
            return $temp;
    }
}
    

if (! function_exists('terbilang')) {
    function terbilang($x, $style=4) {
        if($x<0) {
            $hasil = "minus ". trim(kekata($x));
        } else {
            $hasil = trim(kekata($x));
        }     
        switch ($style) {
            case 1:
                $hasil = strtoupper($hasil);
                break;
            case 2:
                $hasil = strtolower($hasil);
                break;
            case 3:
                $hasil = ucwords($hasil);
                break;
            default:
                $hasil = ucfirst($hasil);
                break;
        }     
        return $hasil;
    }
} 



if (! function_exists('dd')) {
    function dd ($dt) {

        echo "<pre>";
            var_dump($dt);
        die;

    }
}

if (! function_exists('cekb')) {
    function cekb($dt = '') {
        return $dt == '1' ? 'v' : '';
    }
}

if (! function_exists('ceka')) {
    function ceka($dt = '') {
        return $dt == '1' ? 'V' : '';
    }
}

if (! function_exists('cekak')) {
    function cekak($dt = '') {
        return strlen($dt) > 1 ? 'V' : '';
    }
}

if (! function_exists('cekv')) {
    function cekv($dt = '') {
        return $dt == '' ? '' : 'V';
    }
}

if (! function_exists('cekbok')) {
    function cekbok($dt = '') {
        return $dt == '1' ? 'checked=""' : '';
    }
}

if (! function_exists('disable_cek')) {
    function disable_cek($dt = '') {
        return $dt == '1' ? '' : 'disabled=""';
    }
}

if (! function_exists('ada_menu')) {
    function ada_menu($active, $menu = NULL) {
        if ($menu == '')
            return '';
        return $active == $menu ? 'active' : '';
    }
}

if (! function_exists('ada_tidak')) {
    function ada_tidak($data = '') {

        if ($data == '')
            return 'Tidak Ada';
        return 'Ada';
    }
}

if (! function_exists('editable')) {
    function editable($data = '') {
        $CI =& get_instance();

        echo $CI->aauth->easy($data);
    }
}

if (! function_exists('catatLog')) {
    function catatLog($tipe = '',$data = '', $user = '') {
        $CI =& get_instance();

        $obj = array(
            'tipe' => $tipe,
            'data' => $data,
            'user' => $user,
            'tanggal' => date("Y-m-d H:i:s")
        );

        $CI->db->insert('log', $obj);        
    }
}

if (! function_exists('__')) {
    function __($data = '') {
        echo strtoupper(str_replace('_', ' ', $data));
    }
}

if (! function_exists('dd')) {
    function dd($data = '') {
        var_dump($data);
        die();
    }
}

if (! function_exists('rpXls')) {
    function rpXls($data) {
        return  number_format($data,0,'','');
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