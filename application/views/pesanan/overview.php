<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pemesanan
                <small>Overview Pemesanan</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><a style="color: white" href="pesan/akomodasi"><i class="fa fa-plus"></i></a></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Akomodasi</span>
                            <span class="info-box-number">
                                -
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><a style="color: white" href="pesan/makanan"><i class="fa fa-plus"></i></a></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Makanan</span>
                            <span class="info-box-number">
                                -
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><a style="color: white" href="pesan/peralatan"><i class="fa fa-plus"></i></a></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Peralatan</span>
                            <span class="info-box-number">
                                -
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><a style="color: white" href="pesan/aktivitas"><i class="fa fa-plus"></i></a></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Aktivitas</span>
                            <span class="info-box-number">
                                -
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box-body">
                        <a href="" class="btn btn-info btn-block">Lanjut Ke Pembayaran</a>
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

<script src="css/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="css/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#student').DataTable({
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [5]}
            ]
        });
    });
</script>

</html>