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
                        <li class="active"><a href="pengunjung/peralatan">Peralatan</a></li>
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
                <h1>
                </h1>
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
