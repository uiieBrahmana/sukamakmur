<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">MAKANAN</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-glass"></i> <span>Kelola Makanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatmakanan">Lihat Semua
                                Makanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahmakanan">Tambah
                                Makanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihattipemakanan">Lihat Tipe
                                Makanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahtipemakanan">Tambah Tipe
                                Makanan</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $SisaMakanan ?><sup style="font-size: 20px"> Porsi</sup></h3>

                            <p>Makanan Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

</html>