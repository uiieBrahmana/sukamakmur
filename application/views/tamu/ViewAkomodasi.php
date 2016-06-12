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

                <div class="row">
                    <div class="col-md-4">

                        <div class="box box-header">
                            <h3 class="profile-username text-center"><?php echo $Akomodasi['nama'] ?></h3>
                        </div>

                        <div class="box box-body">
                            <div class="box-body box-profile">
                                <p class="text-muted text-center"><?php echo $Akomodasi['keterangan'] ?></p>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Kapasitas</b>
                                        <section class="pull-right"><?php echo $Akomodasi['kapasitas'] ?> orang
                                        </section>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Harga</b>
                                        <section class="pull-right">
                                            <b>Rp. <?php echo number_format($Akomodasi['harga']) ?></b>
                                        </section>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Status</b>
                                        <section class="pull-right"><?php echo ($Akomodasi['BookAvailable']) ? $Akomodasi['status'] : 'Tersewa' ?></section>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <a class="btn btn-block btn-danger" href="pengunjung/akomodasi">Kembali</a>
                        <br>

                    </div>

                    <div class="col-md-8">
                        <div class="box box-body">

                            <div data-ride="carousel" class="carousel slide" id="carousel-example-generic">
                                <ol class="carousel-indicators">
                                    <?php foreach ($Size as $key => $value) { ?>
                                        <li class="<?php echo ($key == 0) ? 'active' : '' ?>" data-slide-to="0"
                                            data-target="#carousel-example-generic"></li>
                                    <?php } ?>
                                </ol>

                                <div class="carousel-inner">
                                    <?php foreach ($Size as $key => $value) { ?>
                                        <div class="item <?php echo ($key == 0) ? 'active' : '' ?>">
                                            <img alt="First slide"
                                                 src="service/images/<?php echo $Akomodasi['idakomodasi'] . '/' . $key ?>">
                                        </div>
                                    <?php } ?>
                                </div>
                                <a data-slide="prev" href="#carousel-example-generic" class="left carousel-control">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a data-slide="next" href="#carousel-example-generic" class="right carousel-control">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                            </div>
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
