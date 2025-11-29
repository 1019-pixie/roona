<?php
require_once __DIR__ . '/../models/Kostum.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Transaksi.php';

class AdminController {
    private $pdo;
    private $kostum;
    private $userModel;
    private $transaksi;
    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->kostum = new Kostum($pdo);
        $this->userModel = new User($pdo);
        $this->transaksi = new Transaksi($pdo);
    }

    public function dashboard(){
        $countKostum = $this->pdo->query("SELECT COUNT(*) FROM kostum")->fetchColumn();
        $countUsers = $this->pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        include __DIR__ . '/../views/admin/dashboard.php';
    }

    public function listKostum(){
        $items = $this->kostum->all();
        include __DIR__ . '/../views/admin/kostum_list.php';
    }

    public function showKostumForm(){
        $id = intval($_GET['id'] ?? 0);
        $item = $id ? $this->kostum->find($id) : null;
        include __DIR__ . '/../views/admin/kostum_form.php';
    }

    public function saveKostum(){
        $id = intval($_POST['id'] ?? 0);
        $data = [
            'nama' => $_POST['nama'] ?? '',
            'kategori_id' => $_POST['kategori_id'] ?: null,
            'ukuran' => $_POST['ukuran'] ?? '',
            'stok' => intval($_POST['stok'] ?? 0),
            'harga_sewa' => floatval($_POST['harga_sewa'] ?? 0),
            'deskripsi' => $_POST['deskripsi'] ?? ''
        ];
        if($id){
            $this->kostum->update($id,$data);
        } else {
            $this->kostum->create($data);
        }
        header('Location: index.php?action=admin_kostum');
    }

    public function deleteKostum(){
        $id = intval($_GET['id'] ?? 0);
        $this->kostum->delete($id);
        header('Location: index.php?action=admin_kostum');
    }

    public function listUsers(){
        $users = $this->userModel->all();
        include __DIR__ . '/../views/admin/user_list.php';
    }

    public function listTransaksi(){
        $trans = $this->transaksi->all();
        include __DIR__ . '/../views/admin/transaksi_list.php';
    }

    public function markPaid(){
        $id = intval($_GET['id'] ?? 0);
        $this->transaksi->markPaid($id);
        header('Location: index.php?action=admin_transaksi');
    }
}
