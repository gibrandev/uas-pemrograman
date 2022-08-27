<?php
include "koneksi.php";

$page = isset($_GET["page"]);
$submit = isset($_POST["submit"]);

$kode = isset($_GET["kode"]) ? $_GET["kode"] : '';

$kode_seleksi = isset($_POST["kode_seleksi"]) ? $_POST["kode_seleksi"] : '';
$kode_calon_mhs = isset($_POST["kode_calon_mhs"]) ? $_POST["kode_calon_mhs"] : '';
$nilai_tkda = isset($_POST["nilai_tkda"]) ? $_POST["nilai_tkda"] : 0;
$nilai_matematika = isset($_POST["nilai_matematika"]) ? $_POST["nilai_matematika"] : 0;
$nilai_wawancara = isset($_POST["nilai_wawancara"]) ? $_POST["nilai_wawancara"] : 0;
$rata = 0;

if ($submit) {
    $rata = ($nilai_tkda + $nilai_matematika + $nilai_wawancara) / 3;
    $sql = "INSERT INTO table_seleksi (kode_seleksi, kode_calon_mhs, nilai_tkda, nilai_matematika, nilai_wawancara, rata_rata) VALUES ('$kode_seleksi', '$kode_calon_mhs', $nilai_tkda, $nilai_matematika, $nilai_wawancara, $rata)";
    if (mysqli_query($connect, $sql)) {
        header('Location: /lima.php?page=detail&kode='.$kode_seleksi);
    }
}

if ($page == 'detail' AND $kode) {
    $kode = $_GET["kode"];
    $sql = "SELECT * FROM table_seleksi WHERE kode_seleksi = '$kode' LIMIT 1";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $kode_seleksi = $row['kode_seleksi'];
            $kode_calon_mhs = $row['kode_calon_mhs'];
            $nilai_tkda = $row['nilai_tkda'];
            $nilai_matematika = $row['nilai_matematika'];
            $nilai_wawancara = $row['nilai_wawancara'];
            $rata = $row['rata_rata'];
        }
    }
}

?>

<html lang="id">
    <head>
        <title>Gibran Dimasagung - 201943500618</title>
    </head>
    <body>
    <?php
    if (!$page) {
    ?>
        <h2>Pilih calon mahasiswa:</h2>
        <form action="lima.php" method="post">
            <div>
                <label for="kode_seleksi">Kode Seleksi</label>
                <input type="text" name="kode_seleksi" id="kode_seleksi" required>
            </div>
            <div>
                <label for="kode_calon_mhs">Nama Calon Mahasiswa</label>
                <select name="kode_calon_mhs" id="kode_calon_mhs" required>
                    <option value="">Pilih Mahasiswa</option>
                    <?php
                    $sql 	= 'SELECT * FROM table_calon_mhs ORDER BY id DESC';
                    $query 	= mysqli_query($connect, $sql);
                    while($row = mysqli_fetch_array($query)){
                    ?>
                    <option value="<?php echo $row['kode_calon_mhs']?>"><?php echo $row['nama_calon_mhs']?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="nilai_tkda">Nilai Tes Kemampuan dasar</label>
                <input type="number" name="nilai_tkda" id="nilai_tkda" required>
            </div>
            <div>
                <label for="nilai_matematika">Nilai Matematika</label>
                <input type="number" name="nilai_matematika" id="nilai_matematika" required>
            </div>
            <div>
                <label for="nilai_wawancara">Nilai Wawancara</label>
                <input type="number" name="nilai_wawancara" id="nilai_wawancara" required>
            </div>
            <button name="submit" value="submit">Submit</button>
        </form>
    <?php }?>

    <?php
    if ($page == 'detail') {
    ?>
    <div>
        <h2>DATA HASIL SELEKSI</h2>
        <div>
            Kode Seleksi: <?php echo $kode_seleksi ?> <br>
            Kode Mhs: <?php echo $kode_calon_mhs ?> <br>
            Nilai TKDA: <?php echo $nilai_tkda ?> <br>
            Nilai Matematika: <?php echo $nilai_matematika ?> <br>
            Nilai Wawancara: <?php echo $nilai_wawancara ?> <br>
            Nilai Rata-Rata: <?php echo $rata ?> <br>
            Keterangan: <?php echo $rata > 60 ? 'Lulus' : 'Gagal' ?>
        </div>
    </div>
    <?php }?>
    </body>
</html>
