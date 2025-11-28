<?php include __DIR__ . '/../partials/header.php'; ?>
<h2><?= $item ? 'Edit' : 'Tambah' ?> Kostum</h2>
<form method="post" action="index.php?action=admin_kostum_form">
  <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">
  <label>Nama <input type="text" name="nama" value="<?=htmlspecialchars($item['nama'] ?? '')?>" required></label><br><br>
  <label>Ukuran <input type="text" name="ukuran" value="<?=htmlspecialchars($item['ukuran'] ?? '')?>"></label><br><br>
  <label>Stok <input type="number" name="stok" value="<?=htmlspecialchars($item['stok'] ?? 0)?>"></label><br><br>
  <label>Harga Sewa <input type="number" name="harga_sewa" value="<?=htmlspecialchars($item['harga_sewa'] ?? 0)?>" step="0.01"></label><br><br>
  <label>Deskripsi<br>
    <textarea name="deskripsi"><?=htmlspecialchars($item['deskripsi'] ?? '')?></textarea>
  </label><br><br>
  <button type="submit">Simpan</button>
</form>
<?php include __DIR__ . '/../partials/footer.php'; ?>
