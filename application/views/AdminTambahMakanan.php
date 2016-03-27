<html>
<head>
    <base href="<?php echo base_url(); ?>">
</head>
<body>
<form method="post" action="index.php/administrator/admintambahmakanan">
    <textarea name="keterangan" id="" cols="30" rows="10"></textarea>
    <select name="tipe">
        <?php
        foreach ($TipeMakanan as $v) {
            echo "<option value='" . $v['idtipemakanan'] . "'>Paket " . $v['idtipemakanan'] . " : " . $v['keterangan'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Kirim" name="_submit">
</form>
</body>
</html>