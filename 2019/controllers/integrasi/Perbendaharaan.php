<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perbendaharaan extends CI_Controller {



	protected $dbo;

	protected $dbtabel = [
		
		'2019' => 'apbd_2019_30m.dbo.',
        '2020' => 'apbd_2020_30m.dbo.'
	];

	

	public function __construct()
	{
		parent::__construct();
		$this->dbo = $this->load->database('simda', TRUE);
	}

	public function index()
	{
		echo "string";
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


	public function monev_serapan_sampai_dengan_opd()
    {
        $tahun = 2020;
        $db = $this->dbtabel[$tahun];
        die('ss');

        $Kd_Urusan = $this->input->get('Kd_Urusan', false);
        $Kd_Bidang = $this->input->get('Kd_Bidang', false);
        $Kd_Unit = $this->input->get('Kd_Unit', false);
        $Kd_Sub = $this->input->get('Kd_Sub', false);
        $Kd_Urusan1 = $this->input->get('Kd_Urusan1', false);
        $Kd_Bidang1 = $this->input->get('Kd_Bidang1', false);
        $Kd_Program = $this->input->get('Kd_Program', false);
        $Kd_Kegiatan = $this->input->get('Kd_Kegiatan', false);

        $awal = $this->input->get('awal', date('Y') . '-01-01');
        $akhir = $this->input->get('akhir', date('Y') . '-12-31');

        if ($Kd_Urusan && 
            $Kd_Bidang && 
            $Kd_Unit && 
            $Kd_Urusan1 && 
            $Kd_Bidang1 && 
            $Kd_Program && 
            $Kd_Kegiatan ) {

            $ID_Prog = $Kd_Urusan1 . str_pad($Kd_Bidang1, 2, '0', STR_PAD_LEFT);
            if ($Kd_Urusan == 4 && $Kd_Bidang == 4 && $Kd_Program < 15) {
                $ID_Prog = $Kd_Urusan1 . '01';
            }

            $query = "
                    SELECT
                    Sum(cc.Nilai) as nilai
                    FROM
                    {$db}Ta_SP2D AS bb
                    INNER JOIN {$db}Ta_SPM AS aa ON aa.No_SPM = bb.No_SPM AND aa.Tahun = bb.Tahun
                    INNER JOIN {$db}Ta_SPM_Rinc AS cc ON cc.No_SPM = aa.No_SPM AND cc.Tahun = aa.Tahun
                    WHERE aa.Jn_SPM IN (1,2,3,5) 
                    and cc.Kd_Rek_1 = 5
                    and cc.Kd_Urusan = {$Kd_Urusan}
                    and cc.Kd_Bidang = {$Kd_Bidang}
                    and cc.Kd_Unit = {$Kd_Unit}
                    and cc.ID_Prog = {$ID_Prog}
                    and cc.Kd_Keg = {$Kd_Kegiatan}
                    and cc.Kd_Prog = {$Kd_Program}
                    and bb.Tgl_SP2D BETWEEN '$awal' AND '$akhir'
                    AND (select {$db}Ta_JurnalSemua.Posting from {$db}Ta_JurnalSemua where bb.No_SP2D = {$db}Ta_JurnalSemua.No_Bukti ) = 1
            ";
          
            $res = $this->dbo->query($query)->row();

            
            // ambil blud dan dana boss dari sp3b
            $query = "
            SELECT
                SUM (cc.Nilai) AS nilai
            FROM
                {$db}Ta_SP2B AS aa
            INNER JOIN {$db}Ta_SP3B AS bb ON aa.Tahun = bb.Tahun
            AND aa.No_SP3B = bb.No_SP3B
            INNER JOIN {$db}Ta_SP3B_Rinc AS cc ON cc.Tahun = bb.Tahun

            AND cc.No_SP3B = bb.No_SP3B
            WHERE  cc.Kd_Rek_1 = 5
                and cc.Kd_Urusan = {$Kd_Urusan}
                and cc.Kd_Bidang = {$Kd_Bidang}
                and cc.Kd_Unit = {$Kd_Unit}
                and cc.ID_Prog = {$ID_Prog}
                and cc.Kd_Keg = {$Kd_Kegiatan}
                and cc.Kd_Prog = {$Kd_Program}
                and bb.Tgl_SP3B BETWEEN '$awal' AND '$akhir'
            ";
            $res->nilai = $res->nilai + floatval($this->dbo->query($query)->row()->nilai);
            
           
            
            $this->response($res);

        }

        $this->response([], 401);

    }



    public function monev_serapan_sampai_dengan_sub_opd()
    {
        $tahun = 2020;
        $db = $this->dbtabel[$tahun];

        $Kd_Urusan = $this->input->get('Kd_Urusan', false);
        $Kd_Bidang = $this->input->get('Kd_Bidang', false);
        $Kd_Unit = $this->input->get('Kd_Unit', false);
        $Kd_Sub = $this->input->get('Kd_Sub', false);
        $Kd_Urusan1 = $this->input->get('Kd_Urusan1', false);
        $Kd_Bidang1 = $this->input->get('Kd_Bidang1', false);
        $Kd_Program = $this->input->get('Kd_Program', false);
        $Kd_Kegiatan = $this->input->get('Kd_Kegiatan', false);

        $awal = $this->input->get('awal', date('Y') . '-01-01');
        $akhir = $this->input->get('akhir', date('Y') . '-12-31');

        if ($Kd_Urusan && 
            $Kd_Bidang && 
            $Kd_Unit && 
            $Kd_Sub && 
            $Kd_Urusan1 && 
            $Kd_Bidang1 && 
            $Kd_Program && 
            $Kd_Kegiatan ) {

            $ID_Prog = $Kd_Urusan1 . str_pad($Kd_Bidang1, 2, '0', STR_PAD_LEFT);
            if ($Kd_Urusan == 4 && $Kd_Bidang == 4 && $Kd_Program < 15) {
                $ID_Prog = $Kd_Urusan1 . '01';
                 // die('s22');
            }

            $query = "
                    SELECT
                    Sum(cc.Nilai) as nilai
                    FROM
                    {$db}Ta_SP2D AS bb
                    INNER JOIN {$db}Ta_SPM AS aa ON aa.No_SPM = bb.No_SPM AND aa.Tahun = bb.Tahun
                    INNER JOIN {$db}Ta_SPM_Rinc AS cc ON cc.No_SPM = aa.No_SPM AND cc.Tahun = aa.Tahun
                    WHERE aa.Jn_SPM IN (1,2,3,5) 
                    and cc.Kd_Rek_1 = 5
                    and cc.Kd_Urusan = {$Kd_Urusan}
                    and cc.Kd_Bidang = {$Kd_Bidang}
                    and cc.Kd_Unit = {$Kd_Unit}
                    and cc.Kd_Sub = {$Kd_Sub}
                    and cc.ID_Prog = {$ID_Prog}
                    and cc.Kd_Keg = {$Kd_Kegiatan}
                    and cc.Kd_Prog = {$Kd_Program}
                    and bb.Tgl_SP2D BETWEEN '$awal' AND '$akhir'
            ";
            $res = $this->dbo->query($query)->row();
            
            
        
            $this->response($res);

        }

        $this->response([], 401);

    }

    public function renkas()
    {
        $tahun = 2020;
        $db = $this->dbtabel[$tahun];
       $query = "
                    SELECT
                        cc.Kd_Urusan,
                        cc.Kd_Bidang,
                        cc.Kd_Unit,
                        cc.Kd_Prog,
                        cc.ID_Prog,
                        cc.Kd_Keg,
                        SUM (cc.Jan) AS [1],
                        SUM (cc.Feb) AS [2],
                        SUM (cc.Mar) AS [3],
                        SUM (cc.Apr) AS [4],
                        SUM (cc.Mei) AS [5],
                        SUM (cc.Jun) AS [6],
                        SUM (cc.Jul) AS [7],
                        SUM (cc.Agt) AS [8],
                        SUM (cc.Sep) AS [9],
                        SUM (cc.Okt) AS [10],
                        SUM (cc.Nop) AS [11],
                        SUM (cc.Des) AS [12]
                    FROM
                        {$db}Ta_Rencana_Arsip AS cc
                    WHERE
                        cc.Kd_Rek_1 = 5
       
                    AND cc.Kd_Perubahan = (
                        SELECT
                            MAX (bb.Kd_Perubahan)
                        FROM
                            {$db}Ta_Rencana_Arsip AS bb
                        WHERE
                            bb.Kd_Rek_1 = cc.Kd_Rek_1
                        AND bb.Kd_Urusan = cc.Kd_Urusan
                        AND bb.Kd_Bidang = cc.Kd_Bidang
                        AND bb.Kd_Unit = cc.Kd_Unit
                        AND bb.ID_Prog = cc.ID_Prog
                        AND bb.Kd_Keg = cc.Kd_Keg
                        AND bb.Kd_Prog = cc.Kd_Prog
                        AND bb.Kd_Perubahan != 5
                    )
                    GROUP BY
                        cc.Kd_Urusan,
                        cc.Kd_Bidang,
                        cc.Kd_Unit,
                        cc.Kd_Prog,
                        cc.ID_Prog,
                        cc.Kd_Keg
                       

        ";
        var_dump ($query);
        die();
      
        $res = $this->dbo->query($query)->result();
        var_dump ($res);
        die();
    }

}

/* End of file Perbendaharaan 2.php */
/* Location: .//C/Users/Fila/AppData/Local/Temp/fz3temp-2/Perbendaharaan 2.php */