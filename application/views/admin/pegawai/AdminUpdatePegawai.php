

<form action="<?php echo base_url(); ?>index.php/administrator/adminupdatepegawai/" method="post">
    <input type="hidden" name="idtamu" value="<?php echo $Member['idpegawai']; ?>"><br/>
    <input type="text" name="nama" value="<?php echo $Member['nama']; ?>"><br/>
    <input type="text" name="tanggallahir" value="<?php echo $Member['tanggallahir']; ?>"><br/>
    <input type="text" name="jeniskelamin" value="<?php echo $Member['jeniskelamin']; ?>"><br/>
    <input type="text" name="alamat" value="<?php echo $Member['alamat']; ?>"><br/>
    <input type="text" name="email" value="<?php echo $Member['email']; ?>"><br/>
    <input type="text" name="notelp" value="<?php echo $Member['notelp']; ?>"><br/>
    <input type="text" name="username" value="<?php echo $Member['username']; ?>"><br/>
    <input type="password" name="password" value="<?php echo $Member['password']; ?>"><br/>
    <input type="submit" name="submit">
</form>