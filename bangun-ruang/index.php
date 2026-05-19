<?php
include 'function.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="?bangun=kubus">Kubus</a>
    <a href="?bangun=balok">Balok</a>
    <a href="?bangun=limas">Limas Segi Empat</a>
    <a href="?bangun=tabung">Tabung</a>
    <a href="?bangun=bola">bola</a>

    <form action="?bangun=<?= isset($_GET['bangun']) ? $_GET['bangun'] : '' ?>" method="post">
        <?php
        if (isset($_GET['bangun']) && $_GET['bangun'] == 'kubus') {
        ?>
            <label for="">Kubus</label>
            <input type="number" step="any" name="s">
        <?php
        } else if (isset($_GET['bangun']) && $_GET['bangun'] == 'balok') {
        ?>
            <label for="">Panjang</label>
            <input type="number" step="any" name="p">
            <label for="">Lebar</label>
            <input type="number" step="any" name="l">
            <label for="">Tinggi</label>
            <input type="number" step="any" name="t">
        <?php
        } else if (isset($_GET['bangun']) && $_GET['bangun'] == 'limas') {
        ?>
            <label for="">Sisi</label>
            <input type="number" step="any" name="s">
            <label for="">Tinggi</label>
            <input type="number" step="any" name="t">
        <?php
        } else if (isset($_GET['bangun']) && $_GET['bangun'] == 'tabung') {
        ?>
            <label for="">Jari Jari</label>
            <input type="number" step="any" name="r">
            <label for="">Tinggi</label>
            <input type="number" step="any" name="t">
        <?php
        } else if (isset($_GET['bangun']) && $_GET['bangun'] == 'bola') {
        ?>
            <label for="">Jari Jari</label>
            <input type="number" step="any" name="r">
        <?php
        }
        ?>
        <button type="submit" name="hitung">Hitung</button>
    </form>
    <?php
    echo "<br>";
    $bangun = $_GET['bangun'] ?? '';

    switch ($bangun) {
        case 'kubus':
            $s = $_POST['s'] ?? 0;
            $vol = volumeKubus($s);
            $lp = lpKubus($s);
            echo "Sisi = $s <br>";
            echo "<strong>(s^3) = " . round($vol, 2) . "</strong> <br>";
            echo "<strong>(6 x s^3) = " . round($lp, 2) . "</strong>";
            break;

        case 'balok':
            $p = $_POST['p'] ?? 0;
            $l = $_POST['l'] ?? 0;
            $t = $_POST['t'] ?? 0;
            $vol = volumeBalok($p, $l, $t);
            $lp = lpBalok($p, $l, $t);
            echo "Panjang = $p <br>";
            echo "Lebar = $l <br>";
            echo "Tinggi = $t <br>";
            echo "<strong>(V) = " . round($vol, 2) . "</strong> <br>";
            echo "<strong>(L) = " . round($lp, 2) . "</strong>";
            break;

        case 'limas':
            $s = $_POST['s'] ?? 0;
            $t = $_POST['t'] ?? 0;
            $vol = volumeLimas($s, $t);
            echo "Sisi = $s <br>";
            echo "Tinggi = $t <br>";
            echo "<strong>(V) = " . round($vol, 2) . "</strong> <br>";
            break;

        case 'tabung':
            $r = $_POST['r'] ?? 0;
            $t = $_POST['t'] ?? 0;
            $vol = volumeTabung($r, $t);
            echo "Jari Jari = $r <br>";
            echo "Tinggi = $t <br>";
            echo "<strong>(V) = " . round($vol, 2) . "</strong> <br>";
            break;

        case 'bola':
            $r = $_POST['r'] ?? 0;
            $vol = volumeBola($r);
            $lp = lpBola($r);
            echo "Jari Jari = $r <br>";
            echo "<strong>(V) = " . round($vol, 2) . "</strong> <br>";
            echo "<strong>(L) = " . round($lp, 2) . "</strong> <br>";
            break;
    }

    ?>
</body>

</html>