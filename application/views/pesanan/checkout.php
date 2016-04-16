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
                            <h1>Pesanan anda sudah diterima.</h1>
                            <p>Silahkan menunggu sms untuk petunjuk pembayaran. Terimakasih</p>
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
