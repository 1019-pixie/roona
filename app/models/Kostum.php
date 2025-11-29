<?php
class Kostum {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    public function all(){
        $stmt = $this->pdo->query("SELECT k.*, c.nama as kategori FROM kostum k LEFT JOIN kategori_kostum c ON k.kategori_id=c.id ORDER BY k.created_at DESC");
        return $stmt->fetchAll();
    }

    public function find($id){
        $stmt = $this->pdo->prepare("SELECT k.*, c.nama as kategori FROM kostum k LEFT JOIN kategori_kostum c ON k.kategori_id=c.id WHERE k.id=:id");
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch();
    }

    public function create($data){
        $sql = "INSERT INTO kostum (nama,kategori_id,ukuran,stok,harga_sewa,deskripsi) VALUES (:nama,:kategori_id,:ukuran,:stok,:harga_sewa,:deskripsi)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data){
        $sql = "UPDATE kostum SET nama=:nama, kategori_id=:kategori_id, ukuran=:ukuran, stok=:stok, harga_sewa=:harga_sewa, deskripsi=:deskripsi WHERE id=:id";
        $data['id']=$id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM kostum WHERE id=:id");
        return $stmt->execute(['id'=>$id]);
    }

    public function reduceStock($id, $qty){
        $stmt = $this->pdo->prepare("UPDATE kostum SET stok = stok - :qty WHERE id=:id AND stok >= :qty");
        $stmt->execute(['qty'=>$qty,'id'=>$id]);
        return $stmt->rowCount()>0;
    }

    public function increaseStock($id, $qty){
        $stmt = $this->pdo->prepare("UPDATE kostum SET stok = stok + :qty WHERE id=:id");
        return $stmt->execute(['qty'=>$qty,'id'=>$id]);
    }
}
