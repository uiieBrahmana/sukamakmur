<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="css/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Manager</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

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
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminakomodasi">Akomodasi</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminperalatan">Peralatan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminkegiatan">Kegiatan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminmakanan">Makanan</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Akun Pegawai</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/admintambahpegawai">Buat Akun Pegawai</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatpegawai">Daftar Pegawai</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Pemesanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/admintambahpesanan">Buat Pemesanan Baru</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatpesanan">Lihat Semua Pesanan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminkonfirmasipesanan">Konfirmasi Pemesanan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminkonfirmasipembayaran">Konfirmasi Pembayaran Pesanan</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Akun Member</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatakun">Lihat Semua Member</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminbuatakun">Buat Member Baru</a></li>
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
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-md-9">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <!--                            <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">-->

                            <h3 class="profile-username text-center">No Pesanan : 123456</h3>

                            <p class="text-muted text-center">Status : Lunas</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Nama Pemesan</b> <a class="pull-right">Agritha Melody</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tanggal Pemesanan</b> <a class="pull-right">26 November 2015</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Pesanan</b> <a class="pull-right">Rp 5.625.000</a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">DETAIL PESANAN</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-coffee margin-r-5"></i>MAKANAN</strong>

                            <p class="text-muted">
                                081235645879
                            </p>

                            <hr>

                            <strong><i class="fa fa-home margin-r-5"></i>AKOMODASI</strong>

                            <p class="text-muted">Jalan KH. Hasyim Ashari gang Masjid no 2 Tangerang</p>

                            <hr>

                            <strong><i class="fa fa-wrench margin-r-5"></i>PERALATAN</strong>

                            <p class="text-muted">nurcholid@yahoo.com</p>

                            <hr>

                            <strong><i class="fa fa-futbol-o margin-r-5"></i>KEGIATAN</strong>

                            <p class="text-muted">nurcholid</p>
                            <hr>

                            <strong><i class="fa fa-futbol-o margin-r-5"></i> Password</strong>
                            <p class="text-muted">12345</p>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>

    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>

</body>

<?php $this->load->view('template/script'); ?>

</html>