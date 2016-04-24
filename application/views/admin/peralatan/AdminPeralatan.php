<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('template/head'); ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">PERALATAN</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-gear"></i> <span>Kelola Peralatan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatperalatan">Lihat Semua Peralatan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/admintambahperalatan">Tambah Peralatan</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <small>Peralatan</small>
            </h1>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-lg-3">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $CountPeralatan ?><sup style="font-size: 20px"> Unit</sup></h3>

                            <p>Peralatan Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
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

</html>