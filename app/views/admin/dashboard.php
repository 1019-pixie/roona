<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Admin Dashboard</h2>
<p>Total Kostum: <?=htmlspecialchars($countKostum)?></p>
<p>Total Users: <?=htmlspecialchars($countUsers)?></p>
<ul>
  <li><a href="index.php?action=admin_kostum">Kelola Kostum</a></li>
  <li><a href="index.php?action=admin_users">Kelola Users</a></li>
  <li><a href="index.php?action=admin_transaksi">Kelola Transaksi</a></li>
</ul>
<?php include __DIR__ . '/../partials/footer.php'; ?>
