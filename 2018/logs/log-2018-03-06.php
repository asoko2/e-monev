<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-03-06 04:05:29 --> Severity: Notice --> Undefined variable: window_title E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\layout\header.php 8
ERROR - 2018-03-06 04:05:29 --> Severity: Notice --> Undefined variable: tahun E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\layout\topnav.php 22
ERROR - 2018-03-06 04:05:30 --> Severity: Notice --> Undefined property: CI_Loader::$session E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\layout\topnav.php 28
ERROR - 2018-03-06 04:05:30 --> Severity: Error --> Call to a member function has_userdata() on null E:\XAMPP\PHP56\htdocs\monevmadiun\application\views\layout\topnav.php 28
ERROR - 2018-03-06 04:05:49 --> Query error: Unknown column 'dk.tahun' in 'where clause' - Invalid query: SELECT `sb`.`kode_urusan`, `sb`.`kode_bidang`, `sb`.`kode_unit`, `sb`.`kode_subunit`, `sb`.`kode_urusan1`, `sb`.`kode_bidang1`, `k`.`kode_program`, `k`.`kode_kegiatan`, `p`.`nama_program`, `k`.`nama_kegiatan`, IFNULL(ik.kode_kegiatan, 0) AS pilih
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
ERROR - 2018-03-06 04:05:52 --> Query error: Unknown column 'dk.tahun' in 'where clause' - Invalid query: SELECT `sb`.`kode_urusan`, `sb`.`kode_bidang`, `sb`.`kode_unit`, `sb`.`kode_subunit`, `sb`.`kode_urusan1`, `sb`.`kode_bidang1`, `k`.`kode_program`, `k`.`kode_kegiatan`, `p`.`nama_program`, `k`.`nama_kegiatan`, IFNULL(ik.kode_kegiatan, 0) AS pilih
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
