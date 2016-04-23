<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-red-light layout-top-nav">
<div class="wrapper">

    <?php $this->load->view('template/tamumenu'); ?>

    <div class="content-wrapper">
        <div class="container">

            <section class="content-header">
                <h1>
                </h1>
            </section>

            <section class="content">

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $SisaMakanan ?><sup style="font-size: 20px"> Porsi</sup></h3>

                            <p>Makanan Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <?php if($SisaMakanan > 0){ ?>
                            <a href="pesan/overview/new" class="small-box-footer">Pesan Sekarang <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $CountAkomodasi ?><sup style="font-size: 20px"> Unit</sup></h3>

                            <p>Akomodasi Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <?php if($CountAkomodasi > 0){ ?>
                            <a href="pesan/overview/new" class="small-box-footer">Pesan Sekarang <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $CountPeralatan ?><sup style="font-size: 20px"> Unit</sup></h3>

                            <p>Peralatan Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <?php if($CountPeralatan > 0){ ?>
                            <a href="pesan/overview/new" class="small-box-footer">Pesan Sekarang <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?></div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $CountKegiatan ?><sup style="font-size: 20px"> Game</sup></h3>

                            <p>Kegiatan Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <?php if($CountKegiatan > 0){ ?>
                            <a href="pesan/overview/new" class="small-box-footer">Pesan Sekarang <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>

            </section>

        </div>
    </div>

    <?php $this->load->view('template/footer'); ?>
</div>

<?php $this->load->view('template/script'); ?>
</body>
</html>
