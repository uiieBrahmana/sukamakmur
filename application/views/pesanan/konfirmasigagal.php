<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">
    <?php $this->load->view('template/tamumenu'); ?>
    <div class="content-wrapper">
        <div class="container">
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-body text-center">

                            <h1>Konfirmasi Gagal.</h1>

                            <p>Kesalahan : [<?php echo $reason ?>]</p>

                            <p>Silahkan coba lagi. Terimakasih</p>
                            <br/>
                            <a href="konfirmasi" class="btn btn-primary">Coba Lagi</a>
                            <br/>
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
