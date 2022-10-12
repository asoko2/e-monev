<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-03-08 03:10:26 --> Severity: Notice --> Undefined variable: window_title E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\layout\header.php 8
ERROR - 2018-03-08 03:10:26 --> Severity: Notice --> Undefined variable: tahun E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\layout\topnav.php 22
ERROR - 2018-03-08 03:10:26 --> Severity: Notice --> Undefined property: CI_Loader::$session E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\layout\topnav.php 28
ERROR - 2018-03-08 03:10:26 --> Severity: Error --> Call to a member function has_userdata() on null E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\layout\topnav.php 28
ERROR - 2018-03-08 03:10:55 --> Query error: Unknown column 'dk.tahun' in 'where clause' - Invalid query: SELECT `sb`.`kode_urusan`, `sb`.`kode_bidang`, `sb`.`kode_unit`, `sb`.`kode_subunit`, `sb`.`kode_urusan1`, `sb`.`kode_bidang1`, `k`.`kode_program`, `k`.`kode_kegiatan`, `p`.`nama_program`, `k`.`nama_kegiatan`, IFNULL(ik.kode_kegiatan, 0) AS pilih
FROM `master_subunit_bidang` `sb`
INNER JOIN `master_program` `p` ON `p`.`tahun` = `sb`.`tahun` AND `p`.`kode_urusan` = `sb`.`kode_urusan1` AND `p`.`kode_bidang` = `sb`.`kode_bidang1`
INNER JOIN `master_kegiatan` `k` ON `k`.`tahun` = `p`.`tahun` AND `k`.`kode_urusan` = `p`.`kode_urusan` AND `k`.`kode_bidang` = `p`.`kode_bidang` AND `k`.`kode_program` = `p`.`kode_program`
LEFT JOIN `dpa_kegiatan` `ik` ON `ik`.`tahun` = `sb`.`tahun` AND `ik`.`kode_urusan` = `sb`.`kode_urusan` AND `ik`.`kode_bidang` = `sb`.`kode_bidang` AND `ik`.`kode_unit` = `sb`.`kode_unit` AND `ik`.`kode_subunit` = `sb`.`kode_subunit` AND `ik`.`kode_urusan1` = `sb`.`kode_urusan1` AND `ik`.`kode_bidang1` = `sb`.`kode_bidang1` AND `ik`.`kode_program` = `k`.`kode_program` AND `ik`.`kode_kegiatan` = `k`.`kode_kegiatan`
WHERE `dk`.`tahun` = 2017
AND `ik`.`kode_kegiatan` IS NULL
AND `sb`.`kode_urusan` = '1'
AND `sb`.`kode_bidang` = '1'
AND `sb`.`kode_unit` = '1'
AND `sb`.`kode_subunit` = '1'
ERROR - 2018-03-08 03:13:16 --> Query error: Unknown column 'dk.tahun' in 'where clause' - Invalid query: SELECT `sb`.`kode_urusan`, `sb`.`kode_bidang`, `sb`.`kode_unit`, `sb`.`kode_subunit`, `sb`.`kode_urusan1`, `sb`.`kode_bidang1`, `k`.`kode_program`, `k`.`kode_kegiatan`, `p`.`nama_program`, `k`.`nama_kegiatan`, IFNULL(ik.kode_kegiatan, 0) AS pilih
FROM `master_subunit_bidang` `sb`
INNER JOIN `master_program` `p` ON `p`.`tahun` = `sb`.`tahun` AND `p`.`kode_urusan` = `sb`.`kode_urusan1` AND `p`.`kode_bidang` = `sb`.`kode_bidang1`
INNER JOIN `master_kegiatan` `k` ON `k`.`tahun` = `p`.`tahun` AND `k`.`kode_urusan` = `p`.`kode_urusan` AND `k`.`kode_bidang` = `p`.`kode_bidang` AND `k`.`kode_program` = `p`.`kode_program`
LEFT JOIN `dpa_kegiatan` `ik` ON `ik`.`tahun` = `sb`.`tahun` AND `ik`.`kode_urusan` = `sb`.`kode_urusan` AND `ik`.`kode_bidang` = `sb`.`kode_bidang` AND `ik`.`kode_unit` = `sb`.`kode_unit` AND `ik`.`kode_subunit` = `sb`.`kode_subunit` AND `ik`.`kode_urusan1` = `sb`.`kode_urusan1` AND `ik`.`kode_bidang1` = `sb`.`kode_bidang1` AND `ik`.`kode_program` = `k`.`kode_program` AND `ik`.`kode_kegiatan` = `k`.`kode_kegiatan`
WHERE `dk`.`tahun` = 2017
AND `ik`.`kode_kegiatan` IS NULL
AND `sb`.`kode_urusan` = '1'
AND `sb`.`kode_bidang` = '2'
AND `sb`.`kode_unit` = '1'
AND `sb`.`kode_subunit` = '1'
ERROR - 2018-03-08 05:45:02 --> Severity: Notice --> Undefined variable: data E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:02 --> Severity: Warning --> Invalid argument supplied for foreach() E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:04 --> Severity: Notice --> Undefined variable: data E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:04 --> Severity: Warning --> Invalid argument supplied for foreach() E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:05 --> Severity: Notice --> Undefined variable: data E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:05 --> Severity: Warning --> Invalid argument supplied for foreach() E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:05 --> Severity: Notice --> Undefined variable: data E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:05 --> Severity: Warning --> Invalid argument supplied for foreach() E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:06 --> Severity: Notice --> Undefined variable: data E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:06 --> Severity: Warning --> Invalid argument supplied for foreach() E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:07 --> Severity: Notice --> Undefined variable: data E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:45:07 --> Severity: Warning --> Invalid argument supplied for foreach() E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\anggaran\dpa\list.php 24
ERROR - 2018-03-08 05:47:10 --> 404 Page Not Found: Indexhtml/index
ERROR - 2018-03-08 05:55:34 --> Severity: Notice --> Undefined variable: hash E:\XAMPP\PHP56\htdocs\bulan\application\views\evaluasi\laporan\list.php 21
ERROR - 2018-03-08 06:49:26 --> Severity: Runtime Notice --> Only variables should be passed by reference E:\XAMPP\PHP56\htdocs\bulan\application\xcrud\xcrud.php 6692
ERROR - 2018-03-08 06:50:13 --> Severity: Runtime Notice --> Only variables should be passed by reference E:\XAMPP\PHP56\htdocs\bulan\application\xcrud\xcrud.php 6692
ERROR - 2018-03-08 06:53:40 --> Severity: Runtime Notice --> Only variables should be passed by reference E:\XAMPP\PHP56\htdocs\bulan\application\xcrud\xcrud.php 6692
ERROR - 2018-03-08 07:21:34 --> Severity: Notice --> Undefined offset: 1 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:21:34 --> Severity: Notice --> Undefined offset: 2 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:21:34 --> Severity: Notice --> Undefined offset: 3 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:21:34 --> Severity: Error --> Access to undeclared static property: Widget::$opd E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 16
ERROR - 2018-03-08 07:22:05 --> Severity: Notice --> Undefined offset: 1 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:22:05 --> Severity: Notice --> Undefined offset: 2 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:22:05 --> Severity: Notice --> Undefined offset: 3 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:22:05 --> Severity: Error --> Access to undeclared static property: Widget::$opd E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 16
ERROR - 2018-03-08 07:22:26 --> Severity: Notice --> Undefined offset: 1 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:22:26 --> Severity: Notice --> Undefined offset: 2 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:22:26 --> Severity: Notice --> Undefined offset: 3 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:22:26 --> Severity: Error --> Using $this when not in object context E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 17
ERROR - 2018-03-08 07:22:41 --> Severity: Notice --> Undefined offset: 1 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:22:41 --> Severity: Notice --> Undefined offset: 2 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:22:41 --> Severity: Notice --> Undefined offset: 3 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:22:41 --> Query error: Table 'bulanan.vv_subunit' doesn't exist - Invalid query: SELECT *
FROM `vv_subunit`
ERROR - 2018-03-08 07:23:03 --> Severity: Notice --> Undefined offset: 1 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:23:03 --> Severity: Notice --> Undefined offset: 2 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:23:03 --> Severity: Notice --> Undefined offset: 3 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 11
ERROR - 2018-03-08 07:23:03 --> Severity: Notice --> Undefined index: 000000 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 22
ERROR - 2018-03-08 07:25:15 --> Severity: Notice --> Undefined offset: 1 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 14
ERROR - 2018-03-08 07:25:15 --> Severity: Notice --> Undefined offset: 2 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 14
ERROR - 2018-03-08 07:25:15 --> Severity: Notice --> Undefined offset: 3 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 14
ERROR - 2018-03-08 07:25:15 --> Severity: Notice --> Undefined index: 000000 E:\XAMPP\PHP56\htdocs\bulan\application\libraries\Widget.php 25
ERROR - 2018-03-08 08:00:05 --> Severity: Notice --> Undefined variable: hash E:\XAMPP\PHP56\htdocs\bulan\application\views\evaluasi\laporan\list.php 21
ERROR - 2018-03-08 08:07:28 --> Severity: Notice --> Undefined variable: hash E:\XAMPP\PHP56\htdocs\bulan\application\views\evaluasi\laporan\list.php 21
ERROR - 2018-03-08 08:34:31 --> Query error: Table '__bulan.tahun' doesn't exist - Invalid query: SELECT *
FROM `tahun`
WHERE `tahun` = '2016'
ERROR - 2018-03-08 09:28:37 --> Query error: Table '__bulan.dpa_kegiatan' doesn't exist - Invalid query: SELECT `dk`.`tahun`, `dk`.`kode_urusan`, `dk`.`kode_bidang`, `dk`.`kode_unit`, `dk`.`kode_subunit`, `dk`.`kode_urusan1`, `dk`.`kode_bidang1`, `dk`.`kode_program`, `dk`.`kode_kegiatan`, `dk`.`pagu_anggaran`, `dk`.`created_at`, `dk`.`updated_at`, `dk`.`created_by`, `dk`.`updated_by`, `dk`.`verified_by`, `dk`.`kode_status`, `p`.`nama_program`, `k`.`nama_kegiatan`
FROM `dpa_kegiatan` `dk`
INNER JOIN `master_program` `p` ON `p`.`tahun` = `dk`.`tahun` AND `p`.`kode_urusan` = `dk`.`kode_urusan1` AND `p`.`kode_bidang` = `dk`.`kode_bidang1` AND `p`.`kode_program` = `dk`.`kode_program`
INNER JOIN `master_kegiatan` `k` ON `k`.`tahun` = `p`.`tahun` AND `k`.`kode_urusan` = `p`.`kode_urusan` AND `k`.`kode_bidang` = `p`.`kode_bidang` AND `k`.`kode_program` = `p`.`kode_program` AND `k`.`kode_kegiatan` = `dk`.`kode_kegiatan`
WHERE `dk`.`tahun` = '2017'
AND `dk`.`kode_urusan` = '1'
AND `dk`.`kode_bidang` = '1'
AND `dk`.`kode_unit` = '1'
AND `dk`.`kode_subunit` = '1'
ERROR - 2018-03-08 09:33:10 --> Query error: Table '__bulan.tahun' doesn't exist - Invalid query: SELECT *
FROM `tahun`
WHERE `tahun` = '2016'
