<?php
    include "koneksi.php";

    $page = isset($_GET["page"]);
    $submit = isset($_POST["submit"]);
    $edit = isset($_GET["edit"]);
    $delete = isset($_GET["delete"]);

    $id = isset($_POST["id"]) ? $_POST["id"] : '';
    $kode_calon_mhs = isset($_POST["kode_calon_mhs"]) ? $_POST["kode_calon_mhs"] : '';
    $nama_calon_mhs = isset($_POST["nama_calon_mhs"]) ? $_POST["nama_calon_mhs"] : '';
    $alamat = isset($_POST["alamat"]) ? $_POST["alamat"] : '';
    $telp = isset($_POST["telp"]) ? $_POST["telp"] : '';

    if ($edit) {
        $id = $_GET["edit"];
        $sql = "SELECT * FROM table_calon_mhs WHERE id = $id LIMIT 1";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $kode_calon_mhs = $row['kode_calon_mhs'];
                $nama_calon_mhs = $row['nama_calon_mhs'];
                $alamat = $row['alamat'];
                $telp = $row['telp'];
            }
        }
    }

    if ($submit) {
        if ($id == '') {
            $sql = "INSERT INTO table_calon_mhs (kode_calon_mhs, nama_calon_mhs, alamat, telp) VALUES ('$kode_calon_mhs', '$nama_calon_mhs', '$alamat', '$telp')";
        } else {
            $sql = "UPDATE table_calon_mhs SET kode_calon_mhs = '$kode_calon_mhs', nama_calon_mhs = '$nama_calon_mhs', alamat = '$alamat', telp = '$telp' WHERE id = $id";
        }
        if (mysqli_query($connect, $sql)) {
            header('Location: /empat.php');
        }
    }

    if ($page == 'delete' AND $delete) {
        $id = $_GET["delete"];
        $sql = "DELETE FROM table_calon_mhs WHERE id = $id";

        if ($connect->query($sql) === TRUE) {
            header('Location: /empat.php');
        }
    }
?>
<html lang="id">
    <head>
        <title>Gibran Dimasagung - 201943500618</title>
    </head>
    <body>
        <?php
            if(!$page) {
        ?>
        <div style="margin-bottom: 10px;">
            <a href="empat.php?page=create">Create</a>
        </div>
        <div>
            <table border="1">
                <tr>
                    <th>Kode Mahasiswa</th>
                    <th>Nama Mahasiswa</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
                <?php
                    $sql 	= 'SELECT * FROM table_calon_mhs ORDER BY id DESC';
                    $query 	= mysqli_query($connect, $sql);
                    while($row = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $row['kode_calon_mhs']?></td>
                    <td><?php echo $row['nama_calon_mhs']?></td>
                    <td><?php echo $row['alamat']?></td>
                    <td><?php echo $row['telp']?></td>
                    <td><a href="empat.php?page=edit&edit=<?php echo $row['id']?>">Edit</a> | <a href="empat.php?page=delete&delete=<?php echo $row['id']?>">Delete</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <?php }?>

        <?php
        if($page == 'create' OR $page == 'edit') {
        ?>
            <div>
                <form action="empat.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div>
                        <label for="kode_calon_mhs">Kode Mahasiswa</label>
                        <input type="text" name="kode_calon_mhs" id="kode_calon_mhs" value="<?php echo $kode_calon_mhs ?>">
                    </div>
                    <div>
                        <label for="nama_calon_mhs">Nama Mahasiswa</label>
                        <input type="text" name="nama_calon_mhs" id="nama_calon_mhs" value="<?php echo $nama_calon_mhs ?>">
                    </div>
                    <div>
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat"><?php echo $alamat ?></textarea>
                    </div>
                    <div>
                        <label for="telp">Telepon</label>
                        <input type="text" name="telp" id="telp" value="<?php echo $telp ?>">
                    </div>
                    <button name="submit" value="submit">Submit</button>
                </form>
            </div>
        <?php }?>
    </body>
</html>