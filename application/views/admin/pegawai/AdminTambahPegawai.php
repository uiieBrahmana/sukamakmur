<!DOCTYPE html>
<html>
<?php $this->load->view('template/head') ?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header') ?>
    
    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">Menu Utama</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-home"></i> <span>Kelola Fasilitas</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminakomodasi">Akomodasi</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminperalatan">Peralatan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminkegiatan">Kegiatan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminmakanan">Makanan</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-users"></i> <span>Kelola Akun Pegawai</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/admintambahpegawai">Buat Akun Pegawai</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatpegawai">Daftar Pegawai</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-tasks"></i> <span>Kelola Pemesanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatpesanan">Lihat Semua Pesanan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminkonfirmasipesanan">Konfirmasi Pemesanan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminkonfirmasipembayaran">Konfirmasi Pembayaran</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-archive"></i> <span>Kelola Akun Member</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatakun">Lihat Semua Member</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminbuatakun">Buat Member Baru</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        
        <section class="content-header">
            <h1>
                Pegawai
                <small>Tambah Pegawai</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-body">
                        
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Pegawai Baru</h3>
                        </div>

                        <form name="add" class="form-horizontal" method="post" action="administrator/admintambahpegawai">
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
                                                <textarea required name="alamat" class="form-control" style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;"></textarea>
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
                                                <select name="jenisKelamin" class="form-control">
                                                    <option value="W">Wanita</option>
                                                    <option value="P">Pria</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="notelppemesan">Nomor
                                                Handphone</label>

                                            <div class="col-sm-3">
                                                <input required type="text"
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
                                                    <option value="Manager">Manager</option>
                                                    <option value="Administrator">Administrator Aplikasi</option>
                                                    <option value="Trainer">Trainer Kegiatan</option>
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

                            </div>
                            <div class="box-footer">
                                <input type="submit" class="btn btn-info" name="submit" value="Tambah Pegawai">
                                <button class="btn btn-default" type="reset">Reset</button>
                                <a href="administrator/adminlihatpegawai" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $this->load->view('template/footer') ?>

    <?php $this->load->view('template/sidebar') ?>
</div>
</body>
<?php $this->load->view('template/script') ?>
<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>
<script src="css/plugins/input-mask/jquery.inputmask.js"></script>

<script>
    $(document).ready(function(){

        $('input[name=tglLahir]').datepicker({
            format: 'dd MM yyyy',
            startDate: '-100y',
            endDate: '-15y',
        });
        $('input[name=tglLahir]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        $('input[name=notelp]').inputmask();

        $('form[name=add]').validate({
            rules: {
                nama:{
                  required :true
                }
            },
            showErrors: function(errorMap, errorList) {
                this.defaultShowErrors();
            }
        });

    });
</script>

</html>