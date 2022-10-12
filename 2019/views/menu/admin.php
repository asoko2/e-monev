<ul class="navigation">
    <li>
        <a href="<?php echo base_url('dashboard') ?>"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>
    </li>
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-briefcase"></i><span class="mm-text">Administrasi</span></a>
        <ul>
            <li><a tabindex="-1" href="<?php echo base_url('administrasi/user') ?>"><span class="mm-text">Pengguna</span></a></li>
            <li><a tabindex="-1" href="<?php echo base_url('administrasi/setup') ?>"><span class="mm-text">Setup Aplikasi</span></a></li>
        </ul>
    </li>
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">Master Data</span></a>
        <ul>
            <li><a tabindex="-1" href="<?php echo base_url('master/urusan') ?>"><span class="mm-text">Urusan</span></a></li>
            <li><a tabindex="-1" href="<?php echo base_url('master/bidang') ?>"><span class="mm-text">Bidang</span></a></li>
            <li><a tabindex="-1" href="<?php echo base_url('master/program') ?>"><span class="mm-text">Program</span></a></li>
            <li><a tabindex="-1" href="<?php echo base_url('master/kegiatan') ?>"><span class="mm-text">Kegiatan</span></a></li>
            <li><a tabindex="-1" href="<?php echo base_url('master/tujuan') ?>"><span class="mm-text">Tujuan</span></a></li>
            <li><a tabindex="-1" href="<?php echo base_url('master/sasaran') ?>"><span class="mm-text">Sasaran</span></a></li>
            <li><a tabindex="-1" href="<?php echo base_url('master/unit') ?>"><span class="mm-text">OPD</span></a></li>
            <li><a tabindex="-1" href="<?php echo base_url('master/subunit') ?>"><span class="mm-text">Sub OPD</span></a></li>
        </ul>
    </li>
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">Evaluasi</span></a>
        <ul>
            <li class="mm-dropdown">
                <a tabindex="-1" href="#"><span class="mm-text">RPJMD</span></a>
                 <ul>
                    <li><a tabindex="-1" href="<?php echo base_url('evaluasi/rpjm') ?>"><span class="mm-text">Target</span></a></li>
                    <li><a tabindex="-1" href="<?php echo base_url('evaluasi/rpjm/realisasi') ?>"><span class="mm-text">Realisasi</span></a></li>
                    <li><a tabindex="-1" href="<?php echo base_url('evaluasi/rpjm/pendorong') ?>"><span class="mm-text">Faktor Pendorong</span></a></li>
                    <li><a tabindex="-1" href="<?php echo base_url('evaluasi/rpjm/penghambat') ?>"><span class="mm-text">Faktor Penghambat</span></a></li>
                    <li><a tabindex="-1" href="<?php echo base_url('evaluasi/rpjm/t_rkpd') ?>"><span class="mm-text">Tindak Lanjut dalam RKPD</span></a></li>
                    <li><a tabindex="-1" href="<?php echo base_url('evaluasi/rpjm/t_rpjmd') ?>"><span class="mm-text">Tindak Lanjut dalam RPJMD</span></a></li>
                </ul>
            </li>
            <li class="mm-dropdown">
                <a tabindex="-1" href="#"><span class="mm-text">RENSTRA</span></a>
                <ul>
                    <li><a tabindex="-1" href="<?php echo base_url('evaluasi/renstra/index') ?>"><span class="mm-text">Target</span></a></li>
                    <li><a tabindex="-1" href="<?php echo base_url('evaluasi/renstra/realisasi') ?>"><span class="mm-text">Realisasi</span></a></li>
                </ul>
            </li>
            <li><a tabindex="-1" href="<?php echo base_url('evaluasi/rkpd') ?>"><span class="mm-text">RKPD</span></a></li>
            <li class="mm-dropdown">
                <a tabindex="-1" href="#"><span class="mm-text">RENJA</span></a>
                <ul>
                    <li>
                        <li><a tabindex="-1" href="<?php echo base_url('evaluasi/renja/target') ?>"><span class="mm-text">Target</span></a></li>
                        <li><a tabindex="-1" href="<?php echo base_url('evaluasi/renja/realisasi') ?>"><span class="mm-text">Realisasi</span></a></li>
                    </li>
                </ul>
            </li>
            <li class="mm-dropdown">
                <a tabindex="-1" href="#"><span class="mm-text">Permasalahan</span></a>
                <ul>
                    <li>
                        <li><a tabindex="-1" href="<?php echo base_url('evaluasi/permasalahan/penghambat') ?>"><span class="mm-text">Faktor Penghambat</span></a></li>
                        <li><a tabindex="-1" href="<?php echo base_url('evaluasi/permasalahan/pendorong') ?>"><span class="mm-text">Faktor Pendorong</span></a></li>
                        <li><a tabindex="-1" href="<?php echo base_url('evaluasi/permasalahan/next_tw') ?>"><span class="mm-text">Tindak Lanjut TW</span></a></li>
                        <li><a tabindex="-1" href="<?php echo base_url('evaluasi/permasalahan/next_rkpd') ?>"><span class="mm-text">Tindak Lanjut RKPD</span></a></li>
                    </li>
                </ul>
            </li>
           
        </ul>
    </li>
   
    <li><a tabindex="-1" href="<?php echo base_url('evaluasi/laporan') ?>"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">LAPORAN</span></a></li>
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">Prosentase Capaian OPD</span></a>
        <ul>
            <li><a tabindex="-1" href="<?php echo base_url('laporan/realisasi_keuangan') ?>"><span class="mm-text">Keuangan</span></a></li>
            <li><a tabindex="-1" href="<?php echo base_url('laporan/realisasi_keluaran') ?>"><span class="mm-text">Keluaran</span></a></li>
        </ul>
    </li>
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">Laporan RKPD PRINT</span></a>
        <ul>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi?opd=1010101&periode=tw1') ?>"><span class="mm-text">TRIWULAN 1</span></a></li>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi?opd=1010101&periode=tw2') ?>"><span class="mm-text">TRIWULAN 2</span></a></li>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi?opd=1010101&periode=tw3') ?>"><span class="mm-text">TRIWULAN 3</span></a></li>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi?opd=1010101&periode=tw4') ?>"><span class="mm-text">TRIWULAN 4</span></a></li>
        </ul>
    </li>
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">Laporan RKPD XLS</span></a>
        <ul>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi?opd=1010101&format=xls&periode=tw1') ?>"><span class="mm-text">TRIWULAN 1</span></a></li>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi?opd=1010101&format=xls&periode=tw2') ?>"><span class="mm-text">TRIWULAN 2</span></a></li>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi?opd=1010101&format=xls&periode=tw3') ?>"><span class="mm-text">TRIWULAN 3</span></a></li>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi?opd=1010101&format=xls&periode=tw4') ?>"><span class="mm-text">TRIWULAN 4</span></a></li>
        </ul>
    </li>

    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">Laporan RKPD XLS Plus sasaran</span></a>
        <ul>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi2?opd=1010101&format=xls&periode=tw1') ?>"><span class="mm-text">TRIWULAN 1</span></a></li>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi2?opd=1010101&format=xls&periode=tw2') ?>"><span class="mm-text">TRIWULAN 2</span></a></li>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi2?opd=1010101&format=xls&periode=tw3') ?>"><span class="mm-text">TRIWULAN 3</span></a></li>
            <li><a tabindex="-1" target="_blank" href="<?php echo base_url('laporan/rkpd_propinsi2?opd=1010101&format=xls&periode=tw4') ?>"><span class="mm-text">TRIWULAN 4</span></a></li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url('evaluasi/rpjm/laporan') ?>"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">Laporan Evaluasi RPJMD </span></a>
        
    </li>
</ul>
