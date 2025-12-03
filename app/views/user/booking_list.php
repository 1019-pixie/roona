<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Riwayat Booking Saya</h2>
<table>
<tr><th>ID</th><th>Tanggal</th><th>Status</th><th>Total</th><th>Aksi</th></tr>
<?php foreach($bookings as $b): ?>
<tr>
  <td><?=htmlspecialchars($b['id'])?></td>
  <td><?=htmlspecialchars($b['tanggal_booking'])?></td>
  <td><?=htmlspecialchars($b['status'])?></td>
  <td>Rp <?=number_format($b['total_bayar'] ?? 0,0,',','.')?></td>
  <td>
      <a href="index.php?action=booking_success&id=<?=$b['id']?>">Detail</a>
      
      <?php if($b['allow_cancel']): ?>
          | <a href="index.php?action=cancel_booking&id=<?=$b['id']?>" 
             onclick="return confirm('Batalkan pesanan?')" 
             style="color:red">Batal</a>
      <?php endif; ?>
      
  </td>
</tr>
<?php endforeach; ?>
</table>
<?php include __DIR__ . '/../partials/footer.php'; ?>