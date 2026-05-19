<?php
session_start();

$upload_dir = "uploads/";

// Cek jika direktori ada dan dapat diakses
if (!is_dir($upload_dir)) {
    echo "Direktori tidak ditemukan.";
    exit;
}

// Ambil semua file dari direktori
$files = array_diff(scandir($upload_dir), array('.', '..'));

// Ambil pesan dari sesi
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar File Unggahan</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <style>
        /* Gaya kustom untuk perataan tengah di semua sel tabel */
        #myTable th,
        #myTable td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar File Unggahan</h1>
        <?php if ($message): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <?php if (empty($files)): ?>
            <p>Tidak ada file yang diunggah.</p>
        <?php else: ?>
                <table id="myTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama File</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $i=1; ?>
                <?php foreach ($files as $file): ?>
                    <tr>
                        <td ><?= $i++; ?></td>
                        <td><?php echo $file; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                </table>
        <?php endif; ?>
        <a class="btn btn-primary mt-3" href="index.php">Kembali</a>
        <!-- <a class="btn-back" href="index.php">Kembali</a> -->
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>
