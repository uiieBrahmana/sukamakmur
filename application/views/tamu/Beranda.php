<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-blue-light layout-top-nav">
<div class="wrapper">

    <?php $this->load->view('template/tamumenu'); ?>

    <div class="content-wrapper">
        <div class="container">

            <section class="content-header">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-body">
                            <div data-ride="carousel" class="carousel slide" id="carousel-example-generic">

                                <ol class="carousel-indicators">
                                    <?php foreach ($Size as $key => $value) { ?>
                                        <li class="<?php echo ($key == 0) ? 'active' : '' ?>" data-slide-to="0" data-target="#carousel-example-generic"></li>
                                    <?php } ?>
                                </ol>

                                <div class="carousel-inner">
                                    <?php foreach ($Size as $key => $value) { ?>
                                        <div class="item <?php echo ($key == 0) ? 'active' : '' ?>">
                                            <img alt="First slide"
                                                 src="service/images/<?php echo $Akomodasi['idakomodasi'].'/'. $key ?>">
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
                </div>


                <div class="row">
                    <div class="col-lg-4">
                        <div class="box box-body"></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box box-body"></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box box-body"></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box box-body"></div>
                    </div>
                </div>
            </section>

            <section class="content">

            </section>

        </div>
    </div>

    <?php $this->load->view('template/footer'); ?>
</div>

<?php $this->load->view('template/script'); ?>
</body>
</html>
