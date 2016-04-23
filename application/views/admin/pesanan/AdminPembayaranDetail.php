<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>

            <ul class="sidebar-menu">
                <li class="header">Menu Utama</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Fasilitas</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminakomodasi">Akomodasi</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminperalatan">Peralatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkegiatan">Kegiatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminmakanan">Makanan</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Akun Pegawai</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahpegawai">Buat Akun
                                Pegawai</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpegawai">Daftar
                                Pegawai</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Pemesanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpesanan">Lihat Semua
                                Pesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipesanan">Konfirmasi
                                Pemesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipembayaran">Konfirmasi
                                Pembayaran Pesanan</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Akun Member</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatakun">Lihat Semua
                                Member</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminbuatakun">Buat Member Baru</a>
                        </li>
                    </ul>
                </li>


                <li class="header">Version - 0.1 beta</li>
                <!--
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
                    </ul>
                </li>
                -->
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pemesanan
                <small>Detail Pemesanan</small>
            </h1>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">


                    <div class="box box-body box-profile">
                        <h3 class="profile-username text-center">No Pesanan : <?php echo $Pesanan['idpemesanan'] ?></h3>

                        <p class="text-muted text-center">Status : <?php echo $Pesanan['status'] ?></p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Nama Pemesan</b> <span class="pull-right"><?php echo $Tamu['nama'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Pemesanan</b> <span
                                    class="pull-right"><?php echo $Pesanan['tanggalpesan'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Total Pesanan</b> <span
                                    class="pull-right">Rp <?php echo number_format($Pesanan['totalharga']) ?></span>
                            </li>
                        </ul>
                        <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
                    </div>


                    <div class="box box-body">
                        <div class="box-header with-border">
                            <h3 class="box-title">DETAIL PESANAN</h3>
                        </div>


                        <strong class="margin"><i class="fa fa-home margin-r-5"></i>AKOMODASI</strong>

                        <?php if (sizeof($Akomodasi) == 0)
                            echo '<br/><div class="text-warning">Pesanan Kosong.</div>'
                        ?>

                        <?php foreach ($Akomodasi as $value) { ?>
                            <div class="box-header with-border">
                                <div class="user-block">
                                            <span style="margin-left: 0px;"
                                                  class="username"><?php echo $value['nama']; ?>
                                                untuk <?php echo $value['jumlahtamu']; ?> orang</span>
                                            <span style="margin-left: 0px;" class="description">
                                                "<?php echo $value['ket']; ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['harga']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])); ?></span>
                                </div>
                                <div class="box-tools">
                                    <a href="pesan/batalkan/akomodasi/<?php echo $value['did']; ?>"
                                       title="Batalkan Pesanan Ini" class="btn btn-box-tool" type="button">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                            </div>

                        <?php } ?>

                        <strong class="margin"><i class="fa fa-coffee margin-r-5"></i>MAKANAN</strong>
                        <?php if (sizeof($Makanan) == 0)
                            echo '<br/><div class="text-warning">Pesanan Kosong.</div>'
                        ?>

                        <?php foreach ($Makanan as $value) { ?>
                            <div class="box-header with-border">
                                <div class="user-block">
                                    <span style="margin-left: 0px;"
                                          class="username">Paket <?php echo $value['idtipemakanan'] ?>
                                        untuk <?php echo $value['porsi'] ?>
                                        orang (Rp. <?php echo number_format($value['harga']); ?> per porsi)</span>
                                            <span style="margin-left: 0px;" class="description">
                                                <?php echo $value['ketmenu']; ?>

                                                "<?php echo $value['keterangan']; ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['harga'] * $value['porsi']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggalpemesanan'])) ?>
                                                (<?php echo $value['waktupemesanan'] ?>)</span>
                                </div>
                                <div class="box-tools">
                                    <a href="pesan/batalkan/makanan/<?php echo $value['did']; ?>"
                                       title="Batalkan Pesanan Ini" class="btn btn-box-tool" type="button">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                            </div>

                        <?php } ?>


                        <strong class="margin"><i class="fa fa-wrench margin-r-5"></i>PERALATAN</strong>

                        <?php if (sizeof($Peralatan) == 0)
                            echo '<br/><div class="text-warning">Pesanan Kosong.</div>'
                        ?>

                        <?php foreach ($Peralatan as $value) { ?>
                            <div class="box-header with-border">
                                <div class="user-block">
                                    <span style="margin-left: 0px;"
                                          class="username"><?php echo $value['jumlahdisewa'] ?> <?php echo $value['nama'] ?>
                                        (Rp. <?php echo number_format($value['hargasewa']); ?> per unit)</span>
                                            <span style="margin-left: 0px;" class="description">
                                                <?php echo $value['keterangan'] ?>
                                                <br/>
                                                "<?php echo $value['ket'] ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['hargasewa'] * $value['jumlahdisewa']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])) ?></span>
                                </div>
                                <div class="box-tools">
                                    <a href="pesan/batalkan/peralatan/<?php echo $value['did']; ?>"
                                       title="Batalkan Pesanan Ini" class="btn btn-box-tool" type="button">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                            </div>

                        <?php } ?>

                        <strong class="margin"><i class="fa fa-futbol-o margin-r-5"></i>KEGIATAN</strong>

                        <?php if (sizeof($Kegiatan) == 0)
                            echo '<br/><div class="text-warning">Pesanan Kosong. Silahkan pilih + untuk membuat pesanan baru.</div>'
                        ?>

                        <?php foreach ($Kegiatan as $value) { ?>
                            <div class="box-header with-border">
                                <div class="user-block">
                                            <span style="margin-left: 0px;"
                                                  class="username"><?php echo $value['nama'] ?>

                                                Untuk <?php echo $value['jumlahpeserta'] ?>
                                                (Rp. <?php echo number_format($value['harga']); ?> per orang)</span>
                                            <span style="margin-left: 0px;" class="description">
                                                "<?php echo $value['ket'] ?>"<br/>
                                                Rp. <?php echo number_format($value['harga'] * $value['jumlahpeserta']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])) ?></span>
                                </div>
                                <div class="box-tools">
                                    <a href="pesan/batalkan/kegiatan/<?php echo $value['did']; ?>"
                                       title="Batalkan Pesanan Ini" class="btn btn-box-tool" type="button">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </section>

    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>

</body>

<?php $this->load->view('template/script'); ?>

</html>