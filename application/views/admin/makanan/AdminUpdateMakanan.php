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
                <li class="header">MAKANAN</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Makanan</span> <i
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
                Makanan
                <small>Ubah Menu Makanan</small>
            </h1>
        </section>

        <section class="content">
            <div class="box box-body">

                <div class="box-header with-border">
                    <h3 class="box-title">Ubah Menu Makanan</h3>
                </div>

                <form name="add" class="form-horizontal" action="administrator/adminupdatemakanan" method="post">

                    <input type="hidden" name="idmenumakanan" value="<?php echo $Menumakanan['idmenumakanan'] ?>">

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Tipe Makanan</label>

                                    <div class="col-sm-10">
                                        <select name="idtipemakanan" id="idtipemakanan" class="form-control col-lg-3">
                                            <?php
                                            foreach ($TipeMakanan as $v) {
                                                if ($Menumakanan['idtipemakanan'] == $v['idtipemakanan']) {
                                                    echo "<option selected value='" . $v['idtipemakanan'] . "'>Paket " . $v['idtipemakanan'] . " : " . $v['keterangan'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $v['idtipemakanan'] . "'>Paket " . $v['idtipemakanan'] . " : " . $v['keterangan'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="namapemesan">Keterangan</label>

                                    <div class="col-sm-10">
                                    <textarea required
                                              style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;"
                                              name="keterangan"
                                              class="form-control"><?php echo $Menumakanan['keterangan'] ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-info" type="submit" name="submit" value="submit">Ubah Data</button>
                        <button class="btn btn-default" type="reset">Reset</button>
                        <a class="btn btn-danger" href="administrator/adminlihatmakanan"> Kembali</a>
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

<script>
    $(document).ready(function () {
        $('form[name=add]').validate();

    });
</script>

</html>