<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-blue sidebar-mini">
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
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihatmakanan">Lihat Semua Makanan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/admintambahmakanan">Tambah Makanan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/adminlihattipemakanan">Lihat Tipe Makanan</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/admintambahtipemakanan">Tambah Tipe Makanan</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Kategori Makanan Baru
                <small>Tambah Makanan</small>
            </h1>

        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-body">

                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Makanan Baru</h3>
                        </div>

                        <form class="form-horizontal" method="post" action="administrator/admintambahmakanan">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Tipe Makanan</label>

                                            <div class="col-sm-10">
                                                <select name="idtipemakanan" id ="idtipemakanan" class="form-control col-lg-3">
                                                    <?php
                                                    foreach ($TipeMakanan as $v) {
                                                        echo "<option value='" . $v['idtipemakanan'] . "'>Paket " . $v['idtipemakanan'] . " : " . $v['keterangan'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Keterangan</label>
                                            <div class="col-sm-10">
                                                <textarea required style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;" name="keterangan" class="form-control"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button class="btn btn-info" type="submit" name="submit" value="_submit">Tambah</button>
                                <button class="btn btn-default" type="reset">Reset</button>
                                <a class="btn btn-danger" href="administrator/adminlihatmakanan"> Kembali</a>
                            </div><!-- /.box-footer -->
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

</html>
