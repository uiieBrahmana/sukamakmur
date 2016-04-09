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
                <li class="header">PERALATAN</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Peralatan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatperalatan">Lihat Semua
                                Peralatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahperalatan">Tambah
                                Peralatan</a></li>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Peralatan
                <small>Lihat Peralatan</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Peralatan</h3>
                </div>
                <table>
                    <tr>
                        <td>idperalatan</td>
                        <td><?php echo $Peralatan['idperalatan'] ?></td>
                    </tr>
                    <tr>
                        <td>nama</td>
                        <td><?php echo $Peralatan['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>hargasewa</td>
                        <td>Rp. <?php echo number_format($Peralatan['hargasewa']) ?></td>
                    </tr>
                    <tr>
                        <td>keterangan</td>
                        <td><?php echo $Peralatan['keterangan'] ?></td>
                    </tr>
                    <tr>
                        <td>jumlah</td>
                        <td><?php echo $Peralatan['jumlah'] ?></td>
                    </tr>
                </table>

                <!-- Your Page Content Here -->
            </div>
        </section><!-- /.content -->
        <!-- /.content -->
    </div>
    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

</html>
