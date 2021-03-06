<!DOCTYPE html>
<html>
<?php $this->load->view('template/head') ?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header') ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">Menu Utama</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-home"></i> <span>Kelola Fasilitas</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminakomodasi">Akomodasi</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminperalatan">Peralatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkegiatan">Kegiatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminmakanan">Makanan</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-users"></i> <span>Kelola Akun Pegawai</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahpegawai">Buat Akun
                                Pegawai</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpegawai">Daftar
                                Pegawai</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-tasks"></i> <span>Kelola Pemesanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpesanan">Lihat Semua
                                Pesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipesanan">Konfirmasi
                                Pemesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipembayaran">Konfirmasi
                                Pembayaran</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-archive"></i> <span>Kelola Akun Member</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatakun">Lihat Semua
                                Member</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminbuatakun">Buat Member Baru</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pegawai
                <small>Tambah Pegawai</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Pegawai</h3>
                </div>
                <table id="student" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Pegawai</th>
                        <th>Nama Pegawai</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <!--<th>Email</th>-->
                        <th>Status Pegawai</th>
                        <th>Username</th>
                        <th width="170px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($Akun as $value) { ?>
                        <tr>
                            <td><?php echo $value['idpetugas'] ?></td>
                            <td><?php echo $value['nama'] ?></td>
                            <td><?php echo $value['alamat'] ?></td>
                            <td><?php echo $value['notelp'] ?></td>
                            <!--<td><?php // echo $value['email'] ?></td>-->
                            <td><?php echo $value['status'] ?></td>
                            <td><?php echo $value['username'] ?></td>
                            <td>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailprofilpegawai/view/<?php echo $value['idpetugas'] ?>"
                                   class="btn btn-sm btn-default">Detail</a>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailprofilpegawai/update/<?php echo $value['idpetugas'] ?>"
                                   class="btn btn-sm btn-info">Ubah</a>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailprofilpegawai/delete/<?php echo $value['idpetugas'] ?>"
                                   class="btn btn-sm btn-danger deleteact">Hapus</a>

                            </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                </table>
                <!-- Your Page Content Here -->
            </div>
        </section><!-- /.content -->
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/footer') ?>
    <?php $this->load->view('template/sidebar') ?>
</div>
</body>

<?php $this->load->view('template/script') ?>

<script src="css/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="css/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#student').DataTable({
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [6]}
            ]
        });
    });
</script>
</html>