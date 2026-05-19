<?php

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
if (isset($_POST['tampil'])) {
    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $alamat = $_POST['alamat'];
    $number1 = floatval($_POST['number1'] ?? 0);
    $number2 = floatval($_POST['number2'] ?? 0);
    $operasi = $_POST['operator'];
    function hasilPerhitungan($number1, $operasi, $number2)
    {
        $hasil = 0;
        switch ($operasi) {
            case 'tambah':
                $hasil = $number1 + $number2;
                break;
            case 'kurang':
                $hasil = $number1 - $number2;
                break;
            case 'kali':
                $hasil = $number1 * $number2;
                break;
            case 'bagi':
                $hasil = $number1 / $number2;
                break;
        }
        return $hasil;
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="name">Nama</label><br>
        <input type="text" name="name" id="name"><br>
        <label for="nim">NIM</label><br>
        <input type="number" name="nim" id="nim"><br>
        <label for="number1">Number1</label><br>
        <input type="number" step="any" name="number1" id="number1"><br><br>

        <select name="operator" id="operator">
            <option value="tambah">+</option>
            <option value="kurang">-</option>
            <option value="kali">*</option>
            <option value="bagi">/</option>
        </select><br><br>

        <label for="number2" step="any">Number2</label><br>
        <input type="number" name="number2" id="number2"><br>

        <label for="alamat">Alamat</label><br>
        <textarea name="alamat" cols="30" rows="5"></textarea><br>
        <button type="submit" name="tampil">Tampilkan data</button>
    </form>

    <?php
    if (isset($_POST['tampil'])) {
        echo "<ul>
        <li>Nama: $name</li>
        <li>NIM: $nim</li>
        <li>Alamat: $alamat</li>
        <li>Hasil:" . hasilPerhitungan($number1, $operasi, $number2) . "</li>
        </ul>";
    }
    ?>

</body>

</html>