<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

    <?php $this->load->view('template/tamumenu'); ?>

    <div class="content-wrapper">
        <div class="container">

            <section class="content-header">
                <h1>
                    <?php echo $SisaMakanan ?> Porsi Tersedia
                    <small><?php echo $DateSearch ?></small>
                </h1>
            </section>

            <section class="content">
                <?php foreach ($TipeMakanan as $t => $m) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="info-box bg-aqua text-center">

                                <span class="info-box-text"><h1>Paket <?php echo $m['idtipemakanan'] ?>
                                        (Rp. <?php echo number_format($m['harga']) ?>)</h1></span>

                                <?php foreach ($m['MenuMakanan'] as $v) { ?>
                                    <div class="col-lg-3 col-xs-6">
                                        <div class="info-box bg-red">
                                            <span class="info-box-text"><b>variasi menu</b></span>
                                            <span class=""><?php echo $v['keterangan'] ?></span>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>

        </div>
    </div>

    <?php $this->load->view('template/footer'); ?>
</div>

<?php $this->load->view('template/script'); ?>
</body>
</html>
