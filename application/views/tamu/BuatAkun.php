<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-black layout-top-nav">
<div class="wrapper">

    <?php $this->load->view('template/tamumenu'); ?>

    <div class="content-wrapper">
        <div class="container">

            <section class="content-header">
                <h1>
                </h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="box-header with-border">
                            <h3 class="box-title">Buat Akun Baru</h3>
                        </div>
                        <form class="form-horizontal" method="post" action="index.php/administrator/adminbuatakun">
                            <div class="box-info">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Nama Lengkap</label>

                                    <div class="col-sm-5">
                                        <input required type="text" placeholder="Nama Lengkap" id="namapemesan"
                                               name="nama"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Tanggal
                                        Lahir</label>

                                    <div class="col-sm-2">
                                        <input required type="text" placeholder="Tanggal Lahir" id="namapemesan"
                                               name="tanggallahir"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Jenis
                                        Kelamin</label>

                                    <div class="col-sm-3">
                                        <select name="jeniskelamin" id="" class="form-control">
                                            <option value="W">Wanita</option>
                                            <option value="P">Pria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Alamat</label>

                                    <div class="col-sm-5">
                                                <textarea name="alamat" id=""
                                                          style="min-width: 100%; max-width: 100%; min-height: 60px; max-height: 120px;"
                                                          class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Email</label>

                                    <div class="col-sm-4">
                                        <input required type="email" placeholder="Email" id="namapemesan"
                                               name="email"
                                               class="form-control col-lg-3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="notelppemesan">Nomor
                                        Handphone</label>

                                    <div class="col-sm-4">
                                        <input required type="text" id="notelppemesan"
                                               data-inputmask="'mask': ['9999-999-99999']"
                                               data-mask
                                               name="notelp" class="form-control col-lg-3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Username</label>

                                    <div class="col-sm-3">
                                        <input required type="text" placeholder="Username" id="namapemesan"
                                               name="username"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Password</label>

                                    <div class="col-sm-3">
                                        <input required type="password" placeholder="Password" id="namapemesan"
                                               name="password"
                                               class="form-control">
                                    </div>
                                </div>


                            </div><!-- /.box-body -->
                            <div class="box-footer text-center">
                                <input type="submit" class="btn btn-info" name="_submit" value="Buat Akun">
                                <button class="btn btn-default" type="reset">Reset</button>
                                <input type="hidden" name="update" value="update">
                            </div><!-- /.box-footer -->
                        </form>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </section>

        </div>
    </div>

    <?php $this->load->view('template/footer'); ?>
</div>

<?php $this->load->view('template/script'); ?>
</body>
</html>
