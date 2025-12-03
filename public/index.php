<?php
session_start();
require_once __DIR__ . '/../app/db.php';

// simple autoload
spl_autoload_register(function($class){
    $paths = [__DIR__ . '/../app/controllers/'.$class.'.php', __DIR__ . '/../app/models/'.$class.'.php'];
    foreach($paths as $p){ if(file_exists($p)) require_once $p; }
});

$auth = new AuthController($pdo);
$userCtrl = new UserController($pdo);
$adminCtrl = new AdminController($pdo);

$action = $_GET['action'] ?? 'home';

switch($action){
    case 'login':
        if($_SERVER['REQUEST_METHOD']==='POST') $auth->login(); else $auth->showLogin();
        break;
    case 'register':
        if($_SERVER['REQUEST_METHOD']==='POST') $auth->register(); else $auth->showRegister();
        break;
    case 'logout':
        $auth->logout();
        break;
    case 'catalog':
        $userCtrl->catalog();
        break;
    case 'detail':
        $userCtrl->detail();
        break;
    case 'create_booking':
        if($_SERVER['REQUEST_METHOD']==='POST') $userCtrl->createBooking();
        break;
    case 'my_bookings':
        $userCtrl->myBookings();
        break;
    case 'cancel_booking':
        $userCtrl->cancelBooking();
        break;
    case 'booking_success':
        $userCtrl->bookingSuccess();
        break;
    // admin
    case 'admin':
        if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
        $adminCtrl->dashboard();
        break;
    case 'admin_kostum':
        if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
        $adminCtrl->listKostum();
        break;
    case 'admin_kostum_form':
        if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
        if($_SERVER['REQUEST_METHOD']==='POST') $adminCtrl->saveKostum(); else $adminCtrl->showKostumForm();
        break;
    case 'admin_kostum_delete':
        if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
        $adminCtrl->deleteKostum();
        break;
    case 'admin_users':
        if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
        $adminCtrl->listUsers();
        break;
    case 'admin_transaksi':
        if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
        $adminCtrl->listTransaksi();
        break;
   
    case 'admin_kategori':
        if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
        $adminCtrl->listKategori();
        break;
    case 'admin_kategori_form':
        if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
        if($_SERVER['REQUEST_METHOD']==='POST') $adminCtrl->saveKategori(); else $adminCtrl->showKategoriForm();
        break;
    case 'admin_kategori_delete':
        if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
        $adminCtrl->deleteKategori();
        break;

    default:
        header('Location: index.php?action=catalog');
        break;
}

// extra route for marking paid
if(isset($_GET['action']) && $_GET['action']=='admin_transaksi_markpaid'){
    if(!isset($_SESSION['user'])||$_SESSION['user']['role']!='admin'){ header('Location: index.php?action=login'); exit; }
    $adminCtrl->markPaid();
    exit;
}
