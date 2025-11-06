<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Input Barang</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        form, table { background: #fff; padding: 15px; border-radius: 8px; }
        input, select, textarea { padding: 5px; width: 100%; margin: 4px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        button { padding: 8px 15px; background: #28a745; color: #fff; border: none; border-radius: 4px; }
        button:hover { background: #218838; cursor: pointer; }
    </style>
</head>
<body>

<h2>Form Input Barang</h2>

<form method="POST">
    <label>No:</label>
    <input type="text" name="no" required>
    <label>Nama:</label>
    <input type="text" name="nama" required>
    <label>Barang:</label>
    <input type="text" name="barang" required>
    <label>Satuan:</label>
    <input type="text" name="satuan" required>
    <label>Jumlah Barang:</label>
    <input type="number" name="jumlah" required>
    <label>Harga per Satuan:</label>
    <input type="number" name="harga" step="0.01" required>
    <label>Keterangan:</label>
    <textarea name="keterangan"></textarea><br>
    <button type="submit" name="simpan">Simpan</button>
</form>

<?php
if (isset($_POST['simpan'])) {
    $no = $_POST['no'];
    $nama = $_POST['nama'];
    $barang = $_POST['barang'];
    $satuan = $_POST['satuan'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $ppn = $harga * $jumlah * 0.10;
    $total = ($harga * $jumlah) + $ppn;
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO barang (no, nama, barang, satuan, jumlah, harga_per_satuan, ppn, total, keterangan)
            VALUES ('$no','$nama','$barang','$satuan','$jumlah','$harga','$ppn','$total','$keterangan')";
    mysqli_query($koneksi, $sql);
    echo "<script>alert('Data berhasil disimpan!'); window.location='index.php';</script>";
}
?>

<h3>Data Barang</h3>
<a href="export_excel.php"><button>Download Excel</button></a>
<table>
    <tr>
        <th>No</th><th>Nama</th><th>Barang</th><th>Satuan</th>
        <th>Jumlah</th><th>Harga/Satuan</th><th>PPN 10%</th><th>Total</th><th>Keterangan</th>
    </tr>
    <?php
    $result = mysqli_query($koneksi, "SELECT * FROM barang");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['no']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['barang']}</td>
            <td>{$row['satuan']}</td>
            <td>{$row['jumlah']}</td>
            <td>{$row['harga_per_satuan']}</td>
            <td>{$row['ppn']}</td>
            <td>{$row['total']}</td>
            <td>{$row['keterangan']}</td>
        </tr>";
    }
    ?>
</table>

</body>
</html>
