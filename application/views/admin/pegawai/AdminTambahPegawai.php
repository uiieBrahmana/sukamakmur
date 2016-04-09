<!DOCTYPE html>
<html>
<?php $this->load->view('template/head') ?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header') ?>
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pegawai
                <small>Tambah Pegawai</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Pegawai Baru</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <form name="add" class="form-horizontal" method="post" action="index.php/Administrator/admintambahpegawai">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Nama Pegawai</label>

                                            <div class="col-sm-8">
                                                <input required type="text" placeholder="Nama Pegawai" 
                                                       name="nama"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Alamat</label>

                                            <div class="col-sm-5">
                                                <textarea required name="alamat" style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Tanggal Lahir</label>

                                            <div class="col-sm-3">
                                                <input required type="text" placeholder="Tanggal Lahir" 
                                                       name="tglLahir"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Jenis Kelamin</label>

                                            <div class="col-sm-3">
                                                <select name="jenisKelamin" id="" class="form-control">
                                                    <option value="W">Wanita</option>
                                                    <option value="P">Pria</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="notelppemesan">Nomor
                                                Handphone</label>

                                            <div class="col-sm-3">
                                                <input required type="text" id="notelppemesan"
                                                       data-inputmask="'mask': ['9999-999-99999']"
                                                       data-mask
                                                       name="notelp" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Email</label>

                                            <div class="col-sm-5">
                                                <input required type="email" placeholder="Email" 
                                                       name="email"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Status</label>

                                            <div class="col-sm-3">
                                                <select class="form-control" name="status">
                                                    <option value="manager">Manager</option>
                                                    <option value="administrator">Admin Aplikasi</option>
                                                    <option value="petugaslain">Petugas lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Username</label>

                                            <div class="col-sm-5">
                                                <input required type="text" placeholder="Username" 
                                                       name="username"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Password</label>

                                            <div class="col-sm-5">
                                                <input required type="password" placeholder="Password"
                                                       name="password"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <input type="submit" class="btn btn-info" name="_submit" value="Tambah Pegawai">
                                <button class="btn btn-default" type="reset">Reset</button>
                            </div><!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
        <!-- /.content -->
    </div>

    <!-- Main Footer -->
    <?php $this->load->view('template/footer') ?>

    <!-- Control Sidebar -->
    <!-- Control Sidebar -->
    <?php $this->load->view('template/sidebar') ?>
</div>
</body>
<?php $this->load->view('template/script') ?>
<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>
<script src="css/plugins/input-mask/jquery.inputmask.js"></script>

<script>
    $(document).ready(function(){
        $('input[name=tglLahir]').datepicker();
        $('input[name=notelp]').inputmask();
        $('form[name=add]').validate({
            rules: {
                nama:{
                  required :true
                },
                kapasitas: {
                    required: true,
                    number: true
                },
                harga: {
                    required: true,
                    number: true
                }
            },
            showErrors: function(errorMap, errorList) {
                this.defaultShowErrors();
            }
        });

    });
</script>

</html>