function cariAsset() {
  var input, filter, table, tbody, tr, td, i, txtValue;
  input = document.getElementById("cari-asset");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabel-asset");
  tbody = table.getElementsByTagName("tbody")[0];
  tr = tbody.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1]; // Mengambil kolom kedua (indeks 1) yang berisi Nama Asset
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function cariPeminjam() {
  var input, filter, table, tbody, tr, td, i, txtValue;
  input = document.getElementById("cari-peminjam");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabel-peminjam");
  tbody = table.getElementsByTagName("tbody")[0];
  tr = tbody.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1]; // Mengambil kolom kedua (indeks 1) yang berisi Nama Asset
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function cariIsi() {
  var input, filter, table, tbody, tr, td, i, txtValue;
  input = document.getElementById("cari-isi");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabel-status-lokasi");
  tbody = table.getElementsByTagName("tbody")[0];
  tr = tbody.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1]; // Mengambil kolom kedua (indeks 1) yang berisi Nama Asset
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function searchROI() {
  var input, filter, table, tbody, tr, td, i, txtValue;
  input = document.getElementById("search-roi");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabel-roi");
  tbody = table.getElementsByTagName("tbody")[0];
  tr = tbody.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0]; // Mengambil kolom kedua (indeks 1) yang berisi Nama Asset
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function cariUser() {
  var input, filter, table, tbody, tr, td, i, txtValue;
  input = document.getElementById("cari-user");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabel-User"); // Mengganti 'tabel-user' dengan 'tabel-User'
  tbody = table.getElementsByTagName("tbody")[0];
  tr = tbody.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1]; // Mengambil kolom ketiga (indeks 2) yang berisi Nama pengguna
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

$(document).ready(function() {
  // Menangani klik pada button update menggunakan event delegation
  $(document).on('click', '.button-asset', function(e) {
    e.preventDefault(); // Mencegah perilaku default dari button

    // Mendapatkan ID dari button yang diklik
    const id = $(this).attr('onclick').match(/\d+/)[0];

    // Menampilkan konfirmasi SweetAlert
    confirUpdate(id);
  });
});

function confirUpdate(id) {
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin mengubah data ini?",
    icon: "warning",
    buttons: {
      cancel: "Batal",
      confirm: "Ya"
    },
    dangerMode: true,
  }).then((confirmed) => {
    if (confirmed) {
      update(id);
    }
  });
}

function update(id) {
  const nama = $('#nama-' + id).val();
  const harga_beli = $('#harga_beli-' + id).val();
  const jumlah = $('#jumlah-' + id).val();
  const kondisi_barang = $('#kondisi_barang-' + id).val();

  $.ajax({
    url: '/KaryawanController/updateAsset/' + id,
    type: 'POST',
    dataType: 'json',
    data: {
      nama: nama,
      harga_beli: harga_beli,
      jumlah: jumlah,
      kondisi_barang: kondisi_barang
    },
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil diubah",
          icon: "success",
        }).then(() => {
          // Redirect ke halaman awal setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal mengubah data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function showConfirmation(id) {
  assetIdToDelete = id;
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin menghapus asset ini?",
    icon: "warning",
    buttons: {
      cancel: {
        text: "Tidak",
        value: false,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Ya",
        value: true,
        visible: true,
        className: "",
        closeModal: true
      }
    },
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      deleteAsset();
    }
  });
}

