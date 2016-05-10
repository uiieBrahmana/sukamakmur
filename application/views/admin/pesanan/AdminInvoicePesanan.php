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

        <div class="container">

            <section class="content-header">
                <h1>
                    Approve Pembayaran
                    <small>sukses</small>
                </h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="box box-body">

                            <table class="table table-striped">
                                <tr>
                                    <td>ID Pemesanan</td>
                                    <td><?php echo $id ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Pemesan</td>
                                    <td><?php echo $Tamu['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pemesanan</td>
                                    <td><?php echo date("d F Y (h:i:s)", strtotime($Tamu['tanggalpesan'])) ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?php echo $Tamu['status'] ?></td>
                                </tr>
                            </table>

                            <div class="text-center"><h3>Rincian Pemesanan</h3></div>

                            <?php foreach ($Akomodasi as $value) { ?>
                                <div class="box-header with-border">
                                    <div class="user-block">
                                            <span style="margin-left: 0px;"
                                                  class="username"><?php echo $value['nama']; ?>
                                                untuk <?php echo $value['jumlahtamu']; ?> orang</span>
                                            <span style="margin-left: 0px;" class="description">
                                                "<?php echo $value['ket']; ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['harga']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])); ?></span>
                                    </div>
                                    <div class="box-tools">
                                    </div>
                                </div>
                            <?php } ?>

                            <?php foreach ($Makanan as $value) { ?>
                                <div class="box-header with-border">
                                    <div class="user-block">
                                            <span style="margin-left: 0px;"
                                                  class="username">Paket <?php echo $value['idtipemakanan'] ?>
                                                untuk <?php echo $value['porsi'] ?>
                                                orang (Rp. <?php echo number_format($value['harga']); ?>
                                                per porsi)</span>
                                            <span style="margin-left: 0px;" class="description">
                                                <?php echo $value['ketmenu']; ?>

                                                "<?php echo $value['keterangan']; ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['harga'] * $value['porsi']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggalpemesanan'])) ?>
                                                (<?php echo $value['waktupemesanan'] ?>)</span>
                                    </div>
                                    <div class="box-tools">
                                    </div>
                                </div>
                            <?php } ?>

                            <?php foreach ($Peralatan as $value) { ?>
                                <div class="box-header with-border">
                                    <div class="user-block">
                                            <span style="margin-left: 0px;"
                                                  class="username"><?php echo $value['jumlahdisewa'] ?> <?php echo $value['nama'] ?>
                                                (Rp. <?php echo number_format($value['hargasewa']); ?> per unit)</span>
                                            <span style="margin-left: 0px;" class="description">
                                                <?php echo $value['keterangan'] ?>
                                                <br/>
                                                "<?php echo $value['ket'] ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['hargasewa'] * $value['jumlahdisewa']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])) ?></span>
                                    </div>
                                    <div class="box-tools">
                                    </div>
                                </div>
                            <?php } ?>

                            <?php foreach ($Kegiatan as $value) { ?>
                                <div class="box-header with-border">
                                    <div class="user-block">
                                            <span style="margin-left: 0px;"
                                                  class="username"><?php echo $value['nama'] ?>
                                                <br/>
                                                Untuk <?php echo $value['jumlahpeserta'] ?>
                                                (Rp. <?php echo number_format($value['harga']); ?> per orang)</span>
                                            <span style="margin-left: 0px;" class="description">
                                                "<?php echo $value['ket'] ?>"<br/>
                                                Rp. <?php echo number_format($value['harga'] * $value['jumlahpeserta']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])) ?></span>
                                    </div>
                                    <div class="box-tools">

                                    </div>
                                </div>
                            <?php } ?>

                            <h3 class="profile-username text-center">Data Pembayaran</h3>

                            <?php if (sizeof($Pembayaran) == 0) { ?>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <div class="text-warning text-center">Pembayaran Belum Dilakukan</div>
                                    </li>
                                </ul>
                            <?php } ?>

                            <ul class="list-group list-group-unbordered">
                                <?php $datapembayaran = 0; ?>
                                <?php foreach ($Pembayaran as $value) { ?>
                                    <li class="list-group-item">
                                        <?php echo $value['idpembayaran']; ?> - <?php echo date("d F Y (h:i:s)", strtotime($value['tanggalbayar'])); ?> - Rp.<?php echo number_format($value['nominal']); ?>
                                        <br/>
                                        <?php echo $value['metodepembayaran']; $datapembayaran = $datapembayaran + $value['nominal'] ?>
                                    </li>
                                <?php } ?>
                                <?php if(($Pesanan['totalharga'] - $datapembayaran) <= 0) { ?>
                                    <div class="text-center">
                                        <h1>Tidak ada tunggakan pembayaran.</h1>
                                    </div>
                                <?php } elseif(($Pesanan['totalharga'] - $datapembayaran) > 0) { ?>
                                    <div class="text-center">
                                        <h1>Tunggakan Pembayaran Rp. <?php echo number_format(($Pesanan['totalharga'] - $datapembayaran)) ?></h1>
                                    </div>
                                <?php } ?>
                            </ul>

                            <div class="text-center">
                                <h2><b>Total Rp. <?php echo number_format($Total); ?>,-</b></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <button onclick="print()" class="btn btn-info btn-block">Cetak Invoice</button>
                        <a href="Administrator" class="btn btn-danger btn-block">Kembali</a>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

            </section>
        </div>
    </div>
    <?php $this->load->view('template/footer'); ?>
</body>
<?php $this->load->view('template/script'); ?>
</html>
