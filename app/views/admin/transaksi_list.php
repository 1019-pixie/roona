<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Daftar Transaksi</h2>
<table>
<tr><th>ID</th><th>Penyewa</th><th>Total</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
<?php foreach($trans as $t): ?>
<tr>
  <td><?=$t['id']?></td>
  <td><?=htmlspecialchars($t['penyewa'])?></td>
  <td>Rp <?=number_format($t['total_bayar'],0,',','.')?></td>
  <td><?=htmlspecialchars($t['status'])?></td>
  <td><?=htmlspecialchars($t['created_at'])?></td>
  <td>
    <?php if($t['status']!='paid'): ?>
      <a href="index.php?action=admin_transaksi_markpaid&id=<?=$t['id']?>">Mark Paid</a>
    <?php endif; ?>
  </td>
</tr>
<?php endforeach; ?>
</table>
<?php include __DIR__ . '/../partials/footer.php'; ?>
