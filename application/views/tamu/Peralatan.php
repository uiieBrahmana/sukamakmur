<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-yellow layout-top-nav">
<div class="wrapper">

    <?php $this->load->view('template/tamumenu'); ?>

    <div class="content-wrapper">
        <div class="container">

            <section class="content-header">
                <h1>
                    Peralatan Tersedia
                    <small><?php echo $DateSearch ?></small>
                </h1>
            </section>

            <section class="content">
                <?php foreach($TotalPeralatan as $k => $v) { ?>
                    <div class="col-lg-4 col-xs-6">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-gear"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo $v['nama'] ?></span>
                                <span class="info-box-number"><?php echo $v['jumlah'] ?> unit</span>

                        <span class="progress-description">
                          Rp. <?php echo number_format($v['hargasewa']) ?> (<?php echo $v['keterangan'] ?>)
                        </span>

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
