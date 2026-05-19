<?php
const email = "rdhrvl@gmail.com";

echo email, "<br>";

define("namas", "reval");

echo namas, "<br>";


$fruits = ["Apel", "Mangga", "Pisang"];

array_push($fruits, "Quldi", "Anggur");

foreach ($fruits as $key => $fruit) {
    echo "Nama buah adalahh: $fruit <br>";
}

$motorcycles = [[
    'merk' => 'Piagio',
    'warna' => 'Hijau',
    'tahun' => 2016,
    'cc' => 150
], [
    'merk' => 'Yamaha',
    'warna' => 'Merah',
    'tahun' => 2020,
    'cc' => 150
], [
    'merk' => 'Ducati',
    'warna' => 'Merah',
    'tahun' => 2022,
    'cc' => 700
]];

// var_dump($motorcycles);

foreach ($motorcycles as $index => $motorcycle) {
    if ($index != 2) {
        echo " <ul>
            <li>Merk :" . $motorcycle['merk'] . "</li>
            <li>Warna :" .  $motorcycle['warna'] . "</li>
            <li>Tahun :" .  $motorcycle['tahun'] . "</li>
            <li>CC :" .  $motorcycle['cc'] . "</li>
        </ul>";
    }
}

echo $motorcycles[2]["cc"];

echo "<br>";

$nama = "budi";

if ($nama == "Anto") {
    echo "Benar";
} else {
    echo "Salah";
}

echo "<br>";

$nilai = 10;
if ($nilai >= 90 && $nilai <= 100) {
    echo "A";
} elseif ($nilai >= 80 && $nilai <= 89) {
    echo "B";
} elseif ($nilai <= 79 && $nilai >= 0) {
    echo "C";
} else {
    echo "Nilai tidak diketahui";
}
$hasil = ($nilai >= 90 && $nilai <= 100) ? 'A' : ($nilai >= 80 && $nilai <= 89 ? 'B' : ($nilai <= 79 && $nilai >= 0 ? 'C' : 'Nilai tidak diketahui'));

echo $hasil;

echo "<br>";


$warna = "hijau";

switch ($warna) {
    case 'biru':
        echo "Ini warna biru";
        break;
    case 'merah':
        echo "Ini warna merah";
        break;
    case 'hijau':
        echo "Ini warna hijau";
        break;
    case 'ungu':
        echo "Ini warna ungu";
        break;
    case 'pink':
        echo "Ini warna pink";
        break;
    case 'kuning':
        echo "Ini warna kuning";
        break;
    default:
        echo "Bukan warna";
        break;
}

echo "<br>";


// Looping atau perulangan = struktur kode yang digunakan untuk menjalankan blok kode selama kondisi terpenuhi

// for, while, do while

for ($i = 1; $i <= 15; $i++) {
    echo "Saya Seorang pelajar di PPDK Jakarta Pusat $i";
    echo "<br>";
}

$a = 1;

echo "<br>";


while ($a <= 10) {
    echo "ini angka ke-$a";
    echo "<br>";
    $a++;
}

echo "<br>";


$b = 1;

do {
    echo "Halo ke-$b";
    echo "<br>";
    $b++;
} while ($b <= 10);



// Function : blok code yang diberi nama, yang bisa dipanggil kapan saja untuk menjalankan tugas tertentu
// Menghindari perulangan kode (reuse code), memecah logika menjadi bagian terkecil
// - array_push(), substr(), strln(), str_word_count(), ucfirst()

echo "<br>";

function namaAnda($nama, $usia)
{
    return "Nama anda adalah $nama, usia anda adalah $usia tahun";
}

echo namaAnda("andi", 55);
echo "<br>";
echo namaAnda("Rudi", 99);
echo "<br>";
echo namaAnda("Mesa", 17);

$stringName = "Saya sedang belajar pemograman dasar pada bahasa pemrograman PHP";

echo "<br>";

echo substr($stringName, 12);

echo "<br>";

echo strlen($stringName);

echo "<br>";

echo str_word_count($stringName);

echo "<br>";

echo ucfirst($stringName);

echo "<br>";

echo ucwords($stringName);

echo "<br>";

echo lcfirst($stringName);
