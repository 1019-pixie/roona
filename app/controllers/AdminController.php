<?php
require_once __DIR__ . '/../models/Kostum.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Transaksi.php';
require_once __DIR__ . '/../models/Kategori.php';
class AdminController {
    private $pdo;
    private $kostum;
    private $userModel;
    private $transaksi;
    private $kategoriModel;
    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->kostum = new Kostum($pdo);
        $this->userModel = new User($pdo);
        $this->transaksi = new Transaksi($pdo);
        $this->kategoriModel = new Kategori($pdo);
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
        
        // 1. Siapkan data dasar dari form
        $data = [
            'nama' => $_POST['nama'] ?? '',
            'kategori_id' => $_POST['kategori_id'] ?: null,
            'ukuran' => $_POST['ukuran'] ?? '',
            'stok' => intval($_POST['stok'] ?? 0),
            'harga_sewa' => floatval($_POST['harga_sewa'] ?? 0),
            'deskripsi' => $_POST['deskripsi'] ?? '',
            'gambar' => null 
        ];

        // 2. Jika ini Edit, ambil gambar lama dulu sebagai default
        if($id){
            $oldItem = $this->kostum->find($id);
            $data['gambar'] = $oldItem['gambar'];
        }

        // 3. Proses Upload Gambar Baru (Jika ada yang diupload)
        if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0){
            $allowTypes = ['jpg','jpeg','png','webp'];
            $fileName = $_FILES['gambar']['name'];
            $fileTmp = $_FILES['gambar']['tmp_name'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if(in_array($ext, $allowTypes)){
                $newFileName = uniqid() . '.' . $ext; // Nama unik
                $dest = __DIR__ . '/../../public/assets/images/' . $newFileName;
                
                // Pindahkan file ke folder tujuan
                if(move_uploaded_file($fileTmp, $dest)){
                    $data['gambar'] = $newFileName; // Simpan nama baru
                    
                    // Hapus gambar lama agar tidak menuh-menuhin penyimpanan
                    if($id && !empty($oldItem['gambar']) && file_exists(__DIR__ . '/../../public/assets/images/' . $oldItem['gambar'])){
                        unlink(__DIR__ . '/../../public/assets/images/' . $oldItem['gambar']);
                    }
                }
            }
        }

        // 4. Simpan ke Database
        if($id){
            $this->kostum->update($id, $data);
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
    public function listKategori(){
        $items = $this->kategoriModel->all();
        include __DIR__ . '/../views/admin/kategori_list.php';
    }

    public function showKategoriForm(){
        $id = intval($_GET['id'] ?? 0);
        $item = $id ? $this->kategoriModel->find($id) : null;
        include __DIR__ . '/../views/admin/kategori_form.php';
    }
    public function saveKategori(){
        $id = intval($_POST['id'] ?? 0);
        $nama = $_POST['nama'] ?? '';
        
        if($id){
            $this->kategoriModel->update($id, $nama);
        } else {
            $this->kategoriModel->create($nama);
        }
        header('Location: index.php?action=admin_kategori');
    }
    public function deleteKategori(){
        $id = intval($_GET['id'] ?? 0);
        $this->kategoriModel->delete($id);
        header('Location: index.php?action=admin_kategori');
    }
}
