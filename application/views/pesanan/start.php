<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">

    <?php $this->load->view('template/tamumenu'); ?>

    <div class="content-wrapper">
        <div class="container">
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
                        <div class="box box-body">
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
                                <?php foreach ($Pesanan as $value) { ?>
                                    <tr>
                                        <td><?php echo $value['idpemesanan'] ?></td>
                                        <td><?php echo date("d F Y (h:i:s)", strtotime($value['tanggalpesan'])) ?></td>
                                        <td>Rp. <?php echo number_format($value['totalharga']) ?></td>
                                        <td><?php echo $value['status'] ?></td>
                                        <td>
                                            <?php if(strcmp($value['status'], 'FINISHED') == 0) { ?>
                                                <a class="btn btn-flat btn-warning" href="pesan/summary/<?php echo $value['idpemesanan'] ?>">Invoice</a>
                                            <?php } elseif(strcmp($value['status'], 'CHECKOUT') == 0) { ?>
                                                <button disabled class="btn btn-flat">Menunggu Pembayaran</button>
                                                <a class="btn btn-primary brn-flat" href="konfirmasi/<?php echo $value['idpemesanan'] ?>">Konfirmasi</a>
                                            <?php } else { ?>
                                                <a class="btn btn-flat btn-info" href="pesan/overview/<?php echo $value['idpemesanan'] ?>">Detail</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
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

    </div>

    <?php $this->load->view('template/footer'); ?>
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