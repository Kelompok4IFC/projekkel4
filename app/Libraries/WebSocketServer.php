<?php

namespace App\Libraries;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Tambahkan koneksi baru ke daftar klien yang terhubung
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Iterasi setiap koneksi klien dan kirim pesan notifikasi
        foreach ($this->clients as $client) {
            $client->send('Ada pengaduan baru'); // Ganti dengan pesan notifikasi yang sesuai
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Hapus koneksi yang ditutup dari daftar klien yang terhubung
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // Tangani kesalahan yang terjadi pada koneksi
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}