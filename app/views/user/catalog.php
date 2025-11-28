<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Katalog Kostum</h2>
<div class="grid">
<?php foreach($items as $it): ?>
  <div class="card">
    <h3><?=htmlspecialchars($it['nama'])?></h3>
    <p>Kategori: <?=htmlspecialchars($it['kategori'] ?? '-')?></p>
    <p>Ukuran: <?=htmlspecialchars($it['ukuran'])?> | Stok: <?=htmlspecialchars($it['stok'])?></p>
    <p>Harga: Rp <?=number_format($it['harga_sewa'],0,',','.')?></p>
    <a href="index.php?action=detail&id=<?=$it['id']?>">Lihat</a>
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role']=='penyewa'): ?>
      <form method="post" action="index.php?action=create_booking">
        <input type="hidden" name="items[<?=$it['id']?>]" value="1">
        <input type="hidden" name="tanggal_booking" value="<?=date('Y-m-d')?>">
        <button type="submit">Booking 1</button>
      </form>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
