<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">Menu Utama</li>

                <?php if(strcmp($role, 'Administrator') != 0) { ?>
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
                <?php } ?>

                <li class="treeview">
                    <a href="#"><i class="fa fa-tasks"></i> <span>Kelola Pemesanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatpesanan">Lihat Semua Pesanan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminkonfirmasipesanan">Konfirmasi Pemesanan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminkonfirmasipembayaran">Konfirmasi Pembayaran</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-archive"></i> <span>Kelola Akun Member</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatakun">Lihat Semua Member</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminbuatakun">Buat Member Baru</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pesanan
                <small>Daftar Pemesanan</small>
            </h1>
        </section>

        <section class="content">
            <div class="box box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">Semua Pemesanan yang menunggu approval Pembayaran</h3>
                </div>
                <table width="100%" id="student" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No Pemesanan</th>
                        <th>Tamu</th>
                        <th>Tanggal Pesan</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th width="170px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($Pesanan as $Value) { ?>
                        <tr>
                            <td><?php echo $Value['idpemesanan'] ?></td>
                            <td><?php echo $Value['namatamu'] ?></td>
                            <td><?php echo date("d F Y (h:i:s)", strtotime($Value['tanggalpesan']));  ?></td>
                            <td>Rp. <?php echo number_format($Value['totalharga']) ?></td>
                            <td>
                                <?php if(strcmp($Value['status'], 'CHECKOUT') == 0) { ?>
                                    Menunggu Pembayaran
                                <?php } else { ?>
                                    <?php echo $Value['status'] ?>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url()?>index.php/administrator/adminkonfirmasipembayarandetail/<?php echo $Value['idpemesanan'] ?>" class="btn btn-sm btn-info">Detail</a>
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

</body>

<?php $this->load->view('template/script'); ?>

<script src="css/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="css/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('#student').DataTable({
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [5]}
            ]
        });
    });
</script>
</html>