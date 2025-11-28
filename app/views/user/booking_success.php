<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Booking Berhasil</h2>
<p>ID Booking: <?=htmlspecialchars($booking['id'])?></p>
<p>Tanggal Booking: <?=htmlspecialchars($booking['tanggal_booking'])?></p>
<p>Status: <?=htmlspecialchars($booking['status'])?></p>
<h3>Detail</h3>
<table>
<tr><th>Kostum</th><th>Qty</th><th>Subtotal</th></tr>
<?php foreach($details as $d): ?>
<tr>
  <td><?=htmlspecialchars($d['kostum_nama'])?></td>
  <td><?=htmlspecialchars($d['qty'])?></td>
  <td>Rp <?=number_format($d['subtotal'],0,',','.')?></td>
</tr>
<?php endforeach; ?>
</table>
<p>Total: Rp <?=number_format($trans['total_bayar'] ?? 0,0,',','.')?></p>
<p>Status Pembayaran: <?=htmlspecialchars($trans['status'] ?? 'unpaid')?></p>
<?php include __DIR__ . '/../partials/footer.php'; ?>
