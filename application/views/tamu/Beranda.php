<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="pengunjung/" class="navbar-brand"><b>RC</b> Sukamakmur</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="pengunjung/akomodasi">Akomodasi</a></li>
                        <li><a href="pengunjung/makanan">Makanan</a></li>
                        <li><a href="pengunjung/peralatan">Peralatan</a></li>
                        <li><a href="pengunjung/kegiatan">Kegiatan</a></li>
                    </ul>
                    <!--
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                        </div>
                    </form>
                    -->
                </div>

                <!-- TEMPLATE/MEMBER -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li><a href="login/">Login</a></li>
                        <li><a href="pengunjung/buatakun">Register</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="content-wrapper">
        <div class="container">

            <section class="content-header">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-body">
                            <div data-ride="carousel" class="carousel slide" id="carousel-example-generic">
                                <ol class="carousel-indicators">
                                    <li class="" data-slide-to="0" data-target="#carousel-example-generic"></li>
                                    <li class="active" data-slide-to="1"
                                        data-target="#carousel-example-generic"></li>
                                    <li class="" data-slide-to="2" data-target="#carousel-example-generic"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item">
                                        <img alt="First slide"
                                             src="http://placehold.it/900x500/39CCCC/ffffff&amp;text=I+Love+Bootstrap">

                                        <div class="carousel-caption">
                                            Jambur
                                        </div>
                                    </div>
                                    <div class="item active">
                                        <img alt="Second slide"
                                             src="http://placehold.it/900x500/3c8dbc/ffffff&amp;text=I+Love+Bootstrap">

                                        <div class="carousel-caption">
                                            Bethel
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img alt="Third slide"
                                             src="http://placehold.it/900x500/f39c12/ffffff&amp;text=I+Love+Bootstrap">

                                        <div class="carousel-caption">
                                            Migdal
                                        </div>
                                    </div>
                                </div>
                                <a data-slide="prev" href="#carousel-example-generic" class="left carousel-control">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a data-slide="next" href="#carousel-example-generic"
                                   class="right carousel-control">
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
