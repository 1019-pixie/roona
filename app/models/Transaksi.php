<?php
class Transaksi {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    public function create($id_booking, $total){
        $stmt = $this->pdo->prepare("INSERT INTO transaksi (id_booking,total_bayar,status) VALUES (:b,:t,'unpaid')");
        return $stmt->execute(['b'=>$id_booking,'t'=>$total]);
    }

    public function findByBooking($id_booking){
        $stmt = $this->pdo->prepare("SELECT * FROM transaksi WHERE id_booking=:b");
        $stmt->execute(['b'=>$id_booking]);
        return $stmt->fetch();
    }

    public function all(){
        $stmt = $this->pdo->query("SELECT t.*, b.id_user, u.nama as penyewa FROM transaksi t JOIN booking b ON t.id_booking=b.id JOIN users u ON b.id_user=u.id ORDER BY t.created_at DESC");
        return $stmt->fetchAll();
    }

    public function markPaid($id){
        $stmt = $this->pdo->prepare("UPDATE transaksi SET status='paid', tanggal_bayar=NOW() WHERE id=:id");
        return $stmt->execute(['id'=>$id]);
    }
}
