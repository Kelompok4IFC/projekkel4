<!doctype html>
<html lang="en">
  <head>
  	<title>SISTEM INFORMASI MENEJEMEN DATA DAN ASET</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= base_url('set/css/style.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/table.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/icon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/tabelpinjam.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pengaduan1.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/roi.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/images.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/user.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pesan.css') ?>">
  </head>
  <head>
  <title>Dashboard</title>
  <style>
    .menu {
      display: none;
    }

    .active {
      display: block;
    }

    canvas {
      width: 1300px;
        height: 500px;
        margin: 20px auto;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);;
        }
  </style>
  <script>
    function showSection(sectionId) {
      // Menyembunyikan semua bagian menu
      var sections = document.getElementsByClassName("menu");
      for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = "none";
      }

      // Menampilkan bagian yang terkait dengan menu yang diklik
      var section = document.getElementById(sectionId);
      section.style.display = "block";
    }

    window.addEventListener("DOMContentLoaded", function() {
    var ulElement = document.querySelector("ul");
    var canvasElement = document.getElementById("investasiChart");

    if (ulElement) {
      ulElement.addEventListener("click", function() {
        canvasElement.style.display = "none";
      });
    }
  });
  </script>

<body>
		
<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-danger">
	        </button>
        </div>
	  		<div class="img bg-wrap text-center py-4" style="background-image: url(/set/images/back.jpg);">
	  			<div class="user-logo">
	  				<div class="img" style="background-image: url(/set/images/logo.jpg);"></div>
            <h3>
              <?php
              // Ambil data karyawan yang login
              $username = session()->get('karyawan_username');

              // Panggil model Karyawan
              $karyawanModel = new \App\Models\ModelsKaryawan();
              $karyawan = $karyawanModel->where('karyawan_username', $username)->first();

              // Tampilkan nama karyawan
              if ($karyawan) {
                echo $karyawan['karyawan_username'];
              }
              ?>
            </h3>
	  			</div>
	  		</div>
        <ul>
          <li><a href="#about" onclick="showSection('section1'); return false;"><i class="bi bi-images"></i><span>Images</span></a></li>
          <li><a href="#hero" onclick="showSection('section2'); return false;"><i class="bi bi-table"></i><span>Table Asset</span></a></li>
          <li><a href="#resume" onclick="showSection('section3'); return false;"><i class="bi bi-table"></i><span>Table Pinjam</span></a></li>
          <li><a href="#pengaduan" onclick="showSection('section4'); return false;"><i class="bi bi-table"></i><span>Status dan Lokasi Aset</span></a></li>
          <li><a href="#roi" onclick="showSection('section5'); return false;"><i class="bi bi-table"></i><span>Investasi</span></a></li>
          <li><a href="#pesan" onclick="showSection('section6'); return false;"><i class="bi bi-chat-dots"></i></i><span>Pesan</span></a></li>
          <li><a href="#portfolio" onclick="showSection('section7'); return false;"><i class="bi bi-gear"></i><span>Setting</span></a></li>
          <li><a href="#history" onclick="showSection('section8'); return false;"><i class="bi bi-clock-history"></i><span>History</span></a></li>
          <li><a href="<?php echo site_url('KaryawanController/logout') ?>"><i class="bi bi-box-arrow-right"></i><span>Log Out</span></a></li>
        </ul>
    	</nav>
        <!-- Page Content  -->
<div id="content" class="p-4 p-md-5 pt-5">

<canvas id="investasiChart"></canvas>

<div id="section1" class="menu">
  <center><h2>Image Asset Kampus</h2></center>
<div class="card">
  <div class="navbar-image">
    <form action="<?= site_url('KaryawanController/upload') ?>" method="post" enctype="multipart/form-data">
      <label class="labelGambar" for="image">Pilih Gambar:</label>
      <input type="file" name="image" id="image" required>
      <button class="unggah" type="submit"><i class="bi bi-upload"></i></button>
    </form>
  </div>
  <?php if (session()->has('success')) : ?>
    <div class="alert alert-success"><?= session('success') ?></div>
  <?php endif; ?>

  <?php if (session()->has('error')) : ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
  <?php endif; ?>

  <?php if (!empty($images)) : ?>
    <ul class="image-list">
      <?php foreach ($images as $image) : ?>
        <li id="image-<?= $image['id'] ?>">
          <div class="card">
              <img class="card-img" src="<?= base_url('uploads/' . $image['filename']) ?>" alt="Gambar">
              <button class="delete-btn" onclick="deleteImage(<?= $image['id'] ?>)"><i class="bi bi-trash3-fill"></i></button>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>