function deleteAsset() {
  // Dapatkan ID aset yang akan dihapus
  const id = assetIdToDelete;

  // Kirim permintaan Ajax untuk menghapus aset berdasarkan ID
  $.ajax({
    url: '/KaryawanController/deleteAsset/' + id,
    type: 'POST',
    dataType: 'json',
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil dihapus",
          icon: "success",
        }).then(() => {
          // Redirect ke halaman awal setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal menghapus data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function cancelDelete() {
  assetIdToDelete = null;
  document.getElementById('confirmation-popup').style.display = 'none';
}

function showEditForm(key) {
  const editFormId = 'edit-form-' + key;
  const editButtonId = 'edit-button-' + key;

  const editForm = document.getElementById(editFormId);
  const editButton = document.getElementById(editButtonId);

  // Hide all other edit forms
  // Show or hide the clicked edit form
  if (editForm.style.display === 'block') {
    editForm.style.display = 'none';
    editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
  } else {
    // Hide all other edit forms
    const allEditForms = document.querySelectorAll("[id^='edit-form-']");
    allEditForms.forEach(form => {
      if (form.id !== editFormId) {
        form.style.display = 'none';
        const formKey = form.id.split('-')[2];
        const editButton = document.getElementById('edit-button-' + formKey);
        editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
      }
    });

    editForm.style.display = 'block';
    editButton.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
  }

  // Hide the add form
  document.getElementById('add-form').style.display = 'none';
}

function showAddForm() {
  const addForm = document.getElementById('add-form');

  // Hide all edit forms
  const allEditForms = document.querySelectorAll("[id^='edit-form-']");
  allEditForms.forEach(form => {
    form.style.display = 'none';
  });

  // Show or hide the add form
  if (addForm.style.display === 'block') {
    addForm.style.display = 'none';
  } else {
    addForm.style.display = 'block';
  }
}

function cancelEdit(key) {
  const editFormId = 'edit-form-' + key;
  const editButtonId = 'edit-button-' + key;

  const editForm = document.getElementById(editFormId);
  const editButton = document.getElementById(editButtonId);

  editForm.style.display = 'none';
  editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
}

function cancelAdd() {
  document.getElementById('add-form').style.display = 'none';
}

//js untuk peminjaman

$(document).ready(function() {
  // Menangani klik pada button update menggunakan event delegation
  $(document).on('click', '.button-peminjaman', function(e) {
    e.preventDefault(); // Mencegah perilaku default dari button

    // Mendapatkan ID dari button yang diklik
    const id = $(this).attr('onclick').match(/\d+/)[0];

    // Menampilkan konfirmasi SweetAlert
    update_peminjaman(id);
  });
});

function update_peminjaman(id) {
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin mengubah data ini?",
    icon: "warning",
    buttons: {
      cancel: "Batal",
      confirm: "Ya"
    },
    dangerMode: true,
  }).then((confirmed) => {
    if (confirmed) {
      updatePeminjaman(id);
    }
  });
}

function updatePeminjaman(id) {
  const nama_peminjam = $('#nama_peminjam-' + id).val();
  const nama_barang = $('#nama_barang-' + id).val();
  const tanggal = $('#tanggal-' + id).val();
  const nama_penanggung_jawab = $('#nama_penanggung_jawab-' + id).val();

  $.ajax({
    url: '/KaryawanController/updatePeminjaman/' + id,
    type: 'POST',
    dataType: 'json',
    data: {
      nama_peminjam: nama_peminjam,
      nama_barang: nama_barang,
      tanggal: tanggal,
      nama_penanggung_jawab: nama_penanggung_jawab
    },
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil diubah",
          icon: "success",
        }).then(() => {
          // Redirect ke halaman awal setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal mengubah data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function showHapus(id) {
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin menghapus data ini?",
    icon: "warning",
    buttons: {
      cancel: {
        text: "Tidak",
        value: false,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Ya",
        value: true,
        visible: true,
        className: "",
        closeModal: true
      }
    },
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      deletePeminjaman(id);
    }
  });
}

