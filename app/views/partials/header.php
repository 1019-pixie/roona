<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Roona - Penyewaan Kostum</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="anime-theme d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
  <div class="container-fluid px-4">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php?action=catalog">
        <img src="assets/images/logo.jpg" alt="Logo" width="50" height="50" 
             class="d-inline-block align-text-top bg-white rounded-circle p-1">
        
        <span>Roona</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=catalog">Katalog</a>
        </li>
        <?php if(isset($_SESSION['user'])): ?>
          <?php if($_SESSION['user']['role']=='admin'): ?>
            <li class="nav-item"><a class="nav-link" href="index.php?action=admin">Admin Panel</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="index.php?action=my_bookings">Pesanan Saya</a></li>
          <?php endif; ?>
          <li class="nav-item ms-2">
            <a class="btn btn-outline-light btn-sm mt-1" href="index.php?action=logout">Logout (<?=htmlspecialchars($_SESSION['user']['nama'])?>)</a>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="index.php?action=login">Login</a></li>
          <li class="nav-item"><a class="btn btn-primary btn-sm ms-2 mt-1" href="index.php?action=register">Daftar</a></li>
        <?php endif;?>
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4 flex-grow-1">