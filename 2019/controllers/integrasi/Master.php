<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	protected $dbo;

	protected $dbtabel = [
		
		'2019' => 'apbd_2019_30m.dbo.',
		'2020' => 'apbd_2020_30m.dbo.',
	];

	public function __construct()
	{
		parent::__construct();
		$this->dbo = $this->load->database('simda', TRUE);
		ini_set('memory_limit', '-1');
	}

	public function index()
	{
		
	}

	public function response($data = NULL, $http_code = NULL)
    {
        // If the HTTP status is not NULL, then cast as an integer
        if ($http_code !== NULL)
        {
            // So as to be safe later on in the process
            $http_code = (int) $http_code;
        }

        // Set the output as NULL by default
        $output = NULL;

        if ($data === NULL && $http_code === NULL)
        {
            $http_code = 404;
        }

        // If data is not NULL and a HTTP status code provided, then continue
        elseif ($data !== NULL)
        {
          $output = json_encode($data);  
        }

        // If not greater than zero, then set the HTTP status code as 200 by default
        // Though perhaps 500 should be set instead, for the developer not passing a
        // correct HTTP status code
        $http_code > 0 || $http_code = 200;

        set_status_header($http_code);

        exit($output);
    }

    public function ref_program()
    {
    	$tahun = 2020;
        $db = $this->dbtabel[$tahun];

        $query = "
                    SELECT * FROM {$db}Ref_Program
            ";

        $master_simda = $this->dbo->query($query)->result_array();


        // insert ke dalam database monev
        foreach ($master_simda as $key => $value) {
        	$program = array(
	        	'kode_urusan' 	=> $value['Kd_Urusan'],
	        	'kode_bidang' 	=> $value['Kd_Bidang'],
	        	'kode_program' 	=> $value['Kd_Prog'],
	        	'nama_program' 	=> $value['Ket_Program'],
	        );
	        $this->db->replace('master_program', $program);
	        var_dump($this->db->last_query());
        }
       
    }

    public function ref_kegiatan()
    {
    	$tahun = 2020;
        $db = $this->dbtabel[$tahun];

        $exclude = array(
        	'4.1.3'
        );
        $query = "
                    SELECT * FROM {$db}[Ref_Kegiatan]
            ";

        $master_simda = $this->dbo->query($query)->result_array();

         // insert ke dalam database monev
        foreach ($master_simda as $key => $value) {
        	$kegiatan = array(
	        	'kode_urusan' 	=> $value['Kd_Urusan'],
	        	'kode_bidang' 	=> $value['Kd_Bidang'],
	        	'kode_program' 	=> $value['Kd_Prog'],
	        	'kode_kegiatan' 	=> $value['Kd_Keg'],
	        	'nama_kegiatan' 	=> $value['Ket_Kegiatan'],
	        );
	        $this->db->replace('master_kegiatan', $kegiatan);
	          var_dump($this->db->last_query());
        }
       
    }

    public function ta_program()
    {
    	$tahun_ke = 2;
		$tahun = 2020;

		$db = $this->dbtabel[$tahun];
		$program = array();
		// get data master ta program monev
		foreach ($this->db->get('program')->result() as $key => $value) {

			$kd_opd = $value->kode_urusan.'.'.$value->kode_bidang.'.'.$value->kode_unit.'.'.$value->kode_subunit;
			$kd_prog = $value->kode_urusan1.'.'.$value->kode_bidang1.'.'.$value->kode_program;
			$program [$kd_opd] [$kd_prog] = $value;
		}
		// var_dump($program);


		$query ="
			SELECT * FROM {$db}Ta_Program WHERE Tahun = {$tahun} AND ID_Prog != 0
		";

		$master_simda = $this->dbo->query($query)->result();
		
		foreach ($master_simda as $key => $value) {
			$sub = (isset($exclude [$value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Unit])) ? $value->Kd_Sub : 1 ;
			$kd_opd = $value->Kd_Urusan.'.'.(int)$value->Kd_Bidang.'.'.(int)$value->Kd_Unit.'.'.(int)$sub;
			if ($value->Kd_Prog < 15) {
				$kd_prog =  substr($value->ID_Prog, 0,1).'.'.(int)substr($value->ID_Prog, 1,2).'.'.(int)$value->Kd_Prog;
			}else{
				$kd_prog =  $value->Kd_Urusan.'.'.(int)$value->Kd_Bidang.'.'.(int)$value->Kd_Prog;
			}

			$exp_prog = explode('.', $kd_prog);
			// var_dump($value->ID_Prog);
			// var_dump($kd_opd);
			// var_dump($program [$kd_opd][$kd_prog]);
			
			if (!isset($program [$kd_opd] [$kd_prog])) { //update data yang sudah ada
				$insert = array(
					'kode_urusan'			=> $value->Kd_Urusan,
					'kode_bidang'			=> $value->Kd_Bidang,
					'kode_unit'				=> $value->Kd_Unit,
					'kode_subunit'			=> $sub,
					'kode_urusan1'			=> $exp_prog[0],
					'kode_bidang1'			=> $exp_prog[1],
					'kode_program'			=> $exp_prog[2],
					'is_renstra'			=> 1
				);	

				$this->db->insert('program', $insert);
				var_dump($this->db->last_query());

			}
		}

    }


    public function ta_kegiatan()
    {
    	$tahun_ke = 2;
		$tahun = 2020;
		$db = $this->dbtabel[$tahun];


		$program = array();
		// get data master ta program monev
		foreach ($this->db->get('program')->result() as $key => $value) {

			$kd_opd = $value->kode_urusan.'.'.$value->kode_bidang.'.'.$value->kode_unit.'.'.$value->kode_subunit;
			$kd_prog = $value->kode_urusan1.'.'.$value->kode_bidang1.'.'.$value->kode_program;
			$program [$kd_opd] [$kd_prog] = $value;

		}
		

		$kegiatan = array();
    	// ambil dulu kegiatan di monev
    	$this->db->select('
    		program.kode_urusan,
			program.kode_bidang,
			program.kode_unit,
			program.kode_subunit,
			program.kode_urusan1,
			program.kode_bidang1,
			program.kode_program,
			kegiatan.kode_kegiatan,
			kegiatan.sasaran
    	');
    	$this->db->join('program', 'kegiatan.program_id = program.id');
    	foreach ($this->db->get('kegiatan')->result() as $key => $value) {
    		$kd_opd = $value->kode_urusan.'.'.$value->kode_bidang.'.'.$value->kode_unit.'.'.$value->kode_subunit;
			$kd_kegiatan = $value->kode_urusan1.'.'.$value->kode_bidang1.'.'.$value->kode_program.'.'.$value->kode_kegiatan;
			$kegiatan [$kd_opd] [$kd_kegiatan] = $value;
    	}

    	$query ="
			SELECT * FROM {$db}Ta_Kegiatan  WHERE Tahun = {$tahun} AND ID_Prog != 0
		";

		$master_simda = $this->dbo->query($query)->result();
		foreach ($master_simda as $key => $value) {
			
			$sub = (isset($exclude [$value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Unit])) ? $value->Kd_Sub : 1 ;
			$kd_opd = $value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Unit.'.'.$sub;
			if ($value->Kd_Prog < 15) {
				$kd_kegiatan =  substr($value->ID_Prog, 0,1).'.'.(int)substr($value->ID_Prog, 1,2).'.'.(int)$value->Kd_Prog.'.'.$value->Kd_Keg;
				$kd_prog =  substr($value->ID_Prog, 0,1).'.'.(int)substr($value->ID_Prog, 1,2).'.'.(int)$value->Kd_Prog;
			}else{
				$kd_kegiatan =  $value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Prog.'.'.$value->Kd_Keg;
				$kd_prog =  $value->Kd_Urusan.'.'.(int)$value->Kd_Bidang.'.'.(int)$value->Kd_Prog;
			}

			$exp_kegiatan= explode('.', $kd_kegiatan);
			$data_program = $program[$kd_opd] [$kd_prog];
			$id_program = $data_program->id;
			var_dump(!isset($kegiatan [$kd_opd] [$kd_kegiatan]));
			if (!isset($kegiatan [$kd_opd] [$kd_kegiatan])) {
				$insert = array(
					'program_id'		=> $id_program,
					'kode_kegiatan'		=> $value->Kd_Keg,
					't_tahun_2'			=> floatval($value->Pagu_Anggaran),
				);
				$this->db->insert('kegiatan', $insert);
				var_dump($this->db->last_query());
			}

			
		}
    }

    public function indikator_program()
    {
    	$tahun_ke = 2;
		$tahun = 2020;

		$db = $this->dbtabel[$tahun];
		$program = array();
		// get data master ta program monev
		foreach ($this->db->get('program')->result() as $key => $value) {

			$kd_opd = $value->kode_urusan.'.'.$value->kode_bidang.'.'.$value->kode_unit.'.'.$value->kode_subunit;
			$kd_prog = $value->kode_urusan1.'.'.$value->kode_bidang1.'.'.$value->kode_program;
			$program [$kd_opd] [$kd_prog] = $value;
		}

		$query = "
			SELECT
					a.Kd_Urusan,
					a.Kd_Bidang,
					a.Kd_Unit,
					a.Kd_Sub,
					a.Kd_Prog,
					a.ID_Prog,
					a.Tolak_Ukur,
					a.Target_Angka,
					a.Target_Uraian
			FROM
				{$db}Ta_Indikator as a
			WHERE
				a.Kd_Indikator = 4
				and a.Target_Uraian is not null
			GROUP BY
			a.Tahun,
			a.Kd_Urusan,
			a.Kd_Bidang,
			a.Kd_Unit,
			a.Kd_Sub,
			a.Kd_Prog,
			a.ID_Prog,
			a.Tolak_Ukur,
			a.Target_Angka,
			a.Target_Uraian
			

		";
		$master_simda = $this->dbo->query($query)->result();
		foreach ($master_simda as $key => $value) {
			
			$sub = (isset($exclude [$value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Unit])) ? $value->Kd_Sub : 1 ;
			$kd_opd = $value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Unit.'.'.$sub;
			if ($value->Kd_Prog < 15) {
				// $kd_kegiatan =  substr($value->ID_Prog, 0,1).'.'.(int)substr($value->ID_Prog, 1,2).'.'.(int)$value->Kd_Prog.'.'.$value->Kd_Keg;
				$kd_prog =  substr($value->ID_Prog, 0,1).'.'.(int)substr($value->ID_Prog, 1,2).'.'.(int)$value->Kd_Prog;
			}else{
				// $kd_kegiatan =  $value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Prog.'.'.$value->Kd_Keg;
				$kd_prog =  $value->Kd_Urusan.'.'.(int)$value->Kd_Bidang.'.'.(int)$value->Kd_Prog;
			}

			// $exp_kegiatan= explode('.', $kd_kegiatan);
			$data_program = $program[$kd_opd] [$kd_prog];
			$id_program = $data_program->id;


			if ($value->Target_Uraian != null  ) {
				if ($value->Target_Angka != null) {
					// insert indikator
					$insert = array(
						'program_id'		=> $id_program,
						'indikator'			=> $value->Tolak_Ukur,
						'satuan'			=> $value->Target_Uraian,
						't_renstra_2'		=> $value->Target_Angka,
					);
					
					$this->db->insert('kegiatan_capaian', $insert);
					var_dump($this->db->last_query());
				}
				
			}
			
		}


    }

      public function indikator_kegiatan()
    {
    	$tahun_ke = 2;
		$tahun = 2020;

		$db = $this->dbtabel[$tahun];

		$kegiatan = array();
    	// ambil dulu kegiatan di monev
    	$this->db->select('
    		program.kode_urusan,
			program.kode_bidang,
			program.kode_unit,
			program.kode_subunit,
			program.kode_urusan1,
			program.kode_bidang1,
			program.kode_program,
			kegiatan.kode_kegiatan,
			kegiatan.sasaran,
			kegiatan.id
    	');
    	$this->db->join('program', 'kegiatan.program_id = program.id');
    	foreach ($this->db->get('kegiatan')->result() as $key => $value) {
    		$kd_opd = $value->kode_urusan.'.'.$value->kode_bidang.'.'.$value->kode_unit.'.'.$value->kode_subunit;
			$kd_kegiatan = $value->kode_urusan1.'.'.$value->kode_bidang1.'.'.$value->kode_program.'.'.$value->kode_kegiatan;
			$kegiatan [$kd_opd] [$kd_kegiatan] = $value;
    	}

		$query = "
			SELECT
				a.Kd_Urusan,
				a.Kd_Bidang,
				a.Kd_Unit,
				a.Kd_Sub,
				a.Kd_Prog,
				a.ID_Prog,
				a.Tolak_Ukur,
				a.Target_Angka,
				a.Target_Uraian,
				a.Kd_Keg
			FROM
				{$db}Ta_Indikator as a
			WHERE
				a.Kd_Indikator = 3

			GROUP BY
			a.Tahun,
			a.Kd_Urusan,
			a.Kd_Bidang,
			a.Kd_Unit,
			a.Kd_Sub,
			a.Kd_Prog,
			a.ID_Prog,
			a.Tolak_Ukur,
			a.Target_Angka,
			a.Target_Uraian,
			a.Kd_Keg

		";
		$master_simda = $this->dbo->query($query)->result();
		foreach ($master_simda as $key => $value) {
			
			$sub = (isset($exclude [$value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Unit])) ? $value->Kd_Sub : 1 ;
			$kd_opd = $value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Unit.'.'.$sub;
			if ($value->Kd_Prog < 15) {
				$kd_kegiatan =  substr($value->ID_Prog, 0,1).'.'.(int)substr($value->ID_Prog, 1,2).'.'.(int)$value->Kd_Prog.'.'.$value->Kd_Keg;
				// $kd_prog =  substr($value->ID_Prog, 0,1).'.'.(int)substr($value->ID_Prog, 1,2).'.'.(int)$value->Kd_Prog;
			}else{
				$kd_kegiatan =  $value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Prog.'.'.$value->Kd_Keg;
				// $kd_prog =  $value->Kd_Urusan.'.'.(int)$value->Kd_Bidang.'.'.(int)$value->Kd_Prog;
			}

			// $exp_kegiatan= explode('.', $kd_kegiatan);
			$data_kegiatan = $kegiatan[$kd_opd] [$kd_kegiatan];
			$id_kegiatan = $data_kegiatan->id;
			
			if ($value->Target_Uraian != null  ) {
				if ($value->Target_Angka != null) {
					if ($value->Tolak_Ukur != null) {
							// insert indikator
						$insert = array(
							'kegiatan_id'		=> $id_kegiatan,
							'indikator'			=> $value->Tolak_Ukur,
							'satuan'			=> $value->Target_Uraian,
							't_renstra_2'		=> $value->Target_Angka,
						);
						
						
						$this->db->insert('kegiatan_keluaran', $insert);
						var_dump($this->db->last_query());
					}
					
				}
				
			}
			
		}


    }



}

/* End of file Master.php */
/* Location: .//C/Users/Fila/AppData/Local/Temp/fz3temp-2/Master.php */