function deletePeminjaman(id) {
  // Kirim permintaan Ajax untuk menghapus aset berdasarkan ID
  $.ajax({
    url: '/KaryawanController/deletePeminjaman/' + id,
    type: 'POST',
    dataType: 'json',
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil dihapus",
          icon: "success",
        }).then(() => {
          // Redirect ke halaman awal setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal menghapus data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function showEditPeminjam(key) {
  const editFormId = 'edit-peminjam-' + key;
  const editButtonId = 'edit-pinjam-' + key;

  const editForm = document.getElementById(editFormId);
  const editButton = document.getElementById(editButtonId);

  // Show or hide the clicked edit form
  if (editForm.style.display === 'block') {
    editForm.style.display = 'none';
    editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
  } else {
    // Hide all other edit forms
    const allEditForms = document.querySelectorAll("[id^='edit-peminjam-']");
    allEditForms.forEach(form => {
      if (form.id !== editFormId) {
        form.style.display = 'none';
        const formKey = form.id.split('-')[2];
        const editButton = document.getElementById('edit-pinjam-' + formKey);
        editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
      }
    });

    editForm.style.display = 'block';
    editButton.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
  }

  // Hide the add form
  document.getElementById('tambahForm').style.display = 'none';
}

function showAddPeminjam() {
  const addForm = document.getElementById('tambahForm');

  // Hide all edit forms
  const allEditForms = document.querySelectorAll("[id^='edit-peminjam-']");
  allEditForms.forEach(form => {
    form.style.display = 'none';
  });

  // Show or hide the add form
  if (addForm.style.display === 'block') {
    addForm.style.display = 'none';
  } else {
    addForm.style.display = 'block';
  }
}

function hideUpdateForm(key) {
  const editFormId = 'edit-peminjam-' + key;
  const editButtonId = 'edit-pinjam' + key;

  const editForm = document.getElementById(editFormId);
  const editButton = document.getElementById(editButtonId);

  editForm.style.display = 'none';
  editButton.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
}

function hideTambahForm() {
  document.getElementById('tambahForm').style.display = 'none';
}

//js untuk asset dan lokasi

$(document).ready(function() {
  // Menangani klik pada button update menggunakan event delegation
  $(document).on('click', '.button-tracking', function(e) {
    e.preventDefault(); // Mencegah perilaku default dari button

    // Mendapatkan ID dari button yang diklik
    const id = $(this).data('id');

    // Menampilkan konfirmasi SweetAlert
    update_tracking(id);
  });
});

function update_tracking(id) {
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin mengubah data ini?",
    icon: "warning",
    buttons: {
      cancel: "Batal",
      confirm: "Ya"
    },
    dangerMode: true,
  }).then((confirmed) => {
    if (confirmed) {
      updateTracking(id);
    }
  });
}

function updateTracking(id) {
  const nama = $('#nama-' + id).val();
  const keadaan = $('#keadaan-' + id).val();
  const tanggal = $('#tanggal-' + id).val();
  const lokasi = $('#lokasi-' + id).val();
  const status = $('#status-' + id).val(); // Mendapatkan nilai dari input status

  $.ajax({
    url: '/KaryawanController/updateTracking/' + id,
    type: 'POST',
    dataType: 'json',
    data: {
      nama: nama,
      keadaan: keadaan,
      tanggal: tanggal,
      lokasi: lokasi,
      status: status
    },
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil diubah",
          icon: "success",
        }).then(() => {
          // Redirect ke halaman awal setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal mengubah data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function hapusTracking(id) {
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin menghapus data ini?",
    icon: "warning",
    buttons: {
      cancel: {
        text: "Tidak",
        value: false,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Ya",
        value: true,
        visible: true,
        className: "",
        closeModal: true
      }
    },
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      deleteTracking(id);
    }
  });
}

