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
                            <form name="add" action="pesan/akomodasi" method="post">
                                <div class="form-group">
                                    <label for="idakomodasi">Tempat</label>
                                    <select name="idakomodasi" class="form-control select2">
                                        <?php foreach ($Akomodasi as $Value) {
                                            $data = $Value;
                                            echo "<option value='" . $data['idakomodasi'] . "'>" . $data['nama'] . "</option>";
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalmasuk">Tanggal</label>
                                    <input type="text" placeholder="dari" name="tanggalmasuk"
                                           value="<?php echo date("d F Y") ?>"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tanggalkeluar">Hingga</label>
                                    <select name="tanggalkeluar" class="form-control select2">
                                        <option value="1">1 Hari</option>
                                        <option value="2" selected>2 Hari</option>
                                        <option value="3">3 Hari</option>
                                        <option value="4">4 Hari</option>
                                        <option value="5">5 Hari</option>
                                        <option value="6">6 Hari</option>
                                        <option value="7">7 Hari</option>
                                        <option value="8">8 Hari</option>
                                        <option value="9">9 Hari</option>
                                        <option value="10">10 Hari</option>
                                        <option value="11">11 Hari</option>
                                        <option value="12">12 Hari</option>
                                        <option value="13">13 Hari</option>
                                        <option value="14">14 Hari</option>
                                        <option value="15">15 Hari</option>
                                        <option value="16">16 Hari</option>

                                    </select>
                                </div>

                                <div id="akomodasires">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" disabled> Pilih tanggal dan lama menyewa
                                            lebih dahulu.
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah">Jumlah Peserta</label>
                                    <input type="text" name="jumlah" class="form-control">

                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                <textarea required name="keterangan" class="form-control"
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
        $('input[name=tanggalmasuk]').datepicker({
            format: 'dd MM yyyy',
            startDate: new Date(),
            endDate: '+2m',
        });
        $('form[name=add]').validate({
            rules: {
                jumlah: {
                    required: true,
                    range: [1, 40]
                }
            },
            showErrors: function (errorMap, errorList) {
                this.defaultShowErrors();
            }
        });
        $('select[name=tanggalkeluar]').on('change', function () {
            $.ajax({
                    method: "POST",
                    url: "index.php/service/AvailableAkomodasi",
                    data: {
                        idakomodasi: $('select[name=idakomodasi]').val(),
                        start: $('input[name=tanggalmasuk]').val(),
                        end: $('select[name=tanggalkeluar]').val()
                    }
                })
                .done(function (msg) {
                    var htmlcontent = '';
                    $.each(msg.Akomodasi, function (index, value) {
                        htmlcontent += '<div>';
                        if (value.Result) {
                            htmlcontent += '<label><input checked type="checkbox" class="minimal flat-red" name="checkakomodasi[]" value="' + value.IDTanggal + '"> Tanggal ' + value.Tanggal + ' tersedia.</label>';
                        } else {
                            htmlcontent += '<label><input disabled type="checkbox" class="minimal flat-red" name="checkakomodasi[]" value="' + value.IDTanggal + '"> Tanggal ' + value.Tanggal + ' tidak tersedia.</label>';
                        }
                        htmlcontent += '</div>';
                    });
                    $('#akomodasires').html(htmlcontent + '<p class="help-block">*Beri centang pada hari yang dipilih.</p>');
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass: 'iradio_minimal-blue'
                    });

                });
        });

        $('select[name=idakomodasi]').on('change', function () {
            $.ajax({
                    method: "POST",
                    url: "index.php/service/KapasitasAkomodasi",
                    data: {
                        idakomodasi: $(this).val()
                    }
                })
                .done(function (msg) {
                    $("input[name*=jumlah]").rules("remove", "range");
                    $("input[name*=jumlah]").rules("add", {
                        range: [2, msg.kapasitas]
                    });
                });
            $('select[name=tanggalkeluar]').trigger('change');
        });
        $('input[name=tanggalmasuk]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
            $('select[name=tanggalkeluar]').trigger('change');
        });
        $('select[name=idakomodasi]').trigger('change');
    });
</script>

</html>