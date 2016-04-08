<h1>update peralatan</h1>
<form action="<?php echo base_url() ?>index.php/administrator/adminupdatekegiatan" method="post">
    <input type="hidden" name="idkegiatan" value="<?php echo $Kegiatan['idkegiatan'] ?>"><br/>
    <input type="text" name="nama" value="<?php echo $Kegiatan['nama'] ?>"><br/>
    <input type="text" name="lamakegiatan" value="<?php echo $Kegiatan['lamakegiatan'] ?>"><br/>
    <input type="text" name="pesertamin" value="<?php echo $Kegiatan['pesertamin'] ?>"><br/>
    <input type="text" name="pesertamax" value="<?php echo $Kegiatan['pesertamax'] ?>"><br/>
    <input type="text" name="keterangan" value="<?php echo $Kegiatan['keterangan'] ?>"><br/>
    <input type="text" name="harga" value="<?php echo $Kegiatan['harga'] ?>"><br/>
    <input type="submit" name="submit">
</form>