function deleteTracking(id) {
  // Kirim permintaan Ajax untuk menghapus aset berdasarkan ID
  $.ajax({
    url: '/KaryawanController/deleteTracking/' + id,
    type: 'POST',
    dataType: 'json',
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil dihapus",
          icon: "success",
        }).then(() => {
          // Redirect ke halaman awal setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal menghapus data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function editTracking(key) {
  const editFormId = 'edit-tracking-' + key;
  const editButtonId = 'edit-lokasi-' + key;

  const editForm = document.getElementById(editFormId);
  const editButton = document.getElementById(editButtonId);

  // Show or hide the clicked edit form
  if (editForm.style.display === 'block') {
    editForm.style.display = 'none';
    editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
  } else {
    // Hide all other edit forms
    const allEditForms = document.querySelectorAll("[id^='edit-tracking-']");
    allEditForms.forEach(form => {
      if (form.id !== editFormId) {
        form.style.display = 'none';
        const formKey = form.id.split('-')[2];
        const editButton = document.getElementById('edit-lokasi-' + formKey);
        editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
      }
    });

    editForm.style.display = 'block';
    editButton.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
  }

  // Hide the add form
  document.getElementById('tambahTracking').style.display = 'none';
}

function showTracking() {
  const addForm = document.getElementById('tambahTracking');

  // Hide all edit forms
  const allEditForms = document.querySelectorAll("[id^='edit-tracking-']");
  allEditForms.forEach(form => {
    form.style.display = 'none';
  });

  // Show or hide the add form
  if (addForm.style.display === 'block') {
    addForm.style.display = 'none';
  } else {
    addForm.style.display = 'block';
  }
}

function cancelEditTracking(key) {
  const editFormId = 'edit-tracking-' + key;
  const editButtonId = 'edit-lokasi' + key;

  const editForm = document.getElementById(editFormId);
  const editButton = document.getElementById(editButtonId);

  editForm.style.display = 'none';
  editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
}

function cancelLokasi() {
  document.getElementById('tambahTracking').style.display = 'none';
}

//dalete untuk tabel pengaduan
function hapusPengaduan(pengaduan) {
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin menghapus data ini?",
    icon: "warning",
    buttons: {
      cancel: {
        text: "Tidak",
        value: false,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Ya",
        value: true,
        visible: true,
        className: "",
        closeModal: true
      }
    },
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      deletePengaduan(pengaduan);
    }
  });
}

function deletePengaduan(pengaduan) {
  $.ajax({
    url: '/KaryawanController/deletePengaduan/' + pengaduan,
    type: 'POST',
    dataType: 'json',
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil dihapus",
          icon: "success",
        }).then(() => {
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal menghapus data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}
function hapusInvestasi(id) {
  swal({
      title: "Konfirmasi",
      text: "Anda yakin ingin menghapus data ini?",
      icon: "warning",
      buttons: {
          cancel: {
              text: "Tidak",
              value: false,
              visible: true,
              className: "",
              closeModal: true,
          },
          confirm: {
              text: "Ya",
              value: true,
              visible: true,
              className: "",
              closeModal: true
          }
      },
      dangerMode: true,
  }).then((willDelete) => {
      if (willDelete) {
          window.location.href = '/investasi/delete/' + id;
      }
  });
}

//js untuk roi
$(document).ready(function() {
  // Menangani klik pada button update menggunakan event delegation
  $(document).on('click', '.button-update', function(e) {
    e.preventDefault(); // Mencegah perilaku default dari button

    // Mendapatkan ID dari button yang diklik
    const id = $(this).parents('div[id^="edit-roi-"]').attr('id').replace('edit-roi-', '');

    // Menampilkan konfirmasi SweetAlert
    confirmUpdate(id);
  });
});

function confirmUpdate(nama_investasi) {
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin mengubah data ini?",
    icon: "warning",
    buttons: {
      cancel: "Batal",
      confirm: "Ya"
    },
    dangerMode: true,
  }).then((confirmed) => {
    if (confirmed) {
      updateInvestasi(nama_investasi);
    }
  });
}

