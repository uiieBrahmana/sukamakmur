<h1>update makanan</h1>
<form action="<?php echo base_url() ?>index.php/administrator/adminupdatetipemakanan" method="post">
    <input type="hidden" name="idtipemakanan" value="<?php echo $TipeMakanan['idtipemakanan'] ?>"><br/>
    <input type="text" name="keterangan" value="<?php echo $TipeMakanan['keterangan'] ?>"><br/>
    <input type="text" name="harga" value="<?php echo $TipeMakanan['harga'] ?>"><br/>
    <input type="submit" name="submit">
</form>