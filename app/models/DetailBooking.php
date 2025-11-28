<?php
class DetailBooking {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    public function create($id_booking, $id_kostum, $qty, $subtotal){
        $stmt = $this->pdo->prepare("INSERT INTO detail_booking (id_booking,id_kostum,qty,subtotal) VALUES (:b,:k,:q,:s)");
        return $stmt->execute(['b'=>$id_booking,'k'=>$id_kostum,'q'=>$qty,'s'=>$subtotal]);
    }

    public function findByBooking($id_booking){
        $stmt = $this->pdo->prepare("SELECT db.*, k.nama as kostum_nama FROM detail_booking db JOIN kostum k ON db.id_kostum=k.id WHERE id_booking=:b");
        $stmt->execute(['b'=>$id_booking]);
        return $stmt->fetchAll();
    }
}