function updateInvestasi(nama_investasi) {
  const form = $('#update-roi-' + nama_investasi);
  const nama_investasi_input = form.find('[name="nama_investasi"]').val();
  const tanggal = form.find('[name="tanggal"]').val();
  const tahun = form.find('[name="tahun"]').val();
  const keuntungan = form.find('[name="keuntungan"]').val();
  const biaya = form.find('[name="biaya"]').val();

  $.ajax({
    url: '/KaryawanController/updateInvestasi/' + encodeURIComponent(nama_investasi),
    type: 'POST',
    dataType: 'json',
    data: {
      nama_investasi: nama_investasi_input,
      tanggal: tanggal,
      tahun: tahun,
      keuntungan: keuntungan,
      biaya: biaya
    },
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil diubah",
          icon: "success",
        }).then(() => {
          // Refresh halaman setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal mengubah data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function hapusRoi(nama_investasi) {
  investasiIdToDelete = nama_investasi;
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin menghapus asset ini?",
    icon: "warning",
    buttons: {
      cancel: {
        text: "Tidak",
        value: false,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Ya",
        value: true,
        visible: true,
        className: "",
        closeModal: true
      }
    },
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      deleteInvestasi(nama_investasi); // Mengirimkan nama_investasi sebagai argumen
    }
  });
}

function deleteInvestasi(nama_investasi) {
  // Kirim permintaan Ajax untuk menghapus aset berdasarkan nama_investasi
  $.ajax({
    url: '/KaryawanController/deleteInvestasi/' + encodeURIComponent(nama_investasi),
    type: 'POST',
    dataType: 'json',
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil dihapus",
          icon: "success",
        }).then(() => {
          // Redirect ke halaman awal setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal menghapus data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function cancelDelete() {
  assetIdToDelete = null;
  document.getElementById('confirmation-popup').style.display = 'none';
}

function showEditRoi(nama_investasi) {
  const editFormId = 'edit-roi-' + nama_investasi;
  const editButtonId = 'edit-buttonRoi-' + nama_investasi;

  const editForm = document.getElementById(editFormId);
  const editButton = document.getElementById(editButtonId);

  // Hide all other edit forms
  // Show or hide the clicked edit form
  if (editForm.style.display === 'block') {
    editForm.style.display = 'none';
    editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
  } else {
    // Hide all other edit forms
    const allEditForms = document.querySelectorAll("[id^='edit-roi-']");
    allEditForms.forEach(form => {
      if (form.id !== editFormId) {
        form.style.display = 'none';
        const formKey = form.id.split('-')[2];
        const editButton = document.getElementById('edit-buttonRoi-' + formKey);
        editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
      }
    });

    editForm.style.display = 'block';
    editButton.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
  }

  // Hide the add form
  document.getElementById('add-roi').style.display = 'none';
}

function showAddRoi() {
  const addForm = document.getElementById('add-roi');

  // Hide all edit forms
  const allEditForms = document.querySelectorAll("[id^='edit-roi-']");
  allEditForms.forEach(form => {
    form.style.display = 'none';
  });

  // Show or hide the add form
  if (addForm.style.display === 'block') {
    addForm.style.display = 'none';
  } else {
    addForm.style.display = 'block';
  }
}

function cancelEditRoi(nama_investasi) {
  const editFormId = 'edit-roi-' + nama_investasi;
  const editButtonId = 'edit-buttonRoi-' + nama_investasi;

  const editForm = document.getElementById(editFormId);
  const editButton = document.getElementById(editButtonId);

  editForm.style.display = 'none';
  editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
}

function cancelTambahRoi() {
  document.getElementById('add-roi').style.display = 'none';
}

//js images
function deleteImage(imageId) {
  if (confirm("Apakah Anda yakin ingin menghapus gambar ini?")) {
      // Lakukan permintaan AJAX untuk menghapus gambar
      $.ajax({
          url: '/KaryawanController/deleteImage/' + imageId,
          type: 'POST',
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  // Hapus elemen gambar dari tampilan
                  $('#image-' + imageId).remove();
              } else {
                  alert("Gagal menghapus gambar");
              }
          },
          error: function(xhr, textStatus, errorThrown) {
              alert("Terjadi kesalahan saat mengirim permintaan: " + textStatus);
          }
      });
  }
}

