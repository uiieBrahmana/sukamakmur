<h1>Detail peralatan</h1>

<table>
    <tr>
        <td>idperalatan</td>
        <td><?php echo $Peralatan['idperalatan'] ?></td>
    </tr>
    <tr>
        <td>nama</td>
        <td><?php echo $Peralatan['nama'] ?></td>
    </tr>
    <tr>
        <td>hargasewa</td>
        <td>Rp. <?php echo number_format($Peralatan['hargasewa']) ?></td>
    </tr>
    <tr>
        <td>keterangan</td>
        <td><?php echo $Peralatan['keterangan'] ?></td>
    </tr>
    <tr>
        <td>jumlah</td>
        <td><?php echo $Peralatan['jumlah'] ?></td>
    </tr>
</table>
