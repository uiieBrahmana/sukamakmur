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
                    Pendaftaran Akun Baru
                    <small>isilah dengan benar.</small>
                </h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-lg-2"></div>

                    <div class="col-lg-8">
                        <div class="box box-body">
                            <form name="add" class="form-horizontal" method="post" action="pengunjung/buatakun">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Nama Lengkap</label>

                                    <div class="col-sm-5">
                                        <input required type="text" placeholder="Nama Lengkap"
                                               name="nama"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Tanggal
                                        Lahir</label>

                                    <div class="col-sm-4">
                                        <input required type="text" placeholder="Tanggal Lahir"
                                               name="tanggallahir"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Jenis
                                        Kelamin</label>

                                    <div class="col-sm-3">
                                        <select name="jeniskelamin" class="form-control">
                                            <option value="W">Wanita</option>
                                            <option value="P">Pria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Alamat</label>

                                    <div class="col-sm-5">
                                                <textarea name="alamat"
                                                          style="min-width: 100%; max-width: 100%; min-height: 60px; max-height: 120px;"
                                                          class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Email</label>

                                    <div class="col-sm-4">
                                        <input required type="email" placeholder="Email"
                                               name="email"
                                               class="form-control col-lg-3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="notelppemesan">Nomor
                                        Handphone</label>

                                    <div class="col-sm-4">
                                        <input required type="text"
                                               data-inputmask="'mask': ['9999-999-99999']"
                                               data-mask
                                               name="notelp" class="form-control col-lg-3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Username</label>

                                    <div class="col-sm-3">
                                        <input required type="text" placeholder="Username"
                                               name="username"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="namapemesan">Password</label>

                                    <div class="col-sm-3">
                                        <input required type="password" placeholder="Password"
                                               name="password"
                                               class="form-control">
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


<?php $this->load->view('template/script'); ?>

<script src="css/plugins/select2/select2.min.js"></script>
<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>
<script src="css/plugins/iCheck/icheck.min.js"></script>
<script src="css/plugins/input-mask/jquery.inputmask.js"></script>
<script>
    $(document).ready(function () {
        $('form[name=add]').validate({
            rules: {
                nama: {
                    required: true
                },
                username: {
                    required: true,
                    minlength: 6
                },
                password: {
                    required: true,
                    minlength: 6
                },
                tanggallahir: {
                    required: true
                },
                email: {
                    required: true
                },
                alamat: {
                    required: true
                }
            },
            showErrors: function (errorMap, errorList) {
                this.defaultShowErrors();
            }
        });
        $('input[name=tanggallahir]').datepicker({format: 'dd MM yyyy'});
        $('input[name=tanggallahir]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        $('input[name=notelp]').inputmask();
    });
</script>
</body>
</html>
