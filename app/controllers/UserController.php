<?php
require_once __DIR__ . '/../models/Kostum.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/DetailBooking.php';
require_once __DIR__ . '/../models/Transaksi.php';

class UserController {
    private $pdo;
    private $kostum;
    private $booking;
    private $detail;
    private $transaksi;

    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->kostum = new Kostum($pdo);
        $this->booking = new Booking($pdo);
        $this->detail = new DetailBooking($pdo);
        $this->transaksi = new Transaksi($pdo);
    }

    public function catalog(){
        $items = $this->kostum->all();
        include __DIR__ . '/../views/user/catalog.php';
    }

    public function detail(){
        $id = intval($_GET['id'] ?? 0);
        $item = $this->kostum->find($id);
        include __DIR__ . '/../views/user/kostum_detail.php';
    }

    public function createBooking(){
        if(!isset($_SESSION['user'])){ header('Location: index.php?action=login'); exit; }
        $user_id = $_SESSION['user']['id'];
        $tanggal = $_POST['tanggal_booking'] ?? date('Y-m-d');
        $items = $_POST['items'] ?? [];
        if(empty($items)){ header('Location: index.php?action=catalog'); exit; }

        $booking_id = $this->booking->create($user_id, $tanggal);
        $total = 0;
        foreach($items as $kostum_id => $qty){
            $k = $this->kostum->find($kostum_id);
            if(!$k) continue;
            $qty = intval($qty);
            if($qty <= 0) continue;
            $subtotal = $k['harga_sewa'] * $qty;
            $total += $subtotal;
            $this->detail->create($booking_id, $kostum_id, $qty, $subtotal);
            $this->kostum->reduceStock($kostum_id, $qty);
        }
        $this->transaksi->create($booking_id, $total);
        header('Location: index.php?action=booking_success&id='.$booking_id);
    }

    public function bookingSuccess(){
        $id = intval($_GET['id'] ?? 0);
        $booking = $this->booking->find($id);
        $details = (new DetailBooking($this->pdo))->findByBooking($id);
        $trans = $this->transaksi->findByBooking($id);
        include __DIR__ . '/../views/user/booking_success.php';
    }

    public function myBookings(){
        if(!isset($_SESSION['user'])){ header('Location: index.php?action=login'); exit; }
        $uid = $_SESSION['user']['id'];
        $bookings = $this->booking->findByUser($uid);
        include __DIR__ . '/../views/user/booking_list.php';
    }
}
