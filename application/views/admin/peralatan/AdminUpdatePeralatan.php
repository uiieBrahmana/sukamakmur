<h1>update peralatan</h1>
<form action="<?php echo base_url() ?>index.php/administrator/adminupdateperalatan" method="post">
    <input type="hidden" name="idperalatan" value="<?php echo $Peralatan['idperalatan'] ?>"><br/>
    <input type="text" name="nama" value="<?php echo $Peralatan['nama'] ?>"><br/>
    <input type="text" name="hargasewa" value="<?php echo $Peralatan['hargasewa'] ?>"><br/>
    <input type="text" name="keterangan" value="<?php echo $Peralatan['keterangan'] ?>"><br/>
    <input type="text" name="jumlah" value="<?php echo $Peralatan['jumlah'] ?>"><br/>
    <input type="submit" name="submit">
</form>