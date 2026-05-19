<?php
session_start();

$upload_dir = "uploads/";
$target_file = $upload_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Cek apakah file adalah gambar atau dokumen
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['message'] = "File bukan gambar.";
        $uploadOk = 0;
    }
}

// Cek apakah file sudah ada
if (file_exists($target_file)) {
    $_SESSION['message'] = "Maaf, file sudah ada.";
    $uploadOk = 0;
}

// Batasi ukuran file maksimum (contoh: 5MB)
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    $_SESSION['message'] = "Maaf, file terlalu besar.";
    $uploadOk = 0;
}

// Batasi format file yang diizinkan
if ($fileType = "jpg" || $fileType = "png" || $fileType = "jpeg" || $fileType = "gif" || $fileType = "pdf" || $fileType = "odt") {
    // $_SESSION['message'] = "Maaf, hanya file ODT, JPG, JPEG, PNG, GIF, dan PDF yang diperbolehkan.";
    $uploadOk = 1;
}

// Cek jika $uploadOk bernilai 0 karena kesalahan
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $_SESSION['message'] = "File ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " telah diunggah.";
    } else {
        $_SESSION['message'] = "Maaf, terjadi kesalahan saat mengunggah file.";
    }
} else {
    $_SESSION['message'] = "Maaf, file tidak dapat diunggah.";
}

// Redirect ke halaman list_files.php
header("Location: list_files.php");
exit();
?>
