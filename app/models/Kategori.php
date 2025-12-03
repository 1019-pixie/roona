<?php
class Kategori {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    // Read All
    public function all(){
        $stmt = $this->pdo->query("SELECT * FROM kategori_kostum ORDER BY nama ASC");
        return $stmt->fetchAll();
    }

    // Find One
    public function find($id){
        $stmt = $this->pdo->prepare("SELECT * FROM kategori_kostum WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch();
    }

    // Create
    public function create($nama){
        $stmt = $this->pdo->prepare("INSERT INTO kategori_kostum (nama) VALUES (:nama)");
        return $stmt->execute(['nama'=>$nama]);
    }

    // Update
    public function update($id, $nama){
        $stmt = $this->pdo->prepare("UPDATE kategori_kostum SET nama=:nama WHERE id=:id");
        return $stmt->execute(['id'=>$id, 'nama'=>$nama]);
    }

    // Delete
    public function delete($id){
        // Opsional: Cek dulu apakah ada kostum yang pakai kategori ini sebelum dihapus
        $stmt = $this->pdo->prepare("DELETE FROM kategori_kostum WHERE id=:id");
        return $stmt->execute(['id'=>$id]);
    }
}