</div>

<div id="section2" class="menu">
  <center><h2>Dokumentasi Asset Universitas Teknokrat Indonesia</h2></center>
        <div class="navbar">
          <button class="button" onclick="showAddForm()"><i class="bi bi-pencil-square"></i></button>
          <a href="<?= base_url('/export') ?>" class="excel"><i class="bi bi-file-earmark-spreadsheet"></i>Export to Excel</a>
          <input type="text" id="cari-asset" onkeyup="cariAsset()" placeholder="Cari Nama Asset...">
        </div>
  <div class="table-container">
    <table id="tabel-asset">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Asset</th>
          <th>Harga Beli</th>
          <th>Jumlah</th>
          <th>Kondisi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($assets)) : ?>
          <?php foreach ($assets as $key => $asset) : ?>
            <tr>
              <td><?= $key + 1 ?></td>
              <td><?= $asset['nama'] ?></td>
              <td><?= $asset['harga_beli'] ?></td>
              <td><?= $asset['jumlah'] ?></td>
              <td><?= $asset['kondisi_barang'] ?></td>
              <td>
                <a href="#" class="button" onclick="showConfirmation(<?= $asset['id'] ?>)"><i class="bi bi-trash-fill"></i></a>
                <button id="edit-button-<?= $key ?>" class="button" onclick="showEditForm(<?= $key ?>)"><i class="bi bi-pencil-fill"></i></button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="search-container">
    <?php if (isset($asset)) : ?>
      <?php foreach ($assets as $key => $asset) : ?>
      <div id="edit-form-<?= $key ?>" style="display: none;">
        <form id="update-form-<?= $asset['id'] ?>" action="<?= base_url('/KaryawanController/updateAsset/' . $asset['id']) ?>" method="post">
        <input type="text" name="nama" id="nama-<?= $asset['id'] ?>" value="<?= $asset['nama'] ?>">
        <input type="text" name="harga_beli" id="harga_beli-<?= $asset['id'] ?>" value="<?= $asset['harga_beli'] ?>">
        <input type="text" name="jumlah" id="jumlah-<?= $asset['id'] ?>" value="<?= $asset['jumlah'] ?>">
        <input type="text" name="kondisi_barang" id="kondisi_barang-<?= $asset['id'] ?>" value="<?= $asset['kondisi_barang'] ?>">
            <button class="button button-asset" onclick="confirUpdate(<?= $asset['id'] ?>)"><i class="bi bi-repeat"></i></button>
            <button type="button" onclick="cancelEdit(<?= $key ?>)"><i class="bi bi-x-circle-fill"></i></button>
          </form>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
    <div id="add-form" style="display: none;">
      <form action="<?= base_url('/KaryawanController/saveAsset') ?>" method="post">
        <input type="text" name="nama" placeholder="Nama Asset" required>
        <input type="text" name="harga_beli" placeholder="Harga" pattern="[0-9]+([.,][0-9]+)?" oninput="this.value = this.value.replace(/[^0-9.,]/g, '')" required>
        <input type="text" name="jumlah" placeholder="Jumlah" pattern="[0-9]+([.,][0-9]+)?" oninput="this.value = this.value.replace(/[^0-9.,]/g, '')" required>
        <input type="text" name="kondisi_barang" placeholder="Kondisi" required>
        <button type="submit"><i class="bi bi-upload"></i></button>
        <button type="button" onclick="cancelAdd()"><i class="bi bi-x-circle-fill"></i></button>
      </form>
    </div>
  </div>
</div>

