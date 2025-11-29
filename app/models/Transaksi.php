<?php
class Transaksi {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    public function create($booking_id, $total){
        $stmt = $this->pdo->prepare("INSERT INTO transaksi (booking_id,total_bayar,status) VALUES (:b,:t,'unpaid')");
        return $stmt->execute(['b'=>$booking_id,'t'=>$total]);
    }

    public function findByBooking($booking_id){
        $stmt = $this->pdo->prepare("SELECT * FROM transaksi WHERE booking_id=:b");
        $stmt->execute(['b'=>$booking_id]);
        return $stmt->fetch();
    }

    public function all(){
        $stmt = $this->pdo->query("SELECT t.*, b.user_id, u.nama as penyewa FROM transaksi t JOIN booking b ON t.booking_id=b.id JOIN users u ON b.user_id=u.id ORDER BY t.created_at DESC");
        return $stmt->fetchAll();
    }

    public function markPaid($id){
        $stmt = $this->pdo->prepare("UPDATE transaksi SET status='paid', tanggal_bayar=NOW() WHERE id=:id");
        return $stmt->execute(['id'=>$id]);
    }
}
