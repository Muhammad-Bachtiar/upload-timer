<?php
// Baca file status
$statusFile = "status.txt";
if (!file_exists($statusFile)) {
    file_put_contents($statusFile, 0);
}

$endTime = (int) file_get_contents($statusFile);
$currentTime = time();
$remaining = $endTime - $currentTime;

// Kalau sisa waktu < 0, paksa jadi 0
if ($remaining < 0) $remaining = 0;

// Status aktif?
$formActive = $remaining > 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Upload Projek</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  
		<div class="container">
		<h1>Form Upload</h1>
		
		<div id="timer"></div>

  <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data"
        class="<?php echo $formActive ? '' : 'disabled'; ?>">
    <!-- input file disembunyikan -->
  <input type="file" name="fileToUpload" id="fileToUpload" required hidden>
  
  <!-- label jadi tombol -->
  <label for="fileToUpload" class="custom-file-btn">📂 Pilih File</label>
  
  <!-- tampilkan nama file yang dipilih -->
  <span id="fileName">Belum ada file dipilih</span><br><br>

    <input type="submit" value="Unggah File" <?php echo $formActive ? '' : 'disabled'; ?>>
  </form>
</div>
  <script>
    let remaining = <?php echo $remaining; ?>;
    const timerDisplay = document.getElementById("timer");
    const form = document.getElementById("uploadForm");

    function formatTime(sec) {
      const h = Math.floor(sec / 3600);
	  const m = Math.floor((sec % 3600) / 60);
	  const s = sec % 60;
	  return String(h).padStart(2, '0') + ":" +
			 String(m).padStart(2, '0') + ":" +
			 String(s).padStart(2, '0');
    }

    function update() {
      if (remaining > 0) {
        timerDisplay.textContent = "Sisa waktu: " + formatTime(remaining);
        remaining--;
      } else {
        timerDisplay.textContent = "⏰ Waktu habis! Maaf anda tidak dapat mengupload.";
        form.classList.add("disabled");
        const elements = form.elements;
        for (let i = 0; i < elements.length; i++) elements[i].disabled = true;
      }
    }

    update();
    setInterval(update, 1000);
    // === Tambahan untuk menampilkan nama file ===
    const fileInput = document.getElementById("fileToUpload");
    const fileName = document.getElementById("fileName");

    fileInput.addEventListener("change", function() {
      if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
      } else {
        fileName.textContent = "Belum ada file dipilih";
      }
    });
  </script>
</body>
</html>