<div id="section3" class="menu">
  <center>
    <h2>Rekap Aset Dipinjamkan sivitas</h2>
  </center>
  <div class="navbar-peminjaman">
    <button class="button" onclick="showAddPeminjam()"><i class="bi bi-pencil-square"></i></button>
    <a href="<?= site_url('/peminjaman/export') ?>" class="excelpinjam"><i class="bi bi-file-earmark-spreadsheet"></i>Export to Excel</a>
    <input type="text" id="cari-peminjam" onkeyup="cariPeminjam()" placeholder="Cari Nama Peminjam...">
  </div>
  <div class="table-pinjam">
    <table id="tabel-peminjam">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Peminjam</th>
          <th>Nama Barang</th>
          <th>Tanggal</th>
          <th>Nama Penanggung Jawab</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($peminjaman)) : ?>
          <?php foreach ($peminjaman as $key => $peminjam) : ?>
            <tr>
              <td><?= isset($peminjam['id']) ? $peminjam['id'] : '' ?></td>
              <td><?= isset($peminjam['nama_peminjam']) ? $peminjam['nama_peminjam'] : '' ?></td>
              <td><?= isset($peminjam['nama_barang']) ? $peminjam['nama_barang'] : '' ?></td>
              <td><?= isset($peminjam['tanggal']) ? $peminjam['tanggal'] : '' ?></td>
              <td><?= isset($peminjam['nama_penanggung_jawab']) ? $peminjam['nama_penanggung_jawab'] : '' ?></td>
              <td>
                <?php if (isset($peminjam['id'])) : ?>
                  <a href="#" class="button" onclick="showHapus(<?= $peminjam['id'] ?>)"><i class="bi bi-trash-fill"></i></a>
                  <button id="edit-pinjam-<?= $key ?>" class="button" onclick="showEditPeminjam(<?= $key ?>)"><i class="bi bi-pencil-fill"></i></button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="search-pinjam">
    <?php if (isset($peminjam)) : ?>
      <?php foreach ($peminjaman as $key => $peminjam) : ?>
        <div id="edit-peminjam-<?= $key ?>" style="display: none;">
          <form id="updateForm-<?= $peminjam['id'] ?>" action="<?= base_url('/KaryawanController/updatePeminjaman/' . $peminjam['id']) ?>" method="post">
            <input type="text" name="nama_peminjam" id="nama_peminjam-<?= $peminjam['id'] ?>" placeholder="Update Nama Peminjam" value="<?= isset($peminjam['nama_peminjam']) ? $peminjam['nama_peminjam'] : '' ?>" required>
            <input type="text" name="nama_barang" id="nama_barang-<?= $peminjam['id'] ?>" placeholder="Update Nama Barang" value="<?= isset($peminjam['nama_barang']) ? $peminjam['nama_barang'] : '' ?>" required>
            <input type="date" name="tanggal" id="tanggal-<?= $peminjam['id'] ?>" placeholder="Update Tanggal" value="<?= isset($peminjam['tanggal']) ? $peminjam['tanggal'] : '' ?>" required>
            <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab-<?= $peminjam['id'] ?>" placeholder="Update Nama Penanggung Jawab" value="<?= isset($peminjam['nama_penanggung_jawab']) ? $peminjam['nama_penanggung_jawab'] : '' ?>" required>
            <button class="button button-peminjaman" onclick="update_peminjaman(<?= $peminjam['id'] ?>)"><i class="bi bi-repeat"></i></button>
            <button type="button" onclick="hideUpdateForm(<?= $key ?>)"><i class="bi bi-x-circle-fill"></i></button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
    <div id="tambahForm" style="display: none;">
      <form action="<?= base_url('/KaryawanController/savePeminjaman') ?>" method="post">
        <input type="text" name="nama_peminjam" placeholder="Nama Peminjam" required>
        <input type="text" name="nama_barang" placeholder="Nama Barang" required>
        <input type="date" name="tanggal" placeholder="Tanggal" required>
        <input type="text" name="nama_penanggung_jawab" placeholder="Nama Penanggung Jawab" required>
        <button type="submit"><i class="bi bi-upload"></i></button>
        <button type="button" onclick="hideTambahForm()"><i class="bi bi-x-circle-fill"></i></button>
      </form>
    </div>
  </div>
