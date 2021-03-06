<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-yellow sidebar-mini">
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
                    <h3 class="box-title">Daftar Kegiatan</h3>
                </div>
                <table id="student" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Kegiatan</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Peserta Min</th>
                        <th>Peserta Max</th>
                        <th width="170px">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($Kegiatan as $Value) { ?>
                        <tr>
                            <td><?php echo $Value['idkegiatan'] ?></td>
                            <td><?php echo $Value['nama'] ?></td>
                            <td>Rp <?php echo number_format($Value['harga']) ?></td>
                            <td><?php echo $Value['pesertamin'] ?></td>
                            <td><?php echo $Value['pesertamax'] ?></td>
                            <td>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailkegiatan/view/<?php echo $Value['idkegiatan'] ?>"
                                   class="btn btn-sm btn-default">Detail</a>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailkegiatan/update/<?php echo $Value['idkegiatan'] ?>"
                                   class="btn btn-sm btn-info">Ubah</a>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailkegiatan/delete/<?php echo $Value['idkegiatan'] ?>"
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