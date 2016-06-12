<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Email</title>
    <style type="text/css">
        html {
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }

        @media only screen and (max-device-width: 680px) , only screen and (max-width: 680px) {
            *[class="table_width_100"] {
                width: 96% !important;
            }

            *[class="border-right_mob"] {
                border-right: 1px solid #dddddd;
            }

            *[class="mob_100"] {
                width: 100% !important;
            }

            *[class="mob_center"] {
                text-align: center !important;
            }

            *[class="mob_center_bl"] {
                float: none !important;
                display: block !important;
                margin: 0px auto;
            }

            .iage_footer a {
                text-decoration: none;
                color: #929ca8;
            }

            img.mob_display_none {
                width: 0px !important;
                height: 0px !important;
                display: none !important;
            }

            img.mob_width_50 {
                width: 40% !important;
                height: auto !important;
            }
        }

        .table_width_100 {
            width: 680px;
        }
    </style>
</head>

<body style="padding: 0px; margin: 0px;">
<div id="mailsub" class="notification" align="center">

    <span><h2>LAPORAN PEMASUKAN RC SUKAMAKMUR</h2>
    <hr width="80%"></hr>
    </span>

    <p>Periode : <?php echo $Period ?></p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;">
        <tr>
            <td align="center">
                <table border="1" cellspacing="0" cellpadding="0" class="table_width_100" width="100%"
                       style="max-width: 800px; min-width: 300px;">
                    <tr>
                        <th>TANGGAL</th>
                        <th>PEMESAN</th>
                        <th>PESANAN</th>
                        <th>JUMLAH</th>
                        <th>HARGA SATUAN</th>
                        <th>TOTAL</th>
                    </tr>
                    <?php $total = 0;
                    foreach ($Stats as $value) { ?>
                        <tr>
                            <td><?php echo date("d F Y", strtotime($value['tanggalpesan'])) ?></td>
                            <td><?php echo $value['namatamu'] ?></td>
                            <td><?php echo $value['nama'] ?></td>
                            <?php if ($value['multiply'] == 'yes') { ?>
                            <td><?php echo $value['jumlahtamu'] . " " . $value['unit'] ?></td>
                            <?php }else {?>
                                <td>1 unit</td>
                            <?php } ?>
                            <td>Rp. <?php echo number_format($value['harga']) ?></td>

                            <?php if ($value['multiply'] == 'yes') { ?>
                                <td><?php $jumlahTotal = ((int)$value['jumlahtamu'] * (int)$value['harga']);
                                    echo "Rp" . number_format($jumlahTotal)   ?></td>
                            <?php } else { ?>
                                <td>Rp. <?php $jumlahTotal = $value['harga']; echo number_format($value['harga']) ?></td>
                            <?php } ?>
                        </tr>

                        <?php
                        $total = $total + $jumlahTotal;
                    } ?>
                    <tr>
                        <td colspan="5" align="left"><b>T O T A L  </b></td>
                        <td><h4><u>Rp. <?php echo number_format($total) ?>,-</u></h4></td>
                    </tr>
                </table>
                <br/>
            </td>
        </tr>
    </table>

</div>
</body>
</html>