</div>

<div id="section4" class="menu">
<center><h2>Tracking Asset Dan Lokasi</h2></center>
  <div class="navbar-tracking">
  	<button class="button-lokasi" onclick="showTracking()"><i class="bi bi-pencil-square"></i></button>
  	<td><a href="<?= base_url('TrackingController/export') ?>" class="excel"><i class="bi bi-file-earmark-spreadsheet"></i>Tracking Export</a></td>
  	<input type="text" id="cari-isi" onkeyup="cariIsi()" placeholder="Cari Nama Asset...">
  </div>
<div class="table-container">
  <table id="tabel-status-lokasi">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Asset</th>
        <th>Keadaan</th>
        <th>Tanggal Laporan</th>
        <th>Lokasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($tracking)) : ?>
        <?php foreach ($tracking as $key => $status) : ?>
          <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $status['nama'] ?></td>
            <td><?= isset($status['keadaan']) ? $status['keadaan'] : '' ?></td>
            <td><?= isset($status['tanggal']) ? date('Y-m-d', strtotime($status['tanggal'])) : '' ?></td>
            <td><?= isset($status['lokasi']) ? $status['lokasi'] : '' ?></td>
            <td>
              <a href="#" class="button" onclick="hapusTracking(<?= $status['id'] ?>)"><i class="bi bi-trash-fill"></i></a>
              <button id="edit-lokasi-<?= $key ?>" class="button" onclick="editTracking(<?= $key ?>)"><i class="bi bi-pencil-fill"></i></button>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<div class="search-container">
  <?php foreach ($tracking as $key => $status) : ?>
      <div id="edit-tracking-<?= $key ?>" style="display: none;">
          <form id="update-form-<?= $status['id'] ?>" action="<?= base_url('/KaryawanController/updateTracking/' . $status['id']) ?>" method="post">
            <input type="text" id="nama-<?= $status['id'] ?>" name="nama" placeholder="Update Nama Asset" value="<?= $status['nama'] ?>" required>
            <input type="text" id="keadaan-<?= $status['id'] ?>" name="keadaan" placeholder="Update Keadaan" value="<?= isset($status['keadaan']) ? $status['keadaan'] : '' ?>" required>
            <input type="date" id="tanggal-<?= $status['id'] ?>" name="tanggal" placeholder="Update Tanggal" value="<?= isset($status['tanggal']) ? $status['tanggal'] : '' ?>" required>
            <input type="text" id="lokasi-<?= $status['id'] ?>" name="lokasi" placeholder="Update Lokasi" value="<?= isset($status['lokasi']) ? $status['lokasi'] : '' ?>" required>
            <input type="hidden" id="status-<?= $status['id'] ?>" name="status" value="<?= isset($status['status']) ? $status['status'] : '' ?>">
            <button class="button button-tracking" data-id="<?= $status['id'] ?>"><i class="bi bi-repeat"></i></button>
            <button type="button" onclick="cancelEditTracking(<?= $key ?>)"><i class="bi bi-x-circle-fill"></i></button>
          </form>
      </div>
  <?php endforeach; ?>

  <div id="tambahTracking" style="display: none;">
    <form action="<?= base_url('/KaryawanController/save') ?>" method="post">
      <input type="text" name="nama" placeholder="Nama Asset" required>
      <input type="text" name="keadaan" placeholder="Keadaan" required>
      <input type="date" name="tanggal" placeholder="Tanggal" required>
      <input type="text" name="lokasi" placeholder="Lokasi" required>
      <button type="submit"><i class="bi bi-upload"></i></button>
      <button type="button" onclick="cancelLokasi()"><i class="bi bi-x-circle-fill"></i></button>
    </form>
  </div>
</div>
</div>

