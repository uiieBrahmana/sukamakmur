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
                <small>Daftar Pemesanan</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>101</td>
                                    <td>12 April 2016</td>
                                    <td>Rp 1.200.000</td>
                                    <td>Lunas</td>
                                    <td><a class="btn btn-info" href="">Detail</a></td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <a href="pesan/overview/new" class="btn btn-info btn-block">Pemesanan Baru</a>
                </div>
                <div class="col-lg-2"></div>
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
        $('table[id=datatable]').DataTable({
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [4]}
            ]
        });
    });
</script>

</html>