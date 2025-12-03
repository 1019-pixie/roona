<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Kelola Kategori Kostum</h2>
<a href="index.php?action=admin_kategori_form">Tambah Kategori</a>
<table>
<tr><th>ID</th><th>Nama Kategori</th><th>Aksi</th></tr>
<?php foreach($items as $cat): ?>
<tr>
  <td><?=$cat['id']?></td>
  <td><?=htmlspecialchars($cat['nama'])?></td>
  <td>
    <a href="index.php?action=admin_kategori_form&id=<?=$cat['id']?>">Edit</a> |
    <a href="index.php?action=admin_kategori_delete&id=<?=$cat['id']?>" onclick="return confirm('Hapus?')">Hapus</a>
  </td>
</tr>
<?php endforeach; ?>
</table>
<?php include __DIR__ . '/../partials/footer.php'; ?>