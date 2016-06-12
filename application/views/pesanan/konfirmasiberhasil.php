<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">
    <?php $this->load->view('template/tamumenu'); ?>
    <div class="content-wrapper">

        <div class="container">

            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-body text-center">

                            <h1><?php echo $reason ?></h1>

                            <p>Terimakasih</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
    <?php $this->load->view('template/footer'); ?>
</div>
</body>
<?php $this->load->view('template/script'); ?>
</html>
