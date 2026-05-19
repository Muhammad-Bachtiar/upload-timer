<?php
$statusFile = "status.txt";

// Atur ulang waktu (misalnya 5 menit dari sekarang)
$duration = 60; //atur waktu pengumpulan di sini

$newEndTime = time() + $duration;

// Simpan ke file
file_put_contents($statusFile, $newEndTime);

header("location:/upload/index.php");

// "✅ Timer berhasil di-reset. <a href='index.php'>Kembali ke form</a>";
