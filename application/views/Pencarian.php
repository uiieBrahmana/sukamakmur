<?php include_once 'templates/head.php' ?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <?php include_once 'templates/header.php' ?>
    <?php include_once 'templates/menu.php' ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Reservasi Baru
                <small>prodeo</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Reservasi</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pesan Kamar</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <?php
                        include 'library\MySQLDb.php';
                        $db = new \tugas\model\MySQLDb();
                        if (isset($_POST['submit'])) {
                            var_dump($_POST);
                            $result = false;
                            if ($result) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×
                                    </button>
                                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                                    Suksess menambahkan data.
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×
                                    </button>
                                    <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
                                    <?php echo $db->errormsg ?>
                                </div>
                            <?php }
                        }
                        ?>

                        <form class="form-horizontal" method="post" action="#">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Nama Pemesan</label>

                                            <div class="col-sm-10">
                                                <input required type="text" placeholder="Nama Pemesan" id="namapemesan"
                                                       name="namapemesan"
                                                       class="form-control col-lg-3">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="notelppemesan">Nomor
                                                Telpon</label>

                                            <div class="col-sm-10">
                                                <input required type="text" id="notelppemesan"
                                                       data-inputmask="'mask': ['9999-999-99999']"
                                                       data-mask
                                                       name="notelppemesan" class="form-control col-lg-3">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="reservationtime">Checkin - Checkout</label>

                                            <div class="col-sm-10">
                                                <input required type="text" placeholder="Checkin - Checkout"
                                                       id="reservationtime" name="reservationtime"
                                                       class="form-control col-lg-3">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="idkamar">Jenis Kamar</label>

                                            <div class="col-sm-10">
                                                <select class="form-control select2" style="width: 100%;" id="idkamar"
                                                        name="idkamar">
                                                    <?php
                                                    $db->Query("select idtipekamar, jenis from tipekamar");
                                                    $room = $db->getData();
                                                    foreach($room as $val) {
                                                        ?><option value="<?php echo $val['idkamar'] ?>"><?php echo $val['jenis'] ?></option><?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="noktp">No KTP</label>

                                            <div class="col-sm-10">
                                                <input required type="text" placeholder="No KTP" id="noktp"
                                                       data-inputmask="'mask': ['999999-999999-9999']"
                                                       data-mask name="noktp"
                                                       class="form-control col-lg-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button class="btn btn-info" name="submit" type="submit">Buat Reservasi</button>
                                <button class="btn btn-default" type="reset">Reset</button>
                            </div><!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <?php include_once 'templates/footer.php' ?>
    <?php include_once 'templates/settings.php' ?>
</div>
<?php include_once 'scripts.php' ?>
<script>
    $(document).ready(function () {
        var date = new Date();
        date.setDate(date.getDate()-1);

        $(".select2").select2();

        $('#tanggalmasuk').datepicker({
            startDate: date
        });
        $('#tanggalkeluar').datepicker();

        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'DD/MM/YYYY h:mm A'});

        $("[data-mask]").inputmask();
    });
</script>