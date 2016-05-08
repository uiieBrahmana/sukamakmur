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
                    <small>Akomodasi</small>
                </h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="box-body">
                            <form name="add" action="pesan/makanan" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Menu</label>
                                    <select name="idmenu" class="form-control select2">
                                        <?php foreach ($MenuMakanan as $Value) {
                                            $data = $Value;
                                            echo "<option value='" . $data['idmenumakanan'] . "'>Paket : " . $data['idtipemakanan'] . " (" . $data['keterangan'] . ")</option>";
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalmakan">Tanggal</label>
                                    <input type="text" placeholder="dari" name="tanggalmakan"
                                           value="<?php echo date("d F Y") ?>"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="waktumakan">Waktu</label>
                                    <select name="waktumakan" class="form-control select2">
                                        <option value="Pagi">Pagi</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Jumlah Porsi</label>
                                    <input type="text" name="jumlahporsi" placeholder="jumlah porsi"
                                           class="form-control">

                                    <p class="help-block" id="sisaporsi"></p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Keterangan</label>
                                <textarea name="keteranganmakanan" class="form-control"
                                          style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;"></textarea>
                                </div>


                                <input type="submit" name="submit" class="btn btn-info btn-block" value="Simpan">
                                <input type="reset" name="reset" class="btn btn-warning btn-block" value="Reset">

                                <p class="help-block">*RC Sukamakmur hanya bisa menyediakan 1000 porsi per harinya.</p>

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
        $('input[name=tanggalmakan]').datepicker({
            format: 'dd MM yyyy',
            startDate: '+1d',
            endDate: '+2m',
        });
        $('form[name=add]').validate({
            rules: {
                jumlahporsi: {
                    required: true,
                    range: [1, 1000]
                }
            },
            showErrors: function (errorMap, errorList) {
                this.defaultShowErrors();
            }
        });
        $('input[name=tanggalmakan]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
            $.ajax({
                    method: "POST",
                    url: "index.php/service/AvailableMakanan",
                    data: {
                        tanggalmakan: $('input[name=tanggalmakan]').val(),
                    }
                })
                .done(function (msg) {
                    $('p[id=sisaporsi]').html('Sisa porsi tersedia ' + msg.sisa + '.');
                    $("input[name*=jumlahporsi]").rules("remove", "range");
                    $("input[name*=jumlahporsi]").rules("add", {
                        range: [1, msg.sisa]
                    });
                    if (msg.sisa == 0)
                        $('input[name=submit]').prop('disabled', true);
                    else
                        $('input[name=submit]').prop('disabled', false);
                });
        });

        $('input[name=tanggalmakan]').trigger('changeDate');
        $('select[name=idmenu]').on('change', function () {
            $('input[name=tanggalmakan]').trigger('changeDate');
        });
    });
</script>

</html>