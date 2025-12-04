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
        $items = $this->kostum->allAvailable(); 
        include __DIR__ . '/../views/user/catalog.php';
    }

    public function detail(){
        $id = intval($_GET['id'] ?? 0);
        $item = $this->kostum->find($id);
        include __DIR__ . '/../views/user/kostum_detail.php';
    }

public function createBooking(){
        // --- MULAI KODE DEBUG ---
        // Kita lihat, apakah sistem mengenal siapa kamu?
        if(!isset($_SESSION['user'])){ 
            echo "<div style='padding:50px; text-align:center; font-family:sans-serif;'>";
            echo "<h1 style='color:red;'>⚠️ Sesi Hilang!</h1>";
            echo "<p>Sistem tidak menemukan data login kamu saat tombol ditekan.</p>";
            echo "<h3>Isi Data Session Saat Ini:</h3>";
            echo "<pre style='background:#f4f4f4; padding:20px; border:1px solid #ccc; display:inline-block; text-align:left;'>";
            var_dump($_SESSION); // <-- Ini akan mencetak isi sesi
            echo "</pre>";
            echo "<br><br><a href='index.php?action=login'>Kembali Login</a>";
            echo "</div>";
            exit; 
        }
        // --- SELESAI KODE DEBUG ---

        // Jika lolos (sesi ada), lanjut proses normal
        $user_id = $_SESSION['user']['id'];
        $tanggal = $_POST['tanggal_booking'] ?? date('Y-m-d');
        $items = $_POST['items'] ?? [];
        
        // Cek apakah item kosong
        if(empty($items)){ 
            echo "Item kosong! Kembali ke katalog."; 
            exit; 
        }

        $booking_id = $this->booking->create($user_id, $tanggal);
        $total = 0;
        foreach($items as $kostum_id => $qty){
            $k = $this->kostum->find($kostum_id);
            if(!$k) continue;
            
            // --- FIX BUG STOK MINUS ---
            // Cek stok dulu sebelum mengurangi
            $qty = intval($qty);
            if($qty <= 0) continue;
            if($k['stok'] < $qty) continue; // Skip jika stok kurang
            // -------------------------

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
        
        foreach($bookings as &$b){
            // Menambahkan flag 'allow_cancel' ke setiap baris data
            $b['allow_cancel'] = ($b['status'] == 'pending');
        }
        unset($b); // Hapus referensi memori

        include __DIR__ . '/../views/user/booking_list.php';
    }

   public function cancelBooking(){
        if(!isset($_SESSION['user'])){ header('Location: index.php?action=login'); exit; }
        
        $id = intval($_GET['id'] ?? 0);
        $user_id = $_SESSION['user']['id'];
        
        $booking = $this->booking->find($id);
        
        // Validasi logika bisnis
        if($booking && $booking['user_id'] == $user_id && $booking['status'] == 'pending'){
            
            // 1. Restock Barang
            $details = $this->detail->findByBooking($id);
            foreach($details as $d){
                $this->kostum->increaseStock($d['kostum_id'], $d['qty']);
            }
            
            // 2. Update Status
            $this->booking->updateStatus($id, 'cancelled');
        }
        
        header('Location: index.php?action=my_bookings');
    }
}