<div id="section5" class="menu">
  <center><h2>Perhitungan Nilai Aset Kampus</h2></center>
  <div class="navbar-roi">
    <button class="button-roi" onclick="showAddRoi()"><i class="bi bi-pencil-square"></i></button>
    <a href="<?= base_url('InvestasiController/exportToExcel') ?>" class="excel-roi"><i class="bi bi-file-earmark-spreadsheet"></i>Export to Excel</a>
    <input type="text" id="search-roi" onkeyup="searchROI()" placeholder="Cari Nama Investasi...">
  </div>
  <div class="table-roi">
    <table id="tabel-roi">
      <thead>
        <tr>
          <th>Nama Investasi</th>
          <th>Tanggal</th>
          <th>Tahun</th>
          <th>Keuntungan</th>
          <th>Biaya</th>
          <th>Roi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($investasi)) : ?>
          <?php foreach ($investasi as $key => $data) : ?>
            <tr>
              <td><?= isset($data['nama_investasi']) ? $data['nama_investasi'] : '' ?></td>
              <td><?= isset($data['tanggal']) ? $data['tanggal'] : '' ?></td>
              <td><?= isset($data['tahun']) ? $data['tahun'] : '' ?></td>
              <td><?= isset($data['keuntungan']) ? number_format($data['keuntungan'], 0, ',', '.') : '' ?></td>
              <td><?= isset($data['biaya']) ? number_format($data['biaya'], 0, ',', '.') : '' ?></td>
              <td>
                  <?php
                  $roi = isset($data['keuntungan']) && isset($data['biaya']) ? $data['keuntungan'] - $data['biaya'] : 0;
                  echo 'Rp ' . number_format($roi, 0, ',', '.');
                  ?>
              </td>
              <td>
                <?php if (isset($data['nama_investasi'])) : ?>
                  <a href="#" class="button-roi" onclick="hapusRoi('<?= $data['nama_investasi'] ?>')"><i class="bi bi-trash-fill"></i></a>
                  <button id="edit-buttonRoi-<?= $data['nama_investasi'] ?>" class="button" onclick="showEditRoi('<?= $data['nama_investasi'] ?>')"><i class="bi bi-pencil-fill"></i></button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="search-roi">
  <?php if (isset($investasi)) : ?>
  <?php foreach ($investasi as $index => $data) : ?>
    <div id="edit-roi-<?= $data['nama_investasi'] ?>" style="display: none;">
      <form id="update-roi-<?= $data['nama_investasi'] ?>" onsubmit="updateInvestasi('<?= $data['nama_investasi'] ?>', <?= $index ?>); return false;">
        <input type="text" name="nama_investasi" placeholder="Update Nama Investasi" value="<?= isset($data['nama_investasi']) ? $data['nama_investasi'] : '' ?>" required pattern="[A-Za-z\s]+" title="Hanya diperbolehkan huruf dan spasi">
        <input type="date" name="tanggal" placeholder="Update Tanggal" value="<?= isset($data['tanggal']) ? $data['tanggal'] : '' ?>" required>
        <input type="text" name="tahun" placeholder="Update Tahun" value="<?= isset($data['tahun']) ? $data['tahun'] : '' ?>" required>
        <input type="text" name="keuntungan" placeholder="Update Keuntungan" value="<?= isset($data['keuntungan']) ? number_format($data['keuntungan'], 0, ',', '.') : '' ?>" required>
        <input type="text" name="biaya" placeholder="Update Biaya" value="<?= isset($data['biaya']) ? number_format($data['biaya'], 0, ',', '.') : '' ?>" required>
        <button class="button button-update" onclick="updateRoi('<?= $data['nama_investasi'] ?>', <?= $index ?>)"><i class="bi bi-repeat"></i></button>
        <button type="button" onclick="cancelEditRoi('<?= $data['nama_investasi'] ?>')"><i class="bi bi-x-circle-fill"></i></button>
        <input type="hidden" name="original_nama_investasi" value="<?= $data['nama_investasi'] ?>">
      </form>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
    <div id="add-roi" style="display: none;">
      <form action="<?= base_url('KaryawanController/simpanInvestasi') ?>" method="post">
        <input type="text" name="nama_investasi" placeholder="Nama Investasi" required>
        <input type="date" name="tanggal" placeholder="Tanggal" required>
        <input type="text" name="tahun" placeholder="Tahun" required>
        <input type="text" name="keuntungan" placeholder="Keuntungan" required>
        <input type="text" name="biaya" placeholder="Biaya" required>
        <button type="submit" class="button-roi"><i class="bi bi-upload"></i></button>
        <button type="button" onclick="cancelTambahRoi()"><i class="bi bi-x-circle-fill"></i></button>
      </form>
    </div>
  </div>
