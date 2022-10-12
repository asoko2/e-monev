<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-03-09 03:00:05 --> Severity: Notice --> Undefined variable: window_title E:\XAMPP\PHP56\htdocs\bulan\application\views\layout\header.php 8
ERROR - 2018-03-09 03:00:05 --> Severity: Notice --> Undefined variable: tahun E:\XAMPP\PHP56\htdocs\bulan\application\views\layout\topnav.php 22
ERROR - 2018-03-09 03:00:05 --> Severity: Notice --> Undefined property: CI_Loader::$session E:\XAMPP\PHP56\htdocs\bulan\application\views\layout\topnav.php 28
ERROR - 2018-03-09 03:00:05 --> Severity: Error --> Call to a member function has_userdata() on null E:\XAMPP\PHP56\htdocs\bulan\application\views\layout\topnav.php 28
ERROR - 2018-03-09 03:00:12 --> Query error: Table '__bulan.tahun' doesn't exist - Invalid query: SELECT *
FROM `tahun`
WHERE `tahun` = 2017
ERROR - 2018-03-09 03:02:41 --> Query error: Unknown column 'tahun' in 'where clause' - Invalid query: SELECT *
FROM `master_urusan`
WHERE `tahun` = 2017
ERROR - 2018-03-09 03:32:06 --> Query error: Unknown column 'tahun' in 'where clause' - Invalid query: SELECT *
FROM `master_urusan`
WHERE `tahun` = 2017
ERROR - 2018-03-09 03:32:18 --> Query error: Unknown column 'tahun' in 'where clause' - Invalid query: SELECT *
FROM `master_urusan`
WHERE `tahun` = '2017'
ERROR - 2018-03-09 03:33:58 --> Query error: Unknown column 'tahun' in 'where clause' - Invalid query: SELECT *
FROM `master_bidang`
WHERE `tahun` = '2017'
ERROR - 2018-03-09 03:35:44 --> Query error: Unknown column 'tahun' in 'where clause' - Invalid query: SELECT *
FROM `master_unit`
WHERE `tahun` = '2017'
ERROR - 2018-03-09 03:38:59 --> Query error: Unknown column 'tahun' in 'where clause' - Invalid query: SELECT *
FROM `master_kegiatan`
WHERE `tahun` = '2017'
ERROR - 2018-03-09 04:49:18 --> Query error: Unknown column 's.tahun' in 'on clause' - Invalid query: SELECT `u`.`kode_urusan`, `u`.`kode_bidang`, `u`.`kode_unit`, `s`.`kode_subunit`, `u`.`nama_unit`, `s`.`nama_subunit`
FROM `master_unit` `u`
LEFT JOIN `master_subunit` `s` ON `s`.`tahun` = `u`.`tahun` AND `s`.`kode_urusan` = `u`.`kode_urusan` AND `s`.`kode_bidang` = `u`.`kode_bidang` AND `s`.`kode_unit` = `u`.`kode_unit`
ERROR - 2018-03-09 04:56:47 --> Severity: Notice --> Undefined variable: xcrud E:\XAMPP\PHP56\htdocs\bulan\application\controllers\Administrasi.php 53
ERROR - 2018-03-09 04:56:47 --> Severity: Error --> Call to a member function table() on null E:\XAMPP\PHP56\htdocs\bulan\application\controllers\Administrasi.php 53
ERROR - 2018-03-09 05:27:16 --> Severity: Error --> Call to undefined method Xcrud::default_tabs() E:\XAMPP\PHP56\htdocs\bulan\application\controllers\Administrasi.php 55
ERROR - 2018-03-09 05:50:42 --> Severity: Warning --> in_array() expects parameter 2 to be array, object given E:\XAMPP\PHP56\htdocs\bulan\application\core\MY_Controller.php 104
ERROR - 2018-03-09 05:50:45 --> Severity: Warning --> in_array() expects parameter 2 to be array, object given E:\XAMPP\PHP56\htdocs\bulan\application\core\MY_Controller.php 104
ERROR - 2018-03-09 05:50:58 --> Severity: Warning --> in_array() expects parameter 2 to be array, object given E:\XAMPP\PHP56\htdocs\bulan\application\core\MY_Controller.php 104
