<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">KEGIATAN</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-bicycle"></i> <span>Kelola Kegiatan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatkegiatan">Lihat Semua
                                Kegiatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahkegiatan">Tambah
                                Kegiatan</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Kegiatan
                <small>Lihat Kegiatan</small>
            </h1>
        </section>

        <section class="content">
            <div class="box box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Kegiatan</h3>
                </div>
                <table class="table table-striped">
                    <tr>
                        <td>idkegiatan</td>
                        <td><?php echo $Kegiatan['idkegiatan'] ?></td>
                    </tr>
                    <tr>
                        <td>nama</td>
                        <td><?php echo $Kegiatan['nama'] ?></td>
                    </tr>

                    <tr>
                        <td>pesertamin</td>
                        <td><?php echo $Kegiatan['pesertamin'] ?> orang</td>
                    </tr>
                    <tr>
                        <td>pesertamax</td>
                        <td><?php echo $Kegiatan['pesertamax'] ?> orang</td>
                    </tr>
                    <tr>
                        <td>keterangan</td>
                        <td><?php echo $Kegiatan['keterangan'] ?></td>
                    </tr>
                    <tr>
                        <td>harga</td>
                        <td><?php echo number_format($Kegiatan['harga']) ?> per orang</td>
                    </tr>
                </table>
                <a class="btn btn-info" href="administrator/adminlihatkegiatan"> Kembali</a>
            </div>
        </section>
    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

</html>