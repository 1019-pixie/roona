<?php include __DIR__ . '/../partials/header.php'; ?>
<h2><?=htmlspecialchars($item['nama'] ?? 'Tidak ditemukan')?></h2>
<p>Kategori: <?=htmlspecialchars($item['kategori'] ?? '-')?></p>
<p>Ukuran: <?=htmlspecialchars($item['ukuran'])?> | Stok: <?=htmlspecialchars($item['stok'])?></p>
<p>Harga: Rp <?=number_format($item['harga_sewa'] ?? 0,0,',','.')?></p>
<p><?=nl2br(htmlspecialchars($item['deskripsi'] ?? ''))?></p>

<?php if(isset($_SESSION['user']) && $_SESSION['user']['role']=='penyewa'): ?>
  <h3>Booking</h3>
  <form method="post" action="index.php?action=create_booking">
    Jumlah: <input type="number" name="items[<?=$item['id']?>]" value="1" min="1" max="<?=max(1,$item['stok']??1)?>">
    <input type="hidden" name="tanggal_booking" value="<?=date('Y-m-d')?>">
    <button type="submit">Booking</button>
  </form>
<?php else: ?>
  <p>Silakan login sebagai penyewa untuk melakukan booking.</p>
<?php endif; ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>
