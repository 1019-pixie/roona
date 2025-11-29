<?php
class Booking {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    public function create($user_id, $tanggal){
        $stmt = $this->pdo->prepare("INSERT INTO booking (user_id,tanggal_booking,status) VALUES (:u,:t,'pending')");
        $stmt->execute(['u'=>$user_id,'t'=>$tanggal]);
        return $this->pdo->lastInsertId();
    }

    public function findByUser($user_id){
        $stmt = $this->pdo->prepare("SELECT b.*, t.total_bayar, t.status as status_bayar FROM booking b LEFT JOIN transaksi t ON b.id=t.booking_id WHERE b.user_id=:u ORDER BY b.created_at DESC");
        $stmt->execute(['u'=>$user_id]);
        return $stmt->fetchAll();
    }

    public function find($id){
        $stmt = $this->pdo->prepare("SELECT * FROM booking WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch();
    }
}
