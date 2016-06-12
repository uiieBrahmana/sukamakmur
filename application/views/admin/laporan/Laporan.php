<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">Menu Utama</li>

                <?php if (strcmp($role, 'Administrator') != 0) { ?>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-home"></i> <span>Kelola Fasilitas</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminakomodasi">Akomodasi</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminperalatan">Peralatan</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminkegiatan">Kegiatan</a>
                            </li>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Laporan
            </h1>
        </section>

        <section class="content">
            <div class="box box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">Buat Laporan Pemesanan</h3>
                </div>
                <br/>

                <div class="row">
                    <div class="col-lg-5">
                        <div class="box box-body">
<<<<<<< HEAD
                            <form name="report" role="form" method="post" action="report/pdf">
                                <div class="form-group">
                                    <label for="per">Tipe Laporan</label>
                                    <select name="tipe" id="" class="form-control">
                                        <option value="1">Laporan Pemasukan</option>
                                        <option value="2">Laporan Pegawai</option>
                                        <option value="3">Laporan Akomodasi</option>
                                        <option value="4">Laporan Menu Makanan</option>
                                        <option value="5">Laporan Peralatan</option>
                                        <option value="6">Laporan Kegiatan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="per">Periode Mulai</label>
                                    <input id="monthpicker1" name="picker1" type="text" placeholder="dari"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="per">Sampai Periode</label>
                                    <input id="monthpicker2" name="picker2" type="text" placeholder="sampai"
                                           class="form-control">
                                </div>
                                <div class="box-footer">
                                    <button id="goreport" class="btn btn-primary" type="submit">Submit</button>
                                </div>

                                <?php if (isset($_GET['status'])) { ?>

                                <?php } ?>
=======
                            <form role="form" method="post" action="report/pdf">
                                <div class="form-group">
                                    <label for="per">Periode</label>
                                    <input id="monthpicker" name="picker" type="text" placeholder="Periode" class="form-control">
                                </div>
                                <div class="box-footer">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
>>>>>>> c4e0f3ce92028d19d01a656d7674dcd7e1355bfc
                            </form>
                        </div>
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
<script>
    $(document).ready(function () {
<<<<<<< HEAD
        $("#monthpicker1").datepicker({
            format: "dd MM yyyy"
        });
        $("#monthpicker2").datepicker({
            format: "dd MM yyyy"
        });

        $('#monthpicker1').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('#monthpicker2').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('#goreport').on('click', function (event) {
            event.preventDefault();
            var startDate = new Date($("#monthpicker1").val());
            var endDate = new Date($("#monthpicker2").val());
            if (endDate > startDate) {

                //ajax call
                var postchecker = $.post("service/pdf", $("form[name=report]").serialize());
                postchecker.done(function (data) {
                    if(data == 0) {
                        bootbox.confirm("Laporan diperiode ini kosong. tetap lanjutkan?", function(result) {
                            if (result) {
                                $('form[name=report]').submit();
                            }
                        });
                    } else if(data > 0) {
                        $('form[name=report]').submit();
                    }
                });


            } else {
                bootbox.alert("periode sampai harus lebih besar.");
            }
=======
        $("#monthpicker").datepicker({
            format: "MM yyyy",
            startView: "months",
            minViewMode: "months"
>>>>>>> c4e0f3ce92028d19d01a656d7674dcd7e1355bfc
        });
    });
</script>
</html>