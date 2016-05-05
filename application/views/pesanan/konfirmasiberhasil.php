<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">

    <?php $this->load->view('template/tamumenu'); ?>

    <div class="content-wrapper" style="height: 600px;">

        <div class="container">

            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-body text-center">

                            <h1>Konfirmasi Berhasil.</h1>
                            <p>Terimakasih</p>
                            <br/>
                            <a href="login" class="btn btn-primary">Login</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php $this->load->view('template/footer'); ?>
    </div>
    <?php $this->load->view('template/script'); ?>
</body>
</html>
