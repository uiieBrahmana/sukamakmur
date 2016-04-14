<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-green sidebar-mini">
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
                <li class="header">AKOMODASI</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Fasilitas</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatakomodasi">Lihat Semua
                                Akomodasi</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahakomodasi">Tambah
                                Akomodasi</a></li>
                    </ul>
                </li>

                <li class="header">Version - 0.1 beta</li>

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

                        <div data-ride="carousel" class="carousel slide" id="carousel-example-generic">

                            <!--
                            <ol class="carousel-indicators">
                                <li class="active" data-slide-to="0" data-target="#carousel-example-generic"></li>
                                <li class="" data-slide-to="1" data-target="#carousel-example-generic"></li>
                                <li class="" data-slide-to="2" data-target="#carousel-example-generic"></li>
                            </ol>
                            -->
                            <ol class="carousel-indicators">
                                <?php foreach ($Size as $key => $value) { ?>
                                <li class="<?php echo ($key == 0) ? 'active' : '' ?>" data-slide-to="0" data-target="#carousel-example-generic"></li>
                                <?php } ?>
                            </ol>

                            <div class="carousel-inner">
                                <?php foreach ($Size as $key => $value) { ?>
                                <div class="item <?php echo ($key == 0) ? 'active' : '' ?>">
                                    <img alt="First slide"
                                         src="service/images/<?php echo $Akomodasi['idakomodasi'].'/'. $key ?>">
                                </div>
                                <?php } ?>
                            </div>
                            <a data-slide="prev" href="#carousel-example-generic" class="left carousel-control">
                                <span class="fa fa-angle-left"></span>
                            </a>
                            <a data-slide="next" href="#carousel-example-generic" class="right carousel-control">
                                <span class="fa fa-angle-right"></span>
                            </a>
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