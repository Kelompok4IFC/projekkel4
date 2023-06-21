<!DOCTYPE html>
<html lang="en">
<head>
  <title>SISTEM INFORMASI MANAJEMEN DATA DAN ASET</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?= base_url('assets/css/pengaduan.css') ?>">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    /* Animasi fadeIn */
    .fade-in {
      opacity: 0;
      animation: fadeInAnimation 1s forwards;
    }

    @keyframes fadeInAnimation {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }
  </style>
</head>
<body>
  <div class="table-container">
    <center><h2>Kirim Pesan Pengaduan</h2></center>
    <table id="pengaduan-table">
    </table>
  </div>
  <div class="form-container">
    <form id="pengaduan-form" action="<?= base_url('pengaduan') ?>" method="post">
      <input type="text" name="pengaduan" placeholder="Pengaduan" required>
      <input type="date" name="tanggal" required>
      <input type="time" name="waktu" required>
      <input type="text" name="ruangan" placeholder="Ruangan" required>
      <input type="text" name="nama_user" placeholder="Nama User" required>
      <button type="submit" onclick="showAlert()">Kirim</button>
    </form>
    <form action="<?= base_url('PengaduanUser/logout') ?>" method="post">
    <button type="submit" class="logout">Logout</button>
    </form>
  </div>

<script>
  var form = document.getElementById("pengaduan-form");
  form.addEventListener("submit", function(event) {
    event.preventDefault();

    // Tampilkan notifikasi SweetAlert setelah submit berhasil
    swal("Pengaduan telah terkirim, mohon ditunggu", {
      icon: "success",
    }).then(function() {
      form.submit();
    });
  });
</script>
</body>
</html>