</div>

<div id="section6" class="menu">
<div class="table-pengaduan">
  <center><h2>Tabel Pengaduan</h2></center>
  <div class="navbar-tracking">
    <td><a href="<?= base_url('pengaduan/exportToExcel') ?>" class="excel"><i class="bi bi-file-earmark-spreadsheet"></i>Pengaduan Export</a></td>
  </div>
  <?php if (!empty($pengaduan)) : ?>
    <table id="pengaduan-table">
      <thead>
        <tr>
          <th>Pengaduan</th>
          <th>Tanggal</th>
          <th>Waktu</th>
          <th>Ruangan</th>
          <th>Nama User</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="pengaduan-body">
        <?php foreach ($pengaduan as $data) : ?>
          <?php
            $pengaduan = isset($data['pengaduan']) ? $data['pengaduan'] : '';
            $tanggal = isset($data['tanggal']) ? $data['tanggal'] : '';
            $waktu = isset($data['waktu']) ? $data['waktu'] : '';
            $ruangan = isset($data['ruangan']) ? $data['ruangan'] : '';
            $nama_user = isset($data['nama_user']) ? $data['nama_user'] : '';
          ?>
          <tr>
            <td><?= $pengaduan ?></td>
            <td><?= $tanggal ?></td>
            <td><?= $waktu ?></td>
            <td><?= $ruangan ?></td>
            <td><?= $nama_user ?></td>
            <td>
              <a href="#" class="button" onclick="hapusPengaduan('<?= $pengaduan ?>')"><i class="bi bi-trash-fill"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else : ?>
    <p>Tidak ada data pengaduan.</p>
  <?php endif; ?>
</div>
</div>

<div id="section7" class="menu">
  <center><h2>Tabel User</h2></center>
<div class="navbar-user">
  <button class="button" onclick="showAddUser()"><i class="bi bi-pencil-square"></i></button>
  <input type="text" id="cari-user" onkeyup="cariUser()" placeholder="Cari Nama Pengguna...">
</div>
<div class="table-User">
  <table id="tabel-User">
    <thead>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Password</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($users)) : ?>
        <?php foreach ($users as $key => $user) : ?>
          <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= md5($user['password']) ?></td>
            <td>
              <a href="#" class="button" onclick="showConfirmationUser(<?= $user['id_user'] ?>)"><i class="bi bi-trash-fill"></i></a>
              <button id="edit-userAkun-<?= $key ?>" class="button" onclick="showEditUser(<?= $key ?>)"><i class="bi bi-pencil-fill"></i></button>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<div class="search-setting">
<?php if (isset($user['id_user'])) : ?>
  <?php foreach ($users as $key => $userData) : ?>
    <div id="edit-user-<?= $key ?>" style="display: none;">
      <form id="update-user-<?= $userData['id_user'] ?>" action="<?= base_url('/KaryawanController/updateUser/' . $userData['id_user']) ?>" method="post">
        <input type="text" name="username" id="username-<?= $userData['id_user'] ?>" value="<?= $userData['username'] ?>">
        <input type="password" name="password" id="password-<?= $userData['id_user'] ?>" value="<?= $userData['password'] ?>">
        <button class="button button-user" onclick="updateUser(<?= $userData['id_user'] ?>)"><i class="bi bi-repeat"></i></button>
        <button type="button" onclick="cancelEditUser(<?= $key ?>)"><i class="bi bi-x-circle-fill"></i></button>
      </form>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
<div id="add-user" style="display: none;">
  <form id="add-user-form" action="<?= base_url('/KaryawanController/saveUser') ?>" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit"><i class="bi bi-upload"></i></button>
    <button type="button" onclick="cancelAddUser()"><i class="bi bi-x-circle-fill"></i></button>
  </form>
</div>
</div>
</div>

