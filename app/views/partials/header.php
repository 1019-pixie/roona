<?php
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Roona - Penyewaan Kostum</title>
  <link rel="stylesheet" href="assets/style.css">
  <style>
    body{font-family:Arial,Helvetica,sans-serif; margin:0; padding:0;}
    header{background:#222; color:#fff; padding:10px 20px;}
    header a{color:#fff; margin-right:10px; text-decoration:none;}
    main{padding:20px;}
    .grid{display:flex; gap:10px; flex-wrap:wrap;}
    .card{border:1px solid #ddd; padding:10px; width:220px;}
    table{width:100%; border-collapse:collapse;}
    table td,table th{border:1px solid #ddd; padding:8px;}
    form.inline{display:inline;}
  </style>
</head>
<body>
<header>
  <a href="index.php?action=catalog"><strong>Roona</strong></a>
  <nav style="display:inline-block; margin-left:20px;">
    <a href="index.php?action=catalog">Katalog</a>
    <?php if(isset($_SESSION['user'])): ?>
      <?php if($_SESSION['user']['role']=='admin'): ?>
        <a href="index.php?action=admin">Admin</a>
      <?php else: ?>
        <a href="index.php?action=my_bookings">My Bookings</a>
      <?php endif; ?>
      <a href="index.php?action=logout">Logout (<?=htmlspecialchars($_SESSION['user']['nama'])?>)</a>
    <?php else: ?>
      <a href="index.php?action=login">Login</a>
      <a href="index.php?action=register">Register</a>
    <?php endif;?>
  </nav>
</header>
<main>