//js user
$(document).ready(function() {
  // Menangani klik pada button update menggunakan event delegation
  $(document).on('click', '.button-user', function(e) {
    e.preventDefault(); // Mencegah perilaku default dari button

    // Mendapatkan ID dari button yang diklik
    const id = $(this).attr('id').split('-')[1];

    // Menampilkan konfirmasi SweetAlert
    updateUser(id);
  });
});

function updateUser(id) {
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin mengubah data ini?",
    icon: "warning",
    buttons: {
      cancel: "Batal",
      confirm: "Ya"
    },
    dangerMode: true,
  }).then((confirmed) => {
    if (confirmed) {
      updateAsset(id);
    }
  });
}

function updateAsset(id) {
  const username = $('#username-' + id).val();
  const password = $('#password-' + id).val();

  $.ajax({
    url: '/KaryawanController/updateUser/' + id,
    type: 'POST',
    dataType: 'json',
    data: {
      username: username,
      password: password
    },
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil diubah",
          icon: "success",
        }).then(() => {
          // Redirect ke halaman awal setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal mengubah data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function showConfirmationUser(id) {
  userIdToDelete = id;
  swal({
    title: "Konfirmasi",
    text: "Anda yakin ingin menghapus user ini?",
    icon: "warning",
    buttons: {
      cancel: {
        text: "Tidak",
        value: false,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Ya",
        value: true,
        visible: true,
        className: "",
        closeModal: true
      }
    },
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      deleteUser();
    }
  });
}

function deleteUser() {
  // Dapatkan ID user yang akan dihapus
  const id = userIdToDelete;

  // Kirim permintaan Ajax untuk menghapus user berdasarkan ID
  $.ajax({
    url: '/KaryawanController/deleteUser/' + id,
    type: 'POST',
    dataType: 'json',
    success: function(response) {
      if (response.success) {
        swal({
          title: "Sukses",
          text: "Data berhasil dihapus",
          icon: "success",
        }).then(() => {
          // Redirect ke halaman awal setelah notifikasi ditutup
          window.location.href = '/karyawan';
        });
      } else {
        swal("Error", "Gagal menghapus data", "error");
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      swal("Error", "Terjadi kesalahan saat mengirim permintaan", "error");
    }
  });
}

function cancelDeleteUser() {
  userIdToDelete = null;
}

function showEditUser(key) {
  const editFormId = 'edit-user-' + key;
  const editButtonId = 'edit-userAkun-' + key;

  const editForm = document.getElementById(editFormId);
  const editButton = document.getElementById(editButtonId);

  // Hide all other edit forms
  // Show or hide the clicked edit form
  if (editForm.style.display === 'block') {
    editForm.style.display = 'none';
    editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
  } else {
    // Hide all other edit forms
    const allEditForms = document.querySelectorAll("[id^='edit-user-']");
    allEditForms.forEach(form => {
      if (form.id !== editFormId) {
        form.style.display = 'none';
        const formKey = form.id.split('-')[2];
        const editButton = document.getElementById('edit-userAkun-' + formKey);
        editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';
      }
    });

    editForm.style.display = 'block';
    editButton.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
  }

  // Hide the add form
  document.getElementById('add-user').style.display = 'none';
}

function showAddUser() {
  const addUserForm = document.getElementById('add-user');
  const addFormInputs = document.getElementById('add-user-form').getElementsByTagName('input');

  // Clear the input fields
  for (let i = 0; i < addFormInputs.length; i++) {
    addFormInputs[i].value = '';
  }

  // Show or hide the add form
  if (addUserForm.style.display === 'block') {
    addUserForm.style.display = 'none';
  } else {
    addUserForm.style.display = 'block';
  }
}

function cancelEditUser(key) {
  const editFormId = 'edit-user-' + key;

  const editForm = document.getElementById(editFormId);

  editForm.style.display = 'none';
}

function cancelAddUser() {
  document.getElementById('add-user').style.display = 'none';
}
