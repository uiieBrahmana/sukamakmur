<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-red sidebar-mini">

<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="css/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Manager</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

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
                <li class="header">AKOMODASI</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Fasilitas</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatakomodasi">Lihat Semua
                                Akomodasi</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahakomodasi">Tambah
                                Akomodasi</a></li>
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
                Akomodasi
                <small>Tambah Akomodasi</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Akomodasi Baru</h3>
                </div>

                <form name="add" class="form-horizontal" method="post"
                      action="administrator/admintambahakomodasi"
                      enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="box-body">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Nama Akomodasi</label>

                                    <div class="col-sm-5">
                                        <input required type="text" placeholder="Nama Akomodasi"
                                               name="nama" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Keterangan</label>

                                    <div class="col-sm-5">
                                        <textarea class="form-control" required name="keterangan"
                                                  style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Kapasitas</label>

                                    <div class="col-sm-3">
                                        <input required type="text" placeholder="Kapasitas"
                                               name="kapasitas" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Harga</label>

                                    <div class="col-sm-3">
                                        <input required type="text" placeholder="Harga"
                                               name="harga" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Status</label>

                                    <div class="col-sm-3">
                                        <select class="form-control" name="status">
                                            <option value="Tersedia">Tersedia</option>
                                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-center">
                        <input type="submit" class="btn btn-info" name="_submit" value="Tambah Akomodasi">
                        <button class="btn btn-default" type="reset">Reset</button>

                    </div>
                </form>
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
                kapasitas: {
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