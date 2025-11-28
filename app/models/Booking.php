<?php
class Booking {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    public function create($id_user, $tanggal){
        $stmt = $this->pdo->prepare("INSERT INTO booking (id_user,tanggal_booking,status) VALUES (:u,:t,'pending')");
        $stmt->execute(['u'=>$id_user,'t'=>$tanggal]);
        return $this->pdo->lastInsertId();
    }

    public function findByUser($id_user){
        $stmt = $this->pdo->prepare("SELECT b.*, t.total_bayar, t.status as status_bayar FROM booking b LEFT JOIN transaksi t ON b.id=t.id_booking WHERE b.id_user=:u ORDER BY b.created_at DESC");
        $stmt->execute(['u'=>$id_user]);
        return $stmt->fetchAll();
    }

    public function find($id){
        $stmt = $this->pdo->prepare("SELECT * FROM booking WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch();
    }
}
