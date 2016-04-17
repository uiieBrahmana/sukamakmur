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
                                            <span style="margin-left: 0px;"
                                                  class="username"><?php echo $value['nama']; ?>
                                                <br/>
                                                untuk <?php echo $value['jumlahtamu']; ?> orang</span>
                                            <span style="margin-left: 0px;" class="description">
                                                "<?php echo $value['ket']; ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['harga']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggal'])); ?></span>
                                        </div>
                                        <div class="box-tools">
                                            <a href="pesan/batalkan/akomodasi/<?php echo $value['did']; ?>"
                                               title="Batalkan Pesanan Ini" class="btn btn-box-tool" type="button">
                                                <i class="fa fa-close"></i>
                                            </a>
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
                                            <span style="margin-left: 0px;"
                                                  class="username">Paket <?php echo $value['idtipemakanan'] ?>
                                                untuk <?php echo $value['porsi'] ?>
                                                orang (Rp. <?php echo number_format($value['harga']); ?>
                                                per porsi)</span>
                                            <span style="margin-left: 0px;" class="description">
                                                <?php echo $value['ketmenu']; ?>
                                                <br/>
                                                "<?php echo $value['keterangan']; ?>"
                                                <br/>
                                                Rp. <?php echo number_format($value['harga'] * $value['porsi']); ?>
                                                - <?php echo date("d F Y", strtotime($value['tanggalpemesanan'])) ?>
                                                (<?php echo $value['waktupemesanan'] ?>)</span>
                                        </div>
                                        <div class="box-tools">
                                            <a href="pesan/batalkan/makanan/<?php echo $value['did']; ?>"
                                               title="Batalkan Pesanan Ini" class="btn btn-box-tool" type="button">
                                                <i class="fa fa-close"></i>
                                            </a>
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
                                            <a href="pesan/batalkan/peralatan/<?php echo $value['did']; ?>"
                                               title="Batalkan Pesanan Ini" class="btn btn-box-tool" type="button">
                                                <i class="fa fa-close"></i>
                                            </a>
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
                                            <a href="pesan/batalkan/kegiatan/<?php echo $value['did']; ?>"
                                               title="Batalkan Pesanan Ini" class="btn btn-box-tool" type="button">
                                                <i class="fa fa-close"></i>
                                            </a>
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
                    <div class="col-xs-8 text-center text-warning">
                        <h2><b>Total Rp. <?php echo number_format($Total); ?>,-</b></h2>
                    </div>
                    <div class="col-xs-2"></div>
                </div>
                <div class="row">
                    <div class="col-xs-3"></div>
                    <div class="col-xs-3">
                        <div class="box-body">
                            <a href="pesan/checkout/<?php echo $id; ?>" class="btn btn-info btn-block">Bayar dengan BANK
                                TRANSFER</a>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="box-body">
                            <FORM NAME="order" METHOD="Post"
                                  ACTION="https://apps.myshortcart.com/payment/request-payment/">
                                <input type="hidden" name="BASKET"
                                       value="Gold,70000.00,1,70000.00;Administration fee,5000.00,1,5000.00">
                                <input type="hidden" name="STOREID" value="00123548">
                                <input type="hidden" name="TRANSIDMERCHANT" value="000001">
                                <input type="hidden" name="AMOUNT" value="75000.00">
                                <input type="hidden" name="URL" value="http://rcsukamakmur.co.id/">
                                <input type="hidden" name=”WORDS” value=”febc0f139e58fa8b7ca7c04c9ddc22f0aed92e6d”>
                                <input type="hidden" name="CNAME" value="Buayo Putra">
                                <input type="hidden" name="CEMAIL" value="buayo@gmail.com">
                                <input type="hidden" name="CWPHONE" value="0210000011">
                                <input type="hidden" name="CHPHONE" value="0210980901">
                                <input type="hidden" name="CMPHONE" value="081298098090">
                                <input name="submit" type="submit" class="btn btn-primary btn-block" value="Bayar dengan DOKU WALLET"/>
                            </FORM>
                        </div>
                    </div>
                    <div class="col-xs-3"></div>
                </div>
                <div class="row">
                    <div class="col-xs-3"></div>
                    <div class="col-xs-3">
                        <div class="box-body">
                            <a href="pesan/batalkansemua/<?php echo $id; ?>" class="btn btn-danger btn-block">Batalkan
                                Pesanan</a>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="box-body">
                            <a href="pesan/" class="btn btn-warning btn-block">Kembali ke Daftar Pesanan</a>
                        </div>
                    </div>
                    <div class="col-xs-3"></div>
                </div>
            </section>
        </div>

    </div>

    <?php $this->load->view('template/footer'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

<script>
    $(document).ready(function () {
        $.ajax({
                method: "POST",
                url: "index.php/service/hitungtotalharga",
                data: {
                    idpemesanan: <?php echo $id ?>,
                    totalharga: <?php echo $Total ?>,
                }
            })
            .done(function (msg) {
                console.log(msg);
            });
    });
</script>

</html>