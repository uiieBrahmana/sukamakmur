<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

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
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-body">

                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Peralatan</h3>
                </div>

                <table id="student" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Peralatan</th>
                        <th>Nama</th>
                        <th>Harga sewa</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th width="170px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($Peralatan as $Value) { ?>
                        <tr>
                            <td><?php echo $Value['idperalatan'] ?></td>
                            <td><?php echo $Value['nama'] ?></td>
                            <td>Rp <?php echo number_format($Value['hargasewa']) ?></td>
                            <td><?php echo $Value['keterangan'] ?></td>
                            <td><?php echo $Value['jumlah'] ?></td>
                            <td><a href="<?php echo base_url() ?>index.php/administrator/detailperalatan/view/<?php echo $Value['idperalatan'] ?>"
                                   class="btn btn-sm btn-default">Detail</a>
                            <a href="<?php echo base_url() ?>index.php/administrator/detailperalatan/update/<?php echo $Value['idperalatan'] ?>"
                                   class="btn btn-sm btn-info">Ubah</a>
                            <a href="<?php echo base_url() ?>index.php/administrator/detailperalatan/delete/<?php echo $Value['idperalatan'] ?>"
                                   class="btn btn-sm btn-danger deleteact">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                </table>

            </div>

        </section>
    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

<script src="css/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="css/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#student').DataTable({
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [5]}
            ]
        });
    });
</script>
</html>