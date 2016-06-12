<!DOCTYPE html>
<html>
<?php $this->load->view('template/head'); ?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">Menu Utama</li>



                <?php if (strcmp($role, 'Administrator') != 0) { ?>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-home"></i> <span>Kelola Fasilitas</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminakomodasi">Akomodasi</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminperalatan">Peralatan</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminkegiatan">Kegiatan</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminmakanan">Makanan</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-users"></i> <span>Kelola Akun Pegawai</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahpegawai">Buat Akun
                                    Pegawai</a></li>
                            <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpegawai">Daftar
                                    Pegawai</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <li class="treeview">
                    <a href="#"><i class="fa fa-tasks"></i> <span>Kelola Pemesanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpesanan">Lihat Semua
                                Pesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipesanan">Konfirmasi
                                Pemesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipembayaran">Konfirmasi
                                Pembayaran</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-archive"></i> <span>Kelola Akun Member</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatakun">Lihat Semua
                                Member</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminbuatakun">Buat Member Baru</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $SisaMakanan ?><sup style="font-size: 20px"> Porsi</sup></h3>

                            <p>Makanan Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $CountAkomodasi ?><sup style="font-size: 20px"> Unit</sup></h3>

                            <p>Akomodasi Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $CountPeralatan ?><sup style="font-size: 20px"> Unit</sup></h3>

                            <p>Peralatan Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $CountKegiatan ?><sup style="font-size: 20px"> Game</sup></h3>

                            <p>Kegiatan Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-body">
                        <div class="chart">
                            <h1>
                                Grafik Pemesanan
                            </h1>
                            <canvas id="lineChart" style="height:250px"></canvas>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>

        </section>
    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>
<?php
$this->load->view('template/script');

$januari = 0;
$februari = 0;
$maret = 0;
$april = 0;
$mei = 0;
$juni = 0;
$juli = 0;
$agustus = 0;
$september = 0;
$oktober = 0;
$november = 0;
$desember = 0;

foreach ($Stats as $k => $v) {
    switch ((int)$v['bulan']) {
        case 1:
            $januari = $januari + (int)$v['jumlah'];
            break;
        case 2:
            $februari = $februari + (int)$v['jumlah'];
            break;
        case 3:
            $maret = $maret + (int)$v['jumlah'];
            break;
        case 4:
            $april = $april + (int)$v['jumlah'];
            break;
        case 5:
            $mei = $mei + (int)$v['jumlah'];
            break;
        case 6:
            $juni = $juni + (int)$v['jumlah'];
            break;
        case 7:
            $juli = $juli + (int)$v['jumlah'];
            break;
        case 8:
            $agustus = $agustus + (int)$v['jumlah'];
            break;
        case 9:
            $september = $september + (int)$v['jumlah'];
            break;
        case 10:
            $oktober = $oktober + (int)$v['jumlah'];
            break;
        case 11:
            $november = $november + (int)$v['jumlah'];
            break;
        case 12:
            $desember = $desember + (int)$v['jumlah'];
            break;
        default:
            break;
    }
}
?>
<script src="css/plugins/chartjs/Chart.min.js"></script>
<script>
    $(function () {
        var areaChartData = {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [
                {
                    label: "Pemesanan",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [
                        <?php echo $januari ?>,
                        <?php echo $februari ?>,
                        <?php echo $maret ?>,
                        <?php echo $april ?>,
                        <?php echo $mei ?>,
                        <?php echo $juni ?>,
                        <?php echo $juli ?>,
                        <?php echo $agustus ?>,
                        <?php echo $september ?>,
                        <?php echo $oktober ?>,
                        <?php echo $november ?>,
                        <?php echo $desember ?>,
                    ]
                }
            ]
        };

        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas);
        var lineChartOptions = areaChartOptions;
        lineChartOptions.datasetFill = false;
        lineChart.Line(areaChartData, lineChartOptions);
    });
</script>
</html>