<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sandbox extends CI_Controller {

    protected $dbc = array(
                        'dsn'   => '',
                        'hostname' => 'localhost',
                        'username' => 'root',
                        'password' => '',
                        'database' => 'bojonegoro2017',
                        'dbdriver' => 'mysqli',
                        'dbprefix' => '',
                        'pconnect' => FALSE,
                        'db_debug' => (ENVIRONMENT !== 'production'),
                        'cache_on' => FALSE,
                        'cachedir' => '',
                        'char_set' => 'utf8',
                        'dbcollat' => 'utf8_general_ci',
                        'swap_pre' => '',
                        'encrypt' => FALSE,
                        'compress' => FALSE,
                        'stricton' => FALSE,
                        'failover' => array(),
                        'save_queries' => TRUE
                    );

    public $db2;

    public function __construct()
    {
        parent::__construct();

        $this->db2 = $this->load->database($this->dbc, TRUE);
        
    }

    public function index()
    {
        echo 'pikir keri';
    }
    
    public function urusan()
    {
        $data = $this->db2->query("SELECT
                ref_urusan.kd_urusan,
                ref_urusan.nm_urusan,
                ref_bidang.kd_bidang,
                ref_bidang.nm_bidang,
                ref_program.kd_program,
                ref_program.nm_program,
                ref_kegiatan.kd_kegiatan,
                ref_kegiatan.nm_kegiatan
                FROM
                ref_urusan
                INNER JOIN ref_bidang ON ref_bidang.kd_urusan = ref_urusan.kd_urusan
                INNER JOIN ref_program ON ref_program.kd_urusan = ref_bidang.kd_urusan AND ref_program.kd_bidang = ref_bidang.kd_bidang
                INNER JOIN ref_kegiatan ON ref_kegiatan.kd_urusan = ref_program.kd_urusan AND ref_kegiatan.kd_bidang = ref_program.kd_bidang AND ref_kegiatan.kd_program = ref_program.kd_program")->result();
        var_dump($data);
        die;
        foreach ($data as $v) {
            $insert['parent'] = 0;
            $insert['kode'] = $v->kd_urusan;
            $insert['nama'] = $v->nm_urusan;
            $insert['tahun'] = 2017;

            $this->db->insert('m_urusan', $insert);
        }
        
        
        $bidang = $this->db2->get('ref_bidang')->result();
        $urusan = $this->db->where('tahun', 2017)->get('m_urusan');

        foreach ($bidang as $value) {
            
            $insert['parent'] = 0;
            $insert['kode'] = $v->kd_bidang;
            $insert['nama'] = $v->nm_bidang;
            $insert['tahun'] = 2017;

            $this->db->insert('m_bidang', $insert);
        }
    }


}

/* End of file Sandbox.php */
/* Location: ./application/controllers/Sandbox.php */
