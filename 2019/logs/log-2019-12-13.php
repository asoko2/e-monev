<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-13 05:33:51 --> Query error: General SQL Server error: Check messages from the SQL Server [229] (severity 14) [
                    SELECT
                    Sum(cc.Nilai) as nilai
                    FROM
                    apbd_2019_30m.dbo.Ta_SP2D AS bb
                    INNER JOIN apbd_2019_30m.dbo.Ta_SPM AS aa ON aa.No_SPM = bb.No_SPM AND aa.Tahun = bb.Tahun
                    INNER JOIN apbd_2019_30m.dbo.Ta_SPM_Rinc AS cc ON cc.No_SPM = aa.No_SPM AND cc.Tahun = aa.Tahun
                    WHERE aa.Jn_SPM IN (1,2,3,5) 
                    and cc.Kd_Rek_1 = 5
                    and cc.Kd_Urusan = 4
                    and cc.Kd_Bidang = 2
                    and cc.Kd_Unit = 1
                    and cc.Kd_Sub = 1
                    and cc.Kd_Keg = 6
                    and cc.Kd_Prog = 1
                    and bb.Tgl_SP2D BETWEEN '2019-10-01' AND '2019-12-31'
            	] - Invalid query: 
                    SELECT
                    Sum(cc.Nilai) as nilai
                    FROM
                    apbd_2019_30m.dbo.Ta_SP2D AS bb
                    INNER JOIN apbd_2019_30m.dbo.Ta_SPM AS aa ON aa.No_SPM = bb.No_SPM AND aa.Tahun = bb.Tahun
                    INNER JOIN apbd_2019_30m.dbo.Ta_SPM_Rinc AS cc ON cc.No_SPM = aa.No_SPM AND cc.Tahun = aa.Tahun
                    WHERE aa.Jn_SPM IN (1,2,3,5) 
                    and cc.Kd_Rek_1 = 5
                    and cc.Kd_Urusan = 4
                    and cc.Kd_Bidang = 2
                    and cc.Kd_Unit = 1
                    and cc.Kd_Sub = 1
                    and cc.Kd_Keg = 6
                    and cc.Kd_Prog = 1
                    and bb.Tgl_SP2D BETWEEN '2019-10-01' AND '2019-12-31'
            	
ERROR - 2019-12-13 05:33:53 --> Query error: General SQL Server error: Check messages from the SQL Server [229] (severity 14) [
                    SELECT
                    Sum(cc.Nilai) as nilai
                    FROM
                    apbd_2019_30m.dbo.Ta_SP2D AS bb
                    INNER JOIN apbd_2019_30m.dbo.Ta_SPM AS aa ON aa.No_SPM = bb.No_SPM AND aa.Tahun = bb.Tahun
                    INNER JOIN apbd_2019_30m.dbo.Ta_SPM_Rinc AS cc ON cc.No_SPM = aa.No_SPM AND cc.Tahun = aa.Tahun
                    WHERE aa.Jn_SPM IN (1,2,3,5) 
                    and cc.Kd_Rek_1 = 5
                    and cc.Kd_Urusan = 4
                    and cc.Kd_Bidang = 2
                    and cc.Kd_Unit = 1
                    and cc.Kd_Sub = 1
                    and cc.Kd_Keg = 7
                    and cc.Kd_Prog = 1
                    and bb.Tgl_SP2D BETWEEN '2019-01-01' AND '2019-03-31'
            	] - Invalid query: 
                    SELECT
                    Sum(cc.Nilai) as nilai
                    FROM
                    apbd_2019_30m.dbo.Ta_SP2D AS bb
                    INNER JOIN apbd_2019_30m.dbo.Ta_SPM AS aa ON aa.No_SPM = bb.No_SPM AND aa.Tahun = bb.Tahun
                    INNER JOIN apbd_2019_30m.dbo.Ta_SPM_Rinc AS cc ON cc.No_SPM = aa.No_SPM AND cc.Tahun = aa.Tahun
                    WHERE aa.Jn_SPM IN (1,2,3,5) 
                    and cc.Kd_Rek_1 = 5
                    and cc.Kd_Urusan = 4
                    and cc.Kd_Bidang = 2
                    and cc.Kd_Unit = 1
                    and cc.Kd_Sub = 1
                    and cc.Kd_Keg = 7
                    and cc.Kd_Prog = 1
                    and bb.Tgl_SP2D BETWEEN '2019-01-01' AND '2019-03-31'
            	
