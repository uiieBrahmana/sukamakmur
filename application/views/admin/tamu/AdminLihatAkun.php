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
                <li class="header">Menu Utama</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Fasilitas</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminakomodasi">Akomodasi</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminperalatan">Peralatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkegiatan">Kegiatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminmakanan">Makanan</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Akun Pegawai</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahpegawai">Buat Akun
                                Pegawai</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpegawai">Daftar
                                Pegawai</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Pemesanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahpesanan">Buat Pemesanan
                                Baru</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpesanan">Lihat Semua
                                Pesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipesanan">Konfirmasi
                                Pemesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipembayaran">Konfirmasi
                                Pembayaran Pesanan</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Akun Member</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatakun">Lihat Semua
                                Member</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminbuatakun">Buat Member Baru</a>
                        </li>
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
        <section class="content-header">
            <h1>
                Pegawai
                <small>Tambah Pegawai</small>
            </h1>
        </section>

        <section class="content">
            <div class="box box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Pegawai</h3>
                </div>
                <table id="student" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Tamu</th>
                        <th>Nama Tamu</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($Akun as $value) { ?>
                        <tr>
                            <td><?php echo $value['idtamu'] ?></td>
                            <td><?php echo $value['nama'] ?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td><?php echo $value['notelp'] ?></td>
                            <td><?php echo $value['username'] ?></td>
                            <td>*******</td>
                            <td>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailprofilmember/view/<?php echo $value['idtamu'] ?>"
                                   class="btn btn-sm btn-default">Detail</a>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailprofilmember/update/<?php echo $value['idtamu'] ?>"
                                   class="btn btn-sm btn-info">Ubah</a>
                                <a href="<?php echo base_url() ?>index.php/administrator/detailprofilmember/delete/<?php echo $value['idtamu'] ?>"
                                   class="btn btn-sm btn-danger">Hapus</a>

                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <!-- Your Page Content Here -->
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
                {'bSortable': false, 'aTargets': [6]}
            ]
        });
    });
</script>

</html>