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
                    Pemesanan
                    <small>Peralatan</small>
                </h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="box-body">
                            <form name="add" action="pesan/peralatan" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Peralatan</label>
                                    <select name="idperalatan" class="form-control select2">
                                        <?php foreach ($Peralatan as $Value) {
                                            $data = $Value;
                                            echo "<option value='" . $data['idperalatan'] . "'>" . $data['nama'] . "</option>";
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalmakan">Tanggal</label>
                                    <input type="text" placeholder="dari" name="tanggalsewa"
                                           value="<?php echo date("d F Y") ?>"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Jumlah Alat</label>
                                    <input type="text" name="jumlahalat" placeholder="jumlah"
                                           class="form-control">

                                    <p class="help-block" id="sisaalat"></p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Keterangan</label>
                                <textarea name="keteranganalat" class="form-control"
                                          style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;"></textarea>
                                </div>

                                <input type="submit" name="submit" class="btn btn-info btn-block" value="Simpan">
                                <input type="reset" name="reset" class="btn btn-warning btn-block" value="Reset">

                            </form>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>

            </section>
        </div>

    </div>

    <?php $this->load->view('template/footer'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>

<script src="css/plugins/select2/select2.min.js"></script>
<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>
<script src="css/plugins/iCheck/icheck.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2();
        $('input[name=tanggalsewa]').datepicker({
            format: 'dd MM yyyy',
            startDate: new Date(),
            endDate: '+2m',
        });
        $('form[name=add]').validate({
            rules: {
                jumlahalat: {
                    required: true,
                    range: [1, 10]
                }
            },
            showErrors: function (errorMap, errorList) {
                this.defaultShowErrors();
            }
        });
        $('input[name=tanggalsewa]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
            $.ajax({
                    method: "POST",
                    url: "index.php/service/AvailablePeralatan",
                    data: {
                        idperalatan: $('select[name=idperalatan]').val(),
                        tanggalsewa: $(this).val(),
                    }
                })
                .done(function (msg) {
                    $('p[id=sisaalat]').html('Sisa alat tersedia ' + msg.sisa + '.');
                    $("input[name*=jumlahalat]").rules("remove", "range");
                    $("input[name*=jumlahalat]").rules("add", {
                        range: [1, msg.sisa]
                    });

                    if (msg.sisa <= 0) {
                        $("input[name=submit]").prop('disabled', true);
                    } else {
                        $("input[name=submit]").prop('disabled', false);
                    }
                });
        });

        $('select[name=idperalatan]').on('change', function () {
            $('input[name=tanggalsewa]').trigger('changeDate');
        });
        $('input[name=tanggalsewa]').trigger('changeDate');

    });
</script>

</html>