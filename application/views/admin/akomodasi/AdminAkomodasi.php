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
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatakomodasi">Lihat Semua Akomodasi</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/admintambahakomodasi">Tambah Akomodasi</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard Akomodasi
                <small>Control panel</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $CountAkomodasi ?><sup style="font-size: 20px"> Unit</sup></h3>

                            <p>Akomodasi Tersedia</p>
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