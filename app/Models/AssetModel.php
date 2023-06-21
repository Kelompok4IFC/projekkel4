<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;
use DateTimeZone;

class AssetModel extends Model
{
    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'harga_beli', 'jumlah', 'kondisi_barang'];

    public function insert($data = null, bool $returnID = true)
    {
        // Menyimpan data baru
        $result = parent::insert($data, $returnID);

        if ($result && is_array($data)) {
            // Menambahkan entri log untuk data baru
            $logData = [
                'action' => 'insert',
                'data' => json_encode($data),
                'user' => $this->getCurrentUser(),
                'timestamp' => $this->getCurrentTimestamp()
            ];
            $this->insertLog($logData);
        }

        return $result;
    }

    public function update($id = null, $data = null): bool
    {
        // Memperbarui data
        $result = parent::update($id, $data);

        if ($result && is_array($data)) {
            // Menambahkan entri log untuk data yang diperbarui
            $logData = [
                'id' => $id,
                'action' => 'update',
                'data' => json_encode($data),
                'user' => $this->getCurrentUser(),
                'timestamp' => $this->getCurrentTimestamp()
            ];
            $this->insertLog($logData);
        }

        return $result;
    }

    protected function insertLog($logData)
    {
        // Menyimpan entri log ke tabel log_asset (nama tabel log bisa disesuaikan)
        $db = \Config\Database::connect();
        $db->table('log_asset')->insert($logData);
    }

    protected function getCurrentUser()
    {
        $username = session()->get('karyawan_username');

        $modelKaryawan = new ModelsKaryawan();
        $currentUser = $modelKaryawan->where('karyawan_username', $username)->first();

        if ($currentUser) {
            return $currentUser['karyawan_username'];
        }

        return null;
    }

    protected function getCurrentTimestamp()
    {
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        return $dateTime->format('Y-m-d H:i:s');
    }
}
