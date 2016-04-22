<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">

    <?php $this->load->view('template/tamumenu'); ?>

    <div class="content-wrapper">
        <div class="container">
            <section class="content-header">
                <h1>
                    Pemesanan
                    <small>Pesanan Berhasil</small>
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
                        <a href="pesan" class="btn btn-danger btn-block">Kembali</a>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </section>
        </div>

    </div>

    <?php $this->load->view('template/footer'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

<script src="css/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="css/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>

</script>

</html>