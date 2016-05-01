<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">Menu Utama</li>

                <?php if(strcmp($role, 'Administrator') != 0) { ?>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-home"></i> <span>Kelola Fasilitas</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminakomodasi">Akomodasi</a></li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminperalatan">Peralatan</a></li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminkegiatan">Kegiatan</a></li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminmakanan">Makanan</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-users"></i> <span>Kelola Akun Pegawai</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahpegawai">Buat Akun
                                    Pegawai</a></li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpegawai">Daftar
                                    Pegawai</a></li>
                        </ul>
                    </li>
                <?php } ?>


                <li class="treeview">
                    <a href="#"><i class="fa fa-tasks"></i> <span>Kelola Pemesanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpesanan">Lihat Semua
                                Pesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipesanan">Konfirmasi
                                Pemesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipembayaran">Konfirmasi
                                Pembayaran</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-archive"></i> <span>Kelola Akun Member</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatakun">Lihat Semua
                                Member</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminbuatakun">Buat Member Baru</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Kode Pemesanan [<?php echo $Pesanan['idpemesanan'] ?>]
                <small>Detail Pemesanan</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-body">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Nama Pemesan</b> <span class="pull-right"><?php echo $Tamu['nama'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Pemesanan</b> <span
                                    class="pull-right"><?php echo $Pesanan['tanggalpesan'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Status Pesanan</b> <span class="pull-right"><?php echo $Pesanan['status'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Total Pesanan</b> <span
                                    class="pull-right">Rp <?php echo number_format($Pesanan['totalharga']) ?></span>
                            </li>
                        </ul>
                        <a href="administrator/adminlihatpesanan" class="btn btn-primary btn-block"><b>Kembali</b></a>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="box box-body">
                        <h3 class="profile-username text-center">Data Pembayaran</h3>

                        <?php if (sizeof($Pembayaran) == 0) { ?>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <div class="text-warning text-center">Pembayaran Belum Dilakukan</div>
                                </li>
                            </ul>
                        <?php } ?>

                        <ul class="list-group list-group-unbordered">
                            <?php foreach ($Pembayaran as $value) { ?>
                                <li class="list-group-item">
                                    <?php echo $value['idpembayaran']; ?> - <?php echo $value['tanggalbayar']; ?> - Rp.<?php echo number_format($value['nominal']); ?>
                                    <br/>
                                    <?php echo $value['metodepembayaran']; ?>
                                </li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-body">
                        <h3 class="profile-username text-center">
                            <strong class="margin"><i class="fa fa-home margin-r-5"></i>AKOMODASI</strong>
                        </h3>

                        <?php if (sizeof($Akomodasi) == 0) { ?>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <div class="text-warning text-center">Pesanan Kosong</div>
                                </li>
                            </ul>
                        <?php } ?>

                        <ul class="list-group list-group-unbordered">
                            <?php foreach ($Akomodasi as $value) { ?>
                            <li class="list-group-item">
                                <?php echo $value['nama']; ?> untuk <?php echo $value['jumlahtamu']; ?> orang.
                                <br/>
                                Rp. <?php echo number_format($value['harga']); ?> - <?php echo date("d F Y", strtotime($value['tanggal'])); ?>.
                                <br/>
                                "<?php echo $value['ket']; ?>"
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="box box-body">
                        <h3 class="profile-username text-center">
                            <strong class="margin"><i class="fa fa-coffee margin-r-5"></i>MAKANAN</strong>
                        </h3>

                        <?php if (sizeof($Makanan) == 0) { ?>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <div class="text-warning text-center">Pesanan Kosong</div>
                                </li>
                            </ul>
                        <?php } ?>

                        <ul class="list-group list-group-unbordered">
                            <?php foreach ($Makanan as $value) { ?>
                                <li class="list-group-item">
                                    Paket <?php echo $value['idtipemakanan'] ?> untuk <?php echo $value['porsi'] ?> orang (Rp. <?php echo number_format($value['harga']); ?> per porsi)
                                    <?php echo $value['ketmenu']; ?>
                                    <br/>
                                    Rp. <?php echo number_format($value['harga'] * $value['porsi']); ?>
                                    - <?php echo date("d F Y", strtotime($value['tanggalpemesanan'])) ?>
                                    (<?php echo $value['waktupemesanan'] ?>)
                                    <br/>
                                    "<?php echo $value['keterangan']; ?>"
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="box box-body">
                        <h3 class="profile-username text-center">
                            <strong class="margin"><i class="fa fa-wrench margin-r-5"></i>PERALATAN</strong>
                        </h3>

                        <?php if (sizeof($Peralatan) == 0) { ?>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <div class="text-warning text-center">Pesanan Kosong</div>
                                </li>
                            </ul>
                        <?php } ?>

                        <ul class="list-group list-group-unbordered">
                            <?php foreach ($Peralatan as $value) { ?>
                                <li class="list-group-item">
                                    <?php echo $value['jumlahdisewa'] ?> <?php echo $value['nama'] ?>.
                                    <br/>
                                    Rp. <?php echo number_format($value['hargasewa'] * $value['jumlahdisewa']); ?>
                                    - <?php echo date("d F Y", strtotime($value['tanggal'])) ?>
                                    <br/>
                                    "<?php echo $value['ket'] ?>"
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="box box-body">
                        <h3 class="profile-username text-center">
                            <strong class="margin"><i class="fa fa-futbol-o margin-r-5"></i>KEGIATAN</strong>
                        </h3>

                        <?php if (sizeof($Kegiatan) == 0) { ?>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <div class="text-warning text-center">Pesanan Kosong</div>
                                </li>
                            </ul>
                        <?php } ?>

                        <ul class="list-group list-group-unbordered">
                            <?php foreach ($Kegiatan as $value) { ?>
                                <li class="list-group-item">
                                    <?php echo $value['nama'] ?> Untuk <?php echo $value['jumlahpeserta'] ?> orang.
                                    <br/>
                                    Rp. <?php echo number_format($value['harga'] * $value['jumlahpeserta']); ?>
                                    - <?php echo date("d F Y", strtotime($value['tanggal'])) ?>
                                    <br/>
                                    "<?php echo $value['ket'] ?>"
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>

</body>

<?php $this->load->view('template/script'); ?>

</html>