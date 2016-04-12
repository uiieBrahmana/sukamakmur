<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pemesanan
                <small>Overview Pemesanan</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><a title="Tambah Pesanan Akomodasi / Penginapan"
                                                               style="color: white" href="pesan/akomodasi"><i
                                    class="fa fa-plus"></i></a></span>

                        <div class="info-box-content">
                            <span class=""><b>Akomodasi / Penginapan</b></span>
                            <span class="info-box-content">

                                <?php if (sizeof($Akomodasi) == 0)
                                    echo '<br/><div class="text-warning">Pesanan Kosong. Silahkan pilih + untuk membuat pesanan baru.</div>'
                                ?>

                                <?php foreach ($Akomodasi as $value) { ?>
                                    <div class="box-header with-border">
                                        <div class="user-block">
                                            <img alt="-" src="service/images/<?php echo $value['idakomodasi']; ?>"
                                                 class="img-circle">
                                            <span class="username"><?php echo $value['nama']; ?> untuk <?php echo $value['jumlahtamu']; ?> orang</span>
                                            <span class="description">
                                                "<?php echo $value['ket']; ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['harga']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])); ?></span>
                                        </div>
                                    </div>
                                <?php } ?>



                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="info-box">
                    <span class="info-box-icon bg-green">
                        <a title="Tambah Pesanan Makanan / Snack" style="color: white" href="pesan/makanan">
                            <i class="fa fa-plus"></i>
                        </a>
                    </span>

                        <div class="info-box-content">
                            <span class=""><b>Makanan / Snack</b></span>
                            <span class="info-box-content">

                                <?php if (sizeof($Makanan) == 0)
                                    echo '<br/><div class="text-warning">Pesanan Kosong. Silahkan pilih + untuk membuat pesanan baru.</div>'
                                ?>

                                <?php foreach ($Makanan as $value) { ?>
                                    <div class="box-header with-border">
                                        <div class="user-block">
                                            <span style="margin-left: 0px;" class="username">Paket <?php echo $value['idtipemakanan'] ?> untuk <?php echo $value['porsi'] ?> orang (Rp. <?php echo number_format($value['harga']); ?> per porsi)</span>
                                            <span style="margin-left: 0px;" class="description">
                                                <?php echo $value['ketmenu']; ?>
                                                <br/>
                                                "<?php echo $value['keterangan']; ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['harga'] * $value['porsi']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggalpemesanan'])) ?> (<?php echo $value['waktupemesanan'] ?>)</span>
                                        </div>
                                    </div>
                                <?php } ?>


                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="info-box">
                <span class="info-box-icon bg-yellow"><a title="Tambah Pesanan Peralatan" style="color: white"
                                                         href="pesan/peralatan"><i
                            class="fa fa-plus"></i></a></span>

                        <div class="info-box-content">
                            <span class=""><b>Peralatan / Fasilitas</b></span>
                            <span class="info-box-content">


                                <?php if (sizeof($Peralatan) == 0)
                                    echo '<br/><div class="text-warning">Pesanan Kosong. Silahkan pilih + untuk membuat pesanan baru.</div>'
                                ?>

                                <?php foreach ($Peralatan as $value) { ?>
                                    <div class="box-header with-border">
                                        <div class="user-block">
                                            <span style="margin-left: 0px;" class="username"><?php echo $value['nama'] ?> (<?php echo $value['jumlahdisewa'] ?> unit)</span>
                                            <span style="margin-left: 0px;" class="description">
                                                <?php echo $value['keterangan'] ?>
                                                <br/>
                                                "<?php echo $value['ket'] ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['hargasewa'] * $value['jumlahdisewa']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])) ?></span>
                                        </div>
                                    </div>
                                <?php } ?>



                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="info-box">
                <span class="info-box-icon bg-red"><a title="Tambah Pesanan Aktivitas / Kegiatan" style="color: white"
                                                      href="pesan/aktivitas"><i
                            class="fa fa-plus"></i></a></span>

                        <div class="info-box-content">
                            <span class=""><b>Aktivitas / Kegiatan</b></span>
                            <span class="info-box-content">


                                <?php if (sizeof($Kegiatan) == 0)
                                    echo '<br/><div class="text-warning">Pesanan Kosong. Silahkan pilih + untuk membuat pesanan baru.</div>'
                                ?>

                                <?php foreach ($Kegiatan as $value) { ?>
                                    <div class="box-header with-border">
                                        <div class="user-block">
                                            <span style="margin-left: 0px;" class="username"><a href="#"><?php echo $value['name'] ?></a></span>
                                            <span style="margin-left: 0px;" class="description"><?php echo number_format($value['harga']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])) ?></span>
                                        </div>
                                    </div>
                                <?php } ?>



                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-4">
                    <div class="box-body">
                        <a href="" class="btn btn-info btn-block">Lanjut Pembayaran</a>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="box-body">
                        <a href="" class="btn btn-danger btn-block">Batalkan Pesanan</a>
                    </div>
                </div>
                <div class="col-xs-2"></div>
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