<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>

            <ul class="sidebar-menu">
                <li class="header">KEGIATAN</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Kegiatan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatkegiatan">Lihat Semua
                                Kegiatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahkegiatan">Tambah
                                Kegiatan</a></li>
                    </ul>
                </li>


                <li class="header">Version - 0.1 beta</li>
                <!--
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
                    </ul>
                </li>
                -->
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Kelola Fasilitas
                <small>Tambah Kegiatan</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">

                    <div class="box box-body">

                        <div class="box-header with-border">
                            <h3 class="box-title">Ubah Data Kegiatan</h3>
                        </div>

                        <form name="add" class="form-horizontal" action="administrator/adminupdatekegiatan"
                              method="post">

                            <input type="hidden" name="idkegiatan" value="<?php echo $Kegiatan['idkegiatan'] ?>"><br/>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="namapemesan">Nama</label>

                                        <div class="col-sm-5">
                                            <input required type="text" placeholder="Nama Kegiatan" id="nama"
                                                   name="nama" value="<?php echo $Kegiatan['nama'] ?>"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="namapemesan">Peserta Minimal</label>

                                        <div class="col-sm-2">
                                            <input required type="text" placeholder="Peserta Minimal"
                                             value="<?php echo $Kegiatan['pesertamin'] ?>"
                                                   name="pesertamin" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="namapemesan">Peserta Maksimal</label>

                                        <div class="col-sm-2">
                                            <input required type="text" placeholder="Peserta Maksimal"
                                                  value="<?php echo $Kegiatan['pesertamax'] ?>"
                                                   name="pesertamax"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="namapemesan">Harga</label>

                                        <div class="col-sm-3">
                                            <input required type="text" placeholder="Harga" id="harga"
                                                   name="harga" value="<?php echo $Kegiatan['harga'] ?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="namapemesan">Keterangan</label>

                                        <div class="col-sm-5">
                                            <textarea required style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;" name="keterangan" class="form-control"><?php echo $Kegiatan['keterangan'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button class="btn btn-info" name="submit" type="submit">Update Kegiatan</button>
                                <button class="btn btn-default" type="reset">Reset</button>
                                <a class="btn btn-danger" href="administrator/adminlihatkegiatan"> Kembali</a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>

<?php $this->load->view('template/script'); ?>


<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>

<script>
    $(document).ready(function () {
        $('form[name=add]').validate({
            rules: {
                pesertamax: {
                    required: true,
                    number: true
                },
                pesertamin: {
                    required: true,
                    number: true
                },
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
