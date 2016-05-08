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
                            <form name="add" action="pesan/aktivitas" method="post">
                                <div class="form-group">
                                    <label for="idkegiatan">Aktivitas</label>
                                    <select name="idkegiatan" class="form-control select2">
                                        <?php foreach ($Kegiatan as $Value) {
                                            $data = $Value;
                                            echo "<option value='" . $data['idkegiatan'] . "'>" . $data['nama'] . "</option>";
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" placeholder="dari" name="tanggal"
                                           value="<?php echo date("d F Y") ?>"
                                           class="form-control">
                                </div>

                                <p class="help-block" id="informasi"></p>

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
        $('input[name=tanggal]').datepicker({
            format: 'dd MM yyyy',
            startDate: '+1d',
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
        
        $('select[name=idkegiatan]').on('change', function () {
            $.ajax({
                    method: "POST",
                    url: "index.php/service/KapasitasAktivitas",
                    data: {
                        idkegiatan: $(this).val(),
                        tanggal: $('input[name=tanggal]').val(),
                    }
                })
                .done(function (msg) {
                    $("input[name*=jumlah]").rules("remove", "range");
                    $("input[name*=jumlah]").rules("add", {
                        range: [msg.pesertamin, msg.pesertamax]
                    });
                    if ((msg.trainer - msg.terpesan) <= 0) {
                        $("input[name=submit]").prop('disabled', true);
                        $("p[id=informasi]").html("*Maaf, Pesanan aktivitas pada " + $('input[name=tanggal]').val() + " sudah penuh.");
                    } else {
                        $("input[name=submit]").prop('disabled', false);
                        $("p[id=informasi]").html("*" + (msg.trainer - msg.terpesan) + " sisa Aktivitas dapat dipesan pada " + $('input[name=tanggal]').val() + ".");
                    }


                });
        });
        $('input[name=tanggal]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        $('select[name=idkegiatan]').trigger('change');

        $('input[name=tanggal]').on('changeDate', function(){
            $('select[name=idkegiatan]').trigger('change');
        });
    });
</script>

</html>