<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-yellow sidebar-mini">

<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">MAKANAN</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-glass"></i> <span>Kelola Makanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatmakanan">Lihat Semua
                                Makanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahmakanan">Tambah
                                Makanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihattipemakanan">Lihat Tipe
                                Makanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahtipemakanan">Tambah Tipe
                                Makanan</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Makanan
                <small>Ubah Menu Makanan</small>
            </h1>
        </section>

        <section class="content">
            <div class="box box-body">

                <div class="box-header with-border">
                    <h3 class="box-title">Ubah Menu Makanan</h3>
                </div>

                <form name="add" class="form-horizontal" action="administrator/adminupdatetipemakanan" method="post">

                    <input type="hidden" name="idtipemakanan" value="<?php echo $TipeMakanan['idtipemakanan'] ?>"><br/>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Keterangan</label>

                                    <div class="col-sm-10">
                                        <textarea required style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;" name="keterangan" class="form-control"><?php echo $TipeMakanan['keterangan'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Harga</label>
                                    <div class="col-sm-3">
                                        <input required type="text" placeholder="Harga" id="harga"
                                               name="harga" value="<?php echo $TipeMakanan['harga'] ?>"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <button class="btn btn-info" name="submit" type="submit">Tambah</button>
                        <button class="btn btn-default" type="reset">Reset</button>
                        <a class="btn btn-danger" href="administrator/adminlihattipemakanan"> Kembali</a>
                    </div>

                </form>

            </div>
        </section>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>
<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>

<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>

<script>
    $(document).ready(function () {
        $('form[name=add]').validate({
            rules: {
                harga: {
                    required: true,
                    number: true
                }
            },
            showErrors: function (errorMap, errorList) {
                this.defaultShowErrors();
            }
        });

    });
</script>

</html>