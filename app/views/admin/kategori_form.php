<?php include __DIR__ . '/../partials/header.php'; ?>
<h2><?= $item ? 'Edit' : 'Tambah' ?> Kategori</h2>
<form method="post" action="index.php?action=admin_kategori_form">
  <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">
  <label>Nama Kategori <input type="text" name="nama" value="<?=htmlspecialchars($item['nama'] ?? '')?>" required></label><br><br>
  <button type="submit">Simpan</button>
</form>
<?php include __DIR__ . '/../partials/footer.php'; ?>