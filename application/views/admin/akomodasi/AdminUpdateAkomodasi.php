<h1>Update Akomodasi</h1>

<form action="<?php echo base_url() ?>index.php/administrator/adminupdateakomodasi" method="post">

    <input type="hidden" name="idakomodasi" value="<?php echo $Akomodasi['idakomodasi'] ?>"><br/>
    <input type="text" name="nama" value="<?php echo $Akomodasi['nama'] ?>"><br/>
    <input type="text" name="keterangan" value="<?php echo $Akomodasi['keterangan'] ?>"><br/>
    <input type="text" name="kapasitas" value="<?php echo $Akomodasi['kapasitas'] ?>"><br/>
    <input type="text" name="status" value="<?php echo $Akomodasi['status'] ?>"><br/>
    <input type="text" name="harga" value="<?php echo $Akomodasi['harga'] ?>"><br/>
    <input type="submit" name="submit">

</form>
