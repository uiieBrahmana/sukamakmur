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
                    Akomodasi
                    <small><?php echo $DateSearch ?></small>
                </h1>
            </section>

            <section class="content">

                <?php foreach($TotalAkomodasi as $k => $v) { ?>
                    <div class="col-lg-4 col-xs-6">
                        <a href="pengunjung/viewakomodasi/<?php echo $v['idakomodasi'] ?>">
                        <div class="info-box <?php echo ($v['BookAvailable']) ? 'bg-green' : 'bg-red' ?>">
                            <span class="info-box-icon"><i class="fa fa-home"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo $v['nama'] ?></span>
                                <span class="info-box-number">max. <?php echo $v['kapasitas'] ?> orang</span>

                            <span class="progress-description">
                              Rp. <?php echo number_format($v['harga']) ?> (<?php echo ($v['BookAvailable']) ? 'Tersedia' : 'Tidak Tersedia' ?>)
                            </span>

                            </div>
                        </div>
                        </a>
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
