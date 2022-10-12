<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bypass extends User_Controller {

    public function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {
        $post = $this->input->post();

        if (strpos($post['name'], 'target_keuangan') !== false) {
            return $this->target_keuangan($post);
        }

        if (strpos($post['name'], 'target_keluaran') !== false) {
            return $this->target_keluaran($post);
        }

        if (strpos($post['name'], 'target_capaian') !== false) {
            return $this->target_capaian($post);
        }

        if (strpos($post['name'], 'sasaran_') !== false) {
            return $this->sasaran($post);
        }

        if (strpos($post['name'], 'realisasi_keluaran') !== false) {
            return $this->realisasi_keluaran($post);
        }

        if (strpos($post['name'], 'realisasi_keuangan') !== false) {
            return $this->realisasi_keuangan($post);
        }

        if (strpos($post['name'], 'realisasi_capaian') !== false) {
            return $this->realisasi_capaian($post);
        }

        if (strpos($post['name'], 'opd') !== false) {
            return $this->ubah_opd($post);
        }

        if (strpos($post['name'], 'users') !== false) {
            return $this->ubah_users($post);
        }
        if (strpos($post['name'], 'ganti_password') !== false) {
            return $this->ganti_password($post);
        }

        return method_exists($this, $post['name']) ? $this->{$post['name']}($post) : $this->notfound();
    }




    public function ubah_users($data)
    {
        $field = str_replace('users_', '', $data['name']);

        $this->db->where('id', $data['pk']);
        $ret = $this->db->update('auth_users', [
            $field => $data['value']
        ]);
        
        if ($ret) {
            $this->response(['status'=>true, 'value'=> $data['value']],200); 
        }
        $this->response(['status'=>false, 'message'=> _DB_ERROR_NOT_KNOW ],200);  
    }

    public function ganti_password($data)
    {

        $ret = $this->ion_auth->change_password($data['id'],$data['password_lama'],$data['password_baru']);
        
        if ($ret) {
            $this->response(['status'=>true, 'value'=> $data['value']],200); 
        }
        $this->response(['status'=>false, 'message'=> 'Gagal Mengubah Password' ],200);  
    }

    public function ubah_opd($data)
    {
        $field = str_replace('opd_', '', $data['name']);

        $this->db->where('kode_urusan', substr($data['pk'], 0,1));
        $this->db->where('kode_bidang', substr($data['pk'], 1,2));
        $this->db->where('kode_unit', substr($data['pk'], 3,2));
        $this->db->where('kode_subunit', substr($data['pk'], -2));
        $ret = $this->db->update('master_subunit', [
            $field => $data['value']
        ]);
        
        if ($ret) {
            $this->response(['status'=>true, 'value'=> $data['value']],200); 
        }
        $this->response(['status'=>false, 'message'=> _DB_ERROR_NOT_KNOW ],200);  
    }



    public function target_keuangan($data)
    {
        $field = str_replace('target_keuangan_', '', $data['name']);
       
        if (! is_numeric($data['value'])) {
            $this->response(['status'=>false, 'message'=> _IS_NOT_NUMBER ],200); 
        }

        $this->db->where('id', $data['pk']);
        $ret = $this->db->update('kegiatan', [
            $field => $data['value']
        ]);
        
        if ($ret) {
            $this->response(['status'=>true, 'value'=> $data['value']],200); 
        }
        $this->response(['status'=>false, 'message'=> _DB_ERROR_NOT_KNOW ],200);  
    }

    public function sasaran($data)
    {
        $tabel = str_replace('sasaran_', '', $data['name']);

        $this->db->where('id', $data['pk']);
        $ret = $this->db->update($tabel, [
            'sasaran' => $data['value']
        ]);
        
        if ($ret) {
            $this->response(['status'=>true, 'value'=> $data['value']],200); 
        }
        $this->response(['status'=>false, 'message'=> _DB_ERROR_NOT_KNOW ],200);  
    }

    public function realisasi_keuangan($data)
    {
        $data['name'] = str_replace('realisasi_keuangan_', '', $data['name']);
        return $this->target_keuangan($data);
    }

    public function target_keluaran($data)
    {
        $field = str_replace('target_keluaran_', '', $data['name']);
        if ($field == 'indikator' || $field == 'satuan') {
        } else {
            if (! is_numeric($data['value'])) {
                $this->response(['status'=>false, 'message'=> _IS_NOT_NUMBER ],200); 
            }
        }
        $this->db->where('id', $data['pk']);
        $ret = $this->db->update('kegiatan_keluaran', [
            $field => $data['value']
        ]);
        
        if ($ret) {
            $this->response(['status'=>true, 'value'=> $data['value']],200); 
        }
        $this->response(['status'=>false, 'message'=> _DB_ERROR_NOT_KNOW ],200); 
    }

    public function target_capaian($data)
    {
        $field = str_replace('target_capaian_', '', $data['name']);
        if ($field == 'indikator' || $field == 'satuan') {
        } else {
            if (! is_numeric($data['value'])) {
                $this->response(['status'=>false, 'message'=> _IS_NOT_NUMBER ],200); 
            }
        }
        $this->db->where('id', $data['pk']);
        $ret = $this->db->update('kegiatan_capaian', [
            $field => $data['value']
        ]);
        
        if ($ret) {
            $this->response(['status'=>true, 'value'=> $data['value']],200); 
        }
        $this->response(['status'=>false, 'message'=> _DB_ERROR_NOT_KNOW ],200);  
    }

    public function realisasi_keluaran($data)
    {
        $data['name'] = str_replace('realisasi_keluaran_', '', $data['name']);
        return $this->target_keluaran($data);
    }

    public function realisasi_capaian($data)
    {
        $data['name'] = str_replace('realisasi_capaian_', '', $data['name']);
        return $this->target_capaian($data);
    }


    public function pagu_anggaran_murni($data)
    {
        if (! is_numeric($data['value'])) {
            $this->response(['status'=>false, 'message'=> _IS_NOT_NUMBER ],200); 
        }
        $this->load->model('dpa_kegiatan_m');

        $pk = explode('.', $data['pk']);
        
        $ret = $this->dpa_kegiatan_m->updatePagu($pk,$data['value']);
        if ($ret) {
            $this->response(['status'=>true, 'value'=> $data['value']],200); 
        }
        $this->response(['status'=>false, 'message'=> _DB_ERROR_NOT_KNOW ],200); 
    }

    public function notfound()
    {
        $this->response('Operasi Gagal, perintah tidak diketahui',400);
    }
}

/* End of file Bypass.php */
/* Location: ./application/controllers/Bypass.php */
