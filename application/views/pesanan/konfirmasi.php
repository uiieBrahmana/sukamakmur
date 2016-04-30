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
                    Konfirmasi
                    <small>Konfirmasikan Pembayaran</small>
                </h1>
            </section>

            <section class="content">

                <div class="row">
                    <div class="col-lg-2"></div>

                    <div class="col-lg-8">
                        <div class="box box-body">
                            <form name="add" class="form-horizontal" method="post" action="konfirmasi" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">ID Transaksi</label>

                                    <div class="col-sm-5">
                                        <input required type="text" placeholder="ID Transaski" value="<?php echo $idpemesanan ?>"
                                               name="idpemesanan" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Nomonal Transfer</label>

                                    <div class="col-sm-4">
                                        <input required type="text" placeholder="Nominal" name="totalamount" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Bukti Pembayaran</label>

                                    <div class="col-sm-3">
                                        <input type="file" name="bukti">
                                    </div>
                                </div>

                                <div class="box-footer text-center">
                                    <input type="submit" class="btn btn-info" name="submit" value="Buat Akun">
                                    <button class="btn btn-default" type="reset">Reset</button>
                                    <input type="hidden" name="update" value="update">
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

            </section>
        </div>

    </div>

    <?php $this->load->view('template/footer'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

<script src="css/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="css/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>

</script>

</html>