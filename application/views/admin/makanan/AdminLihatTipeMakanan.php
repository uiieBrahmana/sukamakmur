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
                Makanan
                <small>Lihat Tipe Makanan</small>
            </h1>

        </section>

        <section class="content">
            <div class="box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Tipe Makanan</h3>
                </div>
                <table id="student" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Tipe Makanan</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th width="170px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($TipeMakanan as $Value) { ?>
                        <tr>
                            <td><?php echo $Value['idtipemakanan'] ?></td>
                            <td><?php echo $Value['keterangan'] ?></td>
                            <td>Rp <?php echo number_format($Value['harga']) ?></td>
                            <td>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailtipemakanan/view/<?php echo $Value['idtipemakanan'] ?>"
                                   class="btn btn-sm btn-default">Detail</a>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailtipemakanan/update/<?php echo $Value['idtipemakanan'] ?>"
                                   class="btn btn-sm btn-info">Ubah</a>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailtipemakanan/delete/<?php echo $Value['idtipemakanan'] ?>"
                                   class="btn btn-sm btn-danger">Hapus</a>
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
                {'bSortable': false, 'aTargets': [3]}
            ]
        });
    });
</script>
</html>