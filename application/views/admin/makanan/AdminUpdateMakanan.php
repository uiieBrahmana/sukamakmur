<h1>update makanan</h1>
<form action="<?php echo base_url() ?>index.php/administrator/adminupdatemakanan" method="post">
    <input type="hidden" name="idmenumakanan" value="<?php echo $Menumakanan['idmenumakanan'] ?>"><br/>
    <input type="text" name="idtipemakanan" value="<?php echo $Menumakanan['idtipemakanan'] ?>"><br/>
    <input type="text" name="keterangan" value="<?php echo $Menumakanan['keterangan'] ?>"><br/>
    <input type="submit" name="submit">
</form>