<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-yellow sidebar-mini">
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
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahpesanan">Buat Pemesanan
                                Baru</a></li>
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
                Member
                <small>Detail Member</small>
            </h1>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <div class="box box-primary">
                        <div class="box-body box-profile">

                            <h3 class="profile-username text-center"> <?php echo $Member['nama']; ?></h3>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>ID PETUGAS</b> <span class="pull-right"> <?php echo $Member['idtamu']; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Tanggal Lahir</b> <span class="pull-right"> <?php echo $Member['tanggallahir']; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Jenis Kelamin</b> <span class="pull-right"><?php echo (strcmp($Member['jeniskelamin'], 'W') == 0) ? 'Wanita' : 'Pria'; ?></span>
                                </li>
                            </ul>

                            <a href="administrator/adminlihatakun" class="btn btn-info btn-block"><b>Kembali</b></a>
                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">INFORMASI KONTAK</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-mobile-phone margin-r-5"></i> No. Telepon</strong>

                            <p class="text-muted">
                                <?php echo $Member['notelp']; ?>
                            </p>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>

                            <p class="text-muted"> <?php echo $Member['alamat']; ?></p>

                            <hr>

                            <strong><i class="fa fa-inbox margin-r-5"></i> Email</strong>

                            <p class="text-muted"> <?php echo $Member['email']; ?></p>

                            <hr>

                            <strong><i class="fa fa-user margin-r-5"></i> Username</strong>

                            <p class="text-muted"> <?php echo $Member['username']; ?></p>
                            <hr>

                            <strong><i class="fa fa-lock margin-r-5"></i> Password</strong>

                            <p class="text-muted"> <?php echo $Member['password']; ?></p>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
                <div class="col-md-3"></div>
            </div>

        </section>
    </div>
    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

</html>