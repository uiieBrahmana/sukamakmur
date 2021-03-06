<!DOCTYPE html>
<html>
<?php $this->load->view('template/head') ?>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header') ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">PERALATAN</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-gear"></i> <span>Kelola Peralatan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatperalatan">Lihat Semua
                                Peralatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahperalatan">Tambah
                                Peralatan</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Kelola Fasilitas
                <small>Tambah Peralatan</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Peralatan Baru</h3>
                        </div>

                        <form name="add" class="form-horizontal" method="post" action="administrator/admintambahperalatan">

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Nama</label>

                                            <div class="col-sm-10">
                                                <input required type="text" placeholder="Nama" id="namapemesan"
                                                       name="nama"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Harga Sewa</label>

                                            <div class="col-sm-2">
                                                <input required type="text" placeholder="Harga Sewa" 
                                                       name="hargasewa"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Keterangan</label>

                                            <div class="col-sm-10">
                                                <input required type="text" placeholder="Keterangan"
                                                       name="keterangan"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Jumlah</label>

                                            <div class="col-sm-2">
                                                <input required type="text" placeholder="Jumlah"
                                                       name="jumlah"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button class="btn btn-info" name="submit" type="submit">Tambah Peralatan</button>
                                <button class="btn btn-default" type="reset">Reset</button>
                                <a class="btn btn-danger" href="administrator/adminlihatperalatan">Batalkan</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>
<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>

<script>
    $(document).ready(function(){
        $('form[name=add]').validate({
            rules: {
                jumlah: {
                    required: true,
                    number: true
                },
                hargasewa: {
                    required: true,
                    number: true
                }
            },
            showErrors: function(errorMap, errorList) {
                this.defaultShowErrors();
            }
        });

    });
</script>
</html>