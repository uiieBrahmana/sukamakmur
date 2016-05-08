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

                                <!--
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Nominal Transfer</label>

                                    <div class="col-sm-4">
                                        <input required type="text" placeholder="Nominal" name="totalamount" class="form-control">
                                    </div>
                                </div>
                                -->

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Bukti Pembayaran</label>

                                    <div class="col-sm-5">
                                        <input type="file" name="bukti">
                                        <p class="help-block">Format : JPEG, JPG, PNG. max 10MB.</p>
                                    </div>
                                </div>

                                <div class="box-footer text-center">
                                    <input type="submit" class="btn btn-info" name="submit" value="Kirim Konfirmasi">
                                    <button class="btn btn-default" type="reset">Reset</button>
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
<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>
<script>
    $(document).ready(function(){
        $('form[name=add]').validate({
            rules: {
                bukti: {
                    required: true,
                    extension: "jpeg|jpg|png",
                },
                totalamount: {
                    number: true
                },
                idpemesanan: {
                    number: true
                }
            }
        });
    });
</script>

</html>