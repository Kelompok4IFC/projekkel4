<?php
namespace App\Controllers;

use App\Models\ModelsKaryawan;
use App\Models\AssetModel;
use App\Models\PeminjamanModel;
use App\Models\PengaduanModel;
use App\Models\TrackingModel;
use App\Models\InvestasiModel;
use App\Models\ImageModel;
use App\Models\UserModel;
use App\Models\LogAssetModel;
use App\Models\LogPeminjamanModel;
use App\Models\LogTrackingModel;
use CodeIgniter\API\ResponseTrait;

class KaryawanController extends BaseController
{
    public function index()
    {
        $user = new ModelsKaryawan();
        $assetModel = new AssetModel();
        $logAssetModel = new LogAssetModel();
        $peminjamanModel = new PeminjamanModel();
        $PengaduanModel = new PengaduanModel();
        $TrackingModel = new TrackingModel();
        $InvestasiModel = new InvestasiModel();
        $ImageModel = new ImageModel();
        $userModel = new UserModel();
        $logPeminjamanModel = new LogPeminjamanModel();
        $logTrackingModel = new LogTrackingModel();

        $data['karyawan'] = $user->findAll();
        $data['assets'] = $assetModel->findAll();
        $data['log_asset'] = $logAssetModel->findAll();
        $data['peminjaman'] = $peminjamanModel->findAll();
        $data['pengaduan'] = $PengaduanModel->findAll();
        $data['tracking'] = $TrackingModel->findAll();
        $data['investasi'] = $InvestasiModel->findAll();
        $data['images'] = $ImageModel->findAll();
        $data['users'] = $userModel->findAll();
        $data['log_peminjaman'] = $logPeminjamanModel->findAll();
        $data['log_tracking'] = $logTrackingModel->findAll();

        return view('karyawan', $data);
    }

    public function saveAsset()
    {
        $assetModel = new AssetModel();

        // Ambil data dari form
        $nama = $this->request->getPost('nama');
        $harga_beli = $this->request->getPost('harga_beli');
        $jumlah = $this->request->getPost('jumlah');
        $kondisi_barang = $this->request->getPost('kondisi_barang');

        // Simpan data asset ke dalam database
        $assetModel->insert([
            'nama' => $nama,
            'harga_beli' => $harga_beli,
            'jumlah' => $jumlah,
            'kondisi_barang' => $kondisi_barang
        ]);

        return redirect()->to('/karyawan');
    }

    public function editAsset($id)
    {
        $assetModel = new AssetModel();

        // Ambil data asset berdasarkan ID
        $data['asset'] = $assetModel->find($id);

        return view('karyawan', $data);
    }

    public function updateAsset($id)
    {
        $assetModel = new AssetModel();
    
        // Ambil data dari form
        $nama = $this->request->getPost('nama');
        $harga_beli = $this->request->getPost('harga_beli');
        $jumlah = $this->request->getPost('jumlah');
        $kondisi_barang = $this->request->getPost('kondisi_barang');
    
        // Perbarui data asset berdasarkan ID
        $updated = $assetModel->update($id, [
            'nama' => $nama,
            'harga_beli' => $harga_beli,
            'jumlah' => $jumlah,
            'kondisi_barang' => $kondisi_barang
        ]);
    
        if ($updated) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }

    }       

    public function deleteAsset($id)
    {
    $assetModel = new AssetModel();
    
    // Hapus data asset berdasarkan ID
    $deleted = $assetModel->delete($id);
    
    if ($deleted) {
        return $this->response->setJSON(['success' => true]);
    } else {
        return $this->response->setJSON(['success' => false]);
    }
    }

    public function savePeminjaman()
    {
        $peminjamanModel = new PeminjamanModel();

        // Ambil data dari form
        $namaPeminjam = $this->request->getPost('nama_peminjam');
        $namaBarang = $this->request->getPost('nama_barang');
        $tanggal = $this->request->getPost('tanggal');
        $namaPenanggungJawab = $this->request->getPost('nama_penanggung_jawab');

        // Simpan data peminjaman ke dalam database
        $peminjamanModel->insert([
            'nama_peminjam' => $namaPeminjam,
            'nama_barang' => $namaBarang,
            'tanggal' => $tanggal,
            'nama_penanggung_jawab' => $namaPenanggungJawab
        ]);

        return redirect()->to('/karyawan');
    }

    public function editPeminjaman($id)
    {
        $peminjamanModel = new PeminjamanModel();
    
        // Ambil data peminjaman berdasarkan ID
        $data['peminjaman'] = $peminjamanModel->find($id);
    
        return view('karyawan', $data);
    }    

    public function updatePeminjaman($id)
    {
      $peminjamanModel = new PeminjamanModel();
    
      // Ambil data dari form
      $namaPeminjam = $this->request->getPost('nama_peminjam');
      $namaBarang = $this->request->getPost('nama_barang');
      $tanggal = $this->request->getPost('tanggal');
      $namaPenanggungJawab = $this->request->getPost('nama_penanggung_jawab');
    
      // Perbarui data peminjaman berdasarkan ID
      $updated = $peminjamanModel->update($id, [
        'nama_peminjam' => $namaPeminjam,
        'nama_barang' => $namaBarang,
        'tanggal' => $tanggal,
        'nama_penanggung_jawab' => $namaPenanggungJawab
      ]);
    
      if ($updated) {
        return $this->response->setJSON(['success' => true]);
      } else {
        return $this->response->setJSON(['success' => false]);
      }
    }
    
    public function deletePeminjaman($id)
    {
    $peminjamanModel = new PeminjamanModel();
    
    // Hapus data asset berdasarkan ID
    $deleted = $peminjamanModel->delete($id);
    
    if ($deleted) {
        return $this->response->setJSON(['success' => true]);
    } else {
        return $this->response->setJSON(['success' => false]);
    }
    }

    public function savePengaduan()
    {
        $PengaduanModel = new PengaduanModel();
    
        // Ambil data dari form
        $pengaduan = $this->request->getPost('pengaduan');
        $tanggal = $this->request->getPost('tanggal');
        $waktu = $this->request->getPost('waktu');
        $ruangan = $this->request->getPost('ruangan');
        $namaUser = $this->request->getPost('nama_user');
    
        // Cek apakah pengaduan sudah ada
        $existingPengaduan = $PengaduanModel->where('pengaduan', $pengaduan)->first();
        if ($existingPengaduan) {
            // Pengaduan sudah ada, lakukan penanganan sesuai kebutuhan
            // Misalnya, tampilkan pesan error atau redirect kembali ke halaman input pengaduan
            return redirect()->back()->with('error', 'Pengaduan sudah ada');
        }
    
        // Simpan data pengaduan ke dalam database
        $PengaduanModel->insert([
            'pengaduan' => $pengaduan,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'ruangan' => $ruangan,
            'nama_user' => $namaUser
        ]);
    
        return redirect()->to('/pengaduan');
    }

    public function deletePengaduan($pengaduan)
    {
        $PengaduanModel = new PengaduanModel();
    
        // Hapus data pengaduan berdasarkan pengaduan
        $deleted = $PengaduanModel->where('pengaduan', $pengaduan)->delete();
    
        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function save() {
        $tableModel = new TrackingModel();
        $data = array(
          'nama' => $this->request->getPost('nama'),
          'keadaan' => $this->request->getPost('keadaan'),
          'tanggal' => $this->request->getPost('tanggal'),
          'lokasi' => $this->request->getPost('lokasi')
        );
        $tableModel->insert($data);
        return redirect()->to('karyawan');
      }
      public function edit($id)
      {
          $tableModel = new TrackingModel();
        
          // Ambil data tracking berdasarkan ID
          $data['status'] = $tableModel->find($id);
      
          return view('karyawan', $data);
      }
      
      public function updateTracking($id)
      {
          $trackingModel = new TrackingModel();
      
          $nama = $this->request->getPost('nama');
          $keadaan = $this->request->getPost('keadaan');
          $tanggal = $this->request->getPost('tanggal');
          $lokasi = $this->request->getPost('lokasi');
        
          // Perbarui data tracking berdasarkan ID
          $updated = $trackingModel->update($id, [
            'nama' => $nama,
            'keadaan' => $keadaan,
            'tanggal' => $tanggal,
            'lokasi' => $lokasi
          ]);
        
          if ($updated) {
            return $this->response->setJSON(['success' => true]);
          } else {
            return $this->response->setJSON(['success' => false]);
          }
      }                 
      
    public function deleteTracking($id)
    {
        $trackingModel = new TrackingModel();

        // Hapus data peminjaman berdasarkan ID
        $trackingModel->delete($id);

        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
    
    public function simpanInvestasi()
    {
        // Ambil data dari form
        $data = [
            'nama_investasi' => $this->request->getPost('nama_investasi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'tahun' => $this->request->getPost('tahun'),
            'keuntungan' => $this->request->getPost('keuntungan'),
            'biaya' => $this->request->getPost('biaya'),
        ];
    
        // Konversi keuntungan dan biaya menjadi format angka desimal
        $keuntungan = isset($data['keuntungan']) ? str_replace(',', '', $data['keuntungan']) : '0';
        $keuntungan = str_replace('.', '', $keuntungan);
        $keuntungan = str_replace(',', '.', $keuntungan);
    
        $biaya = isset($data['biaya']) ? str_replace(',', '', $data['biaya']) : '0';
        $biaya = str_replace('.', '', $biaya);
        $biaya = str_replace(',', '.', $biaya);
    
        // Hitung ROI
        $roi = '0';
        if ($biaya != '0') {
            $roi = bcsub($keuntungan, $biaya);
        }
    
        // Simpan data ke database
        $model = new InvestasiModel();
        $model->save([
            'nama_investasi' => isset($data['nama_investasi']) ? $data['nama_investasi'] : '',
            'tanggal' => isset($data['tanggal']) ? $data['tanggal'] : '',
            'tahun' => isset($data['tahun']) ? $data['tahun'] : '',
            'keuntungan' => isset($data['keuntungan']) ? $keuntungan : '',
            'biaya' => isset($data['biaya']) ? $biaya : '',
            'roi' => $roi
        ]);
    
        // Redirect ke halaman awal setelah data disimpan
        return redirect()->to('/karyawan');
    }       
    
    public function updateInvestasi($nama_investasi)
    {
        // Get input data
        $nama_investasi_input = trim($this->request->getPost('nama_investasi')); // Menghapus spasi di awal dan akhir
        $tanggal = $this->request->getPost('tanggal');
        $tahun = $this->request->getPost('tahun');
        $keuntungan = $this->request->getPost('keuntungan');
        $biaya = $this->request->getPost('biaya');
    
        // Prepare data for update
        $data = array(
            'nama_investasi' => $nama_investasi_input,
            'tanggal' => $tanggal,
            'tahun' => $tahun,
            'keuntungan' => $keuntungan,
            'biaya' => $biaya
        );
    
        // Konversi keuntungan dan biaya menjadi format angka desimal
        $keuntungan_decimal = isset($data['keuntungan']) ? str_replace(',', '', $data['keuntungan']) : '0';
        $keuntungan_decimal = str_replace('.', '', $keuntungan_decimal);
        $keuntungan_decimal = str_replace(',', '.', $keuntungan_decimal);
    
        $biaya_decimal = isset($data['biaya']) ? str_replace(',', '', $data['biaya']) : '0';
        $biaya_decimal = str_replace('.', '', $biaya_decimal);
        $biaya_decimal = str_replace(',', '.', $biaya_decimal);
    
        // Hitung ROI
        $roi = '0';
        if ($biaya_decimal != '0') {
            $roi = bcsub($keuntungan_decimal, $biaya_decimal);
        }
    
        // Update data ke database
        $investasiModel = new InvestasiModel();
        $existingData = $investasiModel->where('nama_investasi', $nama_investasi)->first();
    
        if ($existingData) {
            // Data sudah pernah diubah sebelumnya
            $updatedData = array(
                'nama_investasi' => $existingData['nama_investasi'],
                'tanggal' => $existingData['tanggal'],
                'tahun' => $existingData['tahun'],
                'keuntungan' => $existingData['keuntungan'],
                'biaya' => $existingData['biaya'],
                'roi' => $existingData['roi']
            );
    
            if ($nama_investasi_input !== null && $nama_investasi_input !== '') {
                $updatedData['nama_investasi'] = $nama_investasi_input;
            }
    
            if ($tanggal !== null) {
                $updatedData['tanggal'] = $tanggal;
            }
    
            if ($tahun !== null) {
                $updatedData['tahun'] = $tahun;
            }
    
            if ($keuntungan_decimal !== '0') {
                $updatedData['keuntungan'] = $keuntungan_decimal;
            }
    
            if ($biaya_decimal !== '0') {
                $updatedData['biaya'] = $biaya_decimal;
            }
    
            // Hitung ROI
            $updatedData['roi'] = bcsub($updatedData['keuntungan'], $updatedData['biaya']);
    
            // Update data ke database
            $investasiModel->where('nama_investasi', $nama_investasi)->set($updatedData)->update();
        } else {
            // Data belum pernah diubah sebelumnya
            $data['roi'] = $roi;
    
            // Update data ke database
            $investasiModel->insert($data);
        }
    
        // Prepare response
        $response = array('success' => true);
    
        // Return JSON response
        return $this->response->setJSON($response);
    }          
                    
    public function deleteInvestasi($nama_investasi)
    {
        $model = new InvestasiModel();
        $deleted = $model->where('nama_investasi', $nama_investasi)->delete();

        if ($deleted) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }         
    
    public function upload()
    {
        $image = $this->request->getFile('image');

        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $newName);

            $imageModel = new ImageModel();
            $imageModel->insert(['filename' => $newName]);

            session()->setFlashdata('success', 'Gambar berhasil diunggah.');
        } else {
            session()->setFlashdata('error', 'Terjadi kesalahan saat mengunggah gambar.');
        }

        return redirect()->to('/karyawan');
    }

    public function deleteImage($imageId)
    {
        $imageModel = new ImageModel();

        // Cari data gambar berdasarkan ID
        $image = $imageModel->find($imageId);

        if (!$image) {
            // Jika gambar tidak ditemukan, kirimkan respon error
            return $this->response->setJSON(['success' => false]);
        }

        // Hapus file gambar dari direktori uploads
        $filePath = WRITEPATH . 'uploads/' . $image['filename'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus data gambar dari database
        $imageModel->delete($imageId);

        // Kirimkan respon berhasil
        return $this->response->setJSON(['success' => true]);
    }

    public function saveUser()
    {
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password')
        ];

        $userModel->insert($data);

        return redirect()->to('/KaryawanController');
    }

    public function editUser($id)
    {
        $userModel = new UserModel();
    
        // Ambil data user berdasarkan ID
        $data['user'] = $userModel->find($id);
    
        // Ambil semua data user
        $data['users'] = $userModel->findAll();
    
        return view('karyawan', $data);
    }    

    public function updateUser($id)
    {
        $userModel = new UserModel();

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Perbarui data user berdasarkan ID
        $updated = $userModel->update($id, [
            'username' => $username,
            'password' => md5($password) // Menggunakan md5 untuk menyimpan password
        ]);

        if ($updated) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();

        // Hapus data user berdasarkan ID
        $deleted = $userModel->delete($id);

        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
  
    public function logout(){
        session()->destroy();
        return redirect()->to('login');
    }
}