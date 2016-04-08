<h1>Detail makanan</h1>

<table>
    <tr>
        <td>idtipemakanan</td>
        <td><?php echo $TipeMakanan['idtipemakanan'] ?></td>
    </tr>
    <tr>
        <td>keterangan</td>
        <td><?php echo $TipeMakanan['keterangan'] ?></td>
    </tr>

    <tr>
        <td>harga</td>
        <td>Rp. <?php echo number_format($TipeMakanan['harga']) ?></td>
    </tr>
</table>
