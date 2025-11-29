<?php
class DetailBooking {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    public function create($booking_id, $kostum_id, $qty, $subtotal){
        $stmt = $this->pdo->prepare("INSERT INTO detail_booking (booking_id,kostum_id,qty,subtotal) VALUES (:b,:k,:q,:s)");
        return $stmt->execute(['b'=>$booking_id,'k'=>$kostum_id,'q'=>$qty,'s'=>$subtotal]);
    }

    public function findByBooking($booking_id){
        $stmt = $this->pdo->prepare("SELECT db.*, k.nama as kostum_nama FROM detail_booking db JOIN kostum k ON db.kostum_id=k.id WHERE booking_id=:b");
        $stmt->execute(['b'=>$booking_id]);
        return $stmt->fetchAll();
    }
}
