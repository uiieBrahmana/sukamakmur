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
                <small>Tambah Tipe</small>
            </h1>

        </section>

        <section class="content">
            
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="box box-body">
                        
                        <div class="box-header with-border">
                            <h3 class="box-title">Buat Tipe Makanan Baru</h3>
                        </div>

                        <form name="add" class="form-horizontal" method="post" action="administrator/admintambahtipemakanan">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">ID Tipe Makanan</label>

                                            <div class="col-sm-10">
                                                <input required type="text" placeholder="ID Tipe Makanan"
                                                       name="idtipemakanan"
                                                       class="form-control">
                                                <input type="hidden" name="similar">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Keterangan</label>

                                            <div class="col-sm-10">
                                                <textarea required style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;" name="keterangan" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="namapemesan">Harga</label>
                                            <div class="col-sm-3">
                                                <input required type="text" placeholder="Harga"
                                                       name="harga"
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

        $.validator.addMethod("tipe_not_same", function(value, element) {
            return $('input[name=idtipemakanan]').val() != $('input[name=similar]').val()
        }, "* Type exists. Choose another food type.");

        $.validator.addMethod("caps", function(value, element) {
            return this.optional(element) || /[A-Z]+/.test(value);
        }, "Only uppercase letters allowed.");

        $('form[name=add]').validate({
            rules: {
                harga: {
                    required: true,
                    number: true,
                },
                idtipemakanan: {
                    tipe_not_same: true,
                    caps: true,
                }
            },
            showErrors: function (errorMap, errorList) {
                this.defaultShowErrors();
            }
        });
        $('input[name=idtipemakanan]').on('focusout',function() {
            $.ajax({
                    method: "POST",
                    url: "service/tipemakananSimilarity",
                    data: {
                        tipe: $(this).val(),
                    }
                })
                .done(function (msg) {
                    $('input[name=similar]').val(msg);
                    $('input[name=idtipemakanan]').trigger('keyup');
                });
        });
    });
</script>
</html>