<div id="section8" class="menu">
  <center><h2>History Tabel Asset</h2></center>
<table id="tabel-asset">
    <thead>
      <tr>
        <th>No</th>
        <th>Action</th>
        <th>Data</th>
        <th>User</th>
        <th>Timestamp</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($log_asset)) : ?>
        <?php foreach ($log_asset as $log) : ?>
          <tr>
            <td><?= $log['id'] ?></td>
            <td><?= $log['action'] ?></td>
            <td><?= $log['data'] ?></td>
            <td><?= $log['user'] ?></td>
            <td><?= $log['timestamp'] ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table><br></br>
  <center><h2>History Tabel Peminjaman</h2></center>
  <table id="tabel-asset">
    <thead>
      <tr>
        <th>No</th>
        <th>Action</th>
        <th>Data</th>
        <th>User</th>
        <th>Timestamp</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($log_peminjaman)) : ?>
        <?php foreach ($log_peminjaman as $log) : ?>
          <tr>
            <td><?= $log['id'] ?></td>
            <td><?= $log['action'] ?></td>
            <td><?= $log['data'] ?></td>
            <td><?= $log['user'] ?></td>
            <td><?= $log['timestamp'] ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table><br></br>
  <center><h2>History Tabel Tracking</h2></center>
  <table id="tabel-asset">
    <thead>
      <tr>
        <th>No</th>
        <th>Action</th>
        <th>Data</th>
        <th>User</th>
        <th>Timestamp</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($log_tracking)) : ?>
        <?php foreach ($log_tracking as $log) : ?>
          <tr>
            <td><?= $log['id'] ?></td>
            <td><?= $log['action'] ?></td>
            <td><?= $log['data'] ?></td>
            <td><?= $log['user'] ?></td>
            <td><?= $log['timestamp'] ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table><br></br>
</div>
</div>
</div>

    <script src="<?php echo base_url('set/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('set/js/popper.js'); ?>"></script>
    <script src="<?php echo base_url('set/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('set/js/main.js'); ?>"></script>
		<script src="<?php echo base_url('set/js/roi.js'); ?>"></script>
    <script src="<?php echo base_url('set/js/karyawan.js'); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $(document).ready(function() {
  <?php foreach ($investasi as $key => $data) : ?>
    <?php
    $keuntungan = isset($data['keuntungan']) ? floatval($data['keuntungan']) : 0;
    $biaya = isset($data['biaya']) ? floatval($data['biaya']) : 0;

    $roi = $biaya != 0 ? ($keuntungan - $biaya) / $biaya : 0;

    $formattedRoi = number_format($roi, 2);
    ?>
    $('#roi_<?= $key ?>').text('<?= $formattedRoi ?>');
  <?php endforeach; ?>
});
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        // Ambil data dari model InvestasiModel
        <?php
        $investasiModel = new \App\Models\InvestasiModel();
        $investasiData = $investasiModel->findAll();
        ?>

        // Buat array untuk menyimpan label dan data
        var labels = [];
        var data = [];
        var biaya = [];
        var keuntungan = [];

        // Loop melalui data InvestasiModel dan tambahkan label, data, biaya, dan keuntungan ke array
        <?php foreach ($investasiData as $row) : ?>
            labels.push('<?php echo $row['nama_investasi']; ?>');
            data.push(<?php echo $row['roi']; ?>);
            biaya.push(<?php echo $row['biaya']; ?>);
            keuntungan.push(<?php echo $row['keuntungan']; ?>);
        <?php endforeach; ?>

        // Membuat diagram menggunakan Chart.js
        var ctx = document.getElementById('investasiChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'ROI (Return on Investment)',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)', // Warna latar belakang batang diagram
                    borderColor: 'rgba(75, 192, 192, 1)', // Warna garis batas batang diagram
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                var index = context.dataIndex;
                                var tooltipLabel = 'Biaya: ' + biaya[index] + ' | Keuntungan: ' + keuntungan[index];
                                label += ' (' + tooltipLabel + ')';
                                return label;
                            }
                        }
                    }
                }
            }
        });
</script>
</body>
</html>