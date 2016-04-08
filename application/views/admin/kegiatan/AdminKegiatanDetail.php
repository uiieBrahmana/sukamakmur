<h1>Detail peralatan</h1>

<table>
    <tr>
        <td>idkegiatan</td>
        <td><?php echo $Kegiatan['idkegiatan'] ?></td>
    </tr>
    <tr>
        <td>nama</td>
        <td><?php echo $Kegiatan['nama'] ?></td>
    </tr>
    <tr>
        <td>lamakegiatan</td>
        <td><?php echo $Kegiatan['lamakegiatan'] ?></td>
    </tr>
    <tr>
        <td>pesertamin</td>
        <td><?php echo $Kegiatan['pesertamin'] ?></td>
    </tr>
    <tr>
        <td>pesertamax</td>
        <td><?php echo $Kegiatan['pesertamax'] ?></td>
    </tr>
    <tr>
        <td>keterangan</td>
        <td><?php echo $Kegiatan['keterangan'] ?></td>
    </tr>
    <tr>
        <td>harga</td>
        <td><?php echo number_format($Kegiatan['harga']) ?></td>
    </tr>
</table>
