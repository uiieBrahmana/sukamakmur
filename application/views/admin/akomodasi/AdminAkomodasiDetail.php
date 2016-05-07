<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">AKOMODASI</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-home"></i> <span>Kelola Fasilitas</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatakomodasi">Lihat Semua
                                Akomodasi</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahakomodasi">Tambah
                                Akomodasi</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Akomodasi
                <small>Detail Akomodasi</small>
            </h1>
        </section>
        <section class="content">

            <div class="row">
                <div class="col-md-4">

                    <div class="box box-header">
                        <h3 class="profile-username text-center"><?php echo $Akomodasi['nama'] ?></h3>
                    </div>

                    <div class="box box-body">
                        <div class="box-body box-profile">
                            <p class="text-muted text-center"><?php echo $Akomodasi['keterangan'] ?></p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Kapasitas</b>
                                    <section class="pull-right"><?php echo $Akomodasi['kapasitas'] ?> orang</section>
                                </li>
                                <li class="list-group-item">
                                    <b>Harga</b>
                                    <section class="pull-right">
                                        <b>Rp. <?php echo number_format($Akomodasi['harga']) ?></b>
                                    </section>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b>
                                    <section class="pull-right"><?php echo $Akomodasi['status'] ?></section>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <a class="btn btn-block btn-danger" href="administrator/adminlihatakomodasi">Kembali</a>
                    <br>
                    <div class="box box-body">
                        <form role="form" action="administrator/detailakomodasi/view/<?php echo $Akomodasi['idakomodasi'] ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="inputphoto">Tambah gambar <?php echo $Akomodasi['nama'] ?></label>
                                <input type="file" id="fotoakomodasi" name="fotoakomodasi">

                                <p class="help-block">Foto JPG/PNG max 2MB.</p>
                            </div>

                            <input type="submit" class="btn btn-block btn-info" value="Simpan Gambar" name="submit"/>
                        </form>
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="box box-body">
                        <div class="row">
                        <?php foreach ($Size as $key => $value) { ?>
                            <div class="col-md-4">
                                <img alt="First slide" style="width: 100%"
                                     src="service/images/<?php echo $Akomodasi['idakomodasi'].'/'. $key ?>">
                                <br/>
                                <br/>
                                <a class="btn btn-block btn-danger deleteact" href="service/hapusimages/<?php echo $Akomodasi['idakomodasi'].'/'. $value['namafile'] ?>/">Hapus Gambar</a>
                            </div>
                        <?php } ?>
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