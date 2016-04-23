<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">Menu Utama</li>

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

                <li class="treeview">
                    <a href="#"><i class="fa fa-tasks"></i> <span>Kelola Pemesanan</span> <i
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
                Akun Baru
                <small>Update Akun</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Data Akun</h3>
                        </div>

                        <form name="add" class="form-horizontal" method="post" action="administrator/adminupdateakun">

                            <input type="hidden" name="idtamu" value="<?php echo $Member['idtamu']; ?>">

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Nama Lengkap</label>

                                            <div class="col-sm-5">
                                                <input required type="text" placeholder="Nama Lengkap"
                                                       name="nama" value="<?php echo $Member['nama']; ?>"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Tanggal
                                                Lahir</label>

                                            <div class="col-sm-2">
                                                <input required type="text" placeholder="Tanggal Lahir"
                                                       name="tanggallahir"
                                                       value="<?php echo date("d F Y", strtotime($Member['tanggallahir'])); ?>"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Jenis
                                                Kelamin</label>

                                            <div class="col-sm-3">
                                                <select name="jeniskelamin" id="" class="form-control">
                                                    <?php if ($Member['jeniskelamin'] == 'W') { ?>
                                                        <option selected value="W">Wanita</option>
                                                        <option value="P">Pria</option>
                                                    <?php } else { ?>
                                                        <option value="W">Wanita</option>
                                                        <option selected value="P">Pria</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Alamat</label>

                                            <div class="col-sm-5">
                                                <textarea name="alamat" required
                                                          style="min-width: 100%; max-width: 100%; min-height: 60px; max-height: 120px;"
                                                          class="form-control"><?php echo $Member['alamat']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Email</label>

                                            <div class="col-sm-4">
                                                <input required type="email" placeholder="Email"
                                                       name="email" value="<?php echo $Member['email']; ?>"
                                                       class="form-control col-lg-3">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="notelppemesan">Nomor
                                                Handphone</label>

                                            <div class="col-sm-4">
                                                <input required type="text" id="notelppemesan"
                                                       data-inputmask="'mask': ['9999-999-99999']"
                                                       data-mask value="<?php echo $Member['notelp']; ?>"
                                                       name="notelp" class="form-control col-lg-3">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Username</label>

                                            <div class="col-sm-3">
                                                <input required type="text" placeholder="Username"
                                                       name="username" value="<?php echo $Member['username']; ?>"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Password</label>

                                            <div class="col-sm-3">
                                                <input required type="password" placeholder="Password"
                                                       name="password" value="<?php echo $Member['password']; ?>"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer text-center">
                                <input type="submit" class="btn btn-info" name="submit" value="Update Data Akun">
                                <button class="btn btn-default" type="reset">Reset</button>
                                <input type="hidden" name="update" value="update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>
<script src="css/plugins/input-mask/jquery.inputmask.js"></script>

<script>
    $(document).ready(function () {
        $('input[name=tanggallahir]').datepicker({format: 'dd MM yyyy'});
        $('input[name=tanggallahir]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        $('input[name=notelp]').inputmask();
        $('form[name=add]').validate();

    });
</script>

</html>