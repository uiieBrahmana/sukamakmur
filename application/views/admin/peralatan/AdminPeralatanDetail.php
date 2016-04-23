<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-yellow sidebar-mini">
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
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatperalatan">Lihat Semua
                                Peralatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahperalatan">Tambah
                                Peralatan</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Peralatan
                <small>Lihat Peralatan</small>
            </h1>
        </section>

        <section class="content">
            <div class="box box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Data Peralatan</h3>
                </div>
                <table class="table table-striped">
                    <tr>
                        <td>ID</td>
                        <td><?php echo $Peralatan['idperalatan'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><?php echo $Peralatan['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Harga Sewa</td>
                        <td>Rp. <?php echo number_format($Peralatan['hargasewa']) ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><?php echo $Peralatan['keterangan'] ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><?php echo $Peralatan['jumlah'] ?> unit</td>
                    </tr>
                </table>
                <a href="administrator/adminlihatperalatan" class="btn btn-info">Kembali</a>
            </div>
        </section>
    </div>
    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

</html>
