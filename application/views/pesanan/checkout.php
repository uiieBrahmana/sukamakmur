<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">

    <?php $this->load->view('template/tamumenu'); ?>

    <div class="content-wrapper">

        <div class="container">

            <section class="content-header">
                <h1>
                    Pemesanan
                    <small>sukses</small>
                </h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-body text-center">
                            <h1>Pesanan anda sudah diterima.</h1>

                            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px;">Pemesanan anda dengan kode : <?php echo $Pemesanan['idpemesanan'] ?> - <b>Rp. <?php echo number_format($Pemesanan['totalharga']) ?></b>
                                                                Silahkan melakukan pembayaran ke rekening berikut. </span>
                            <br/>
                            <br/>

                            <p>Atau, Silahkan mengecek email anda <u><?php echo $Pemesanan['email'] ?></u> untuk petunjuk pembayaran.
                                <br/>Terimakasih</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php $this->load->view('template/footer'); ?>
</body>
<?php $this->load->view('template/script'); ?>
</html>
