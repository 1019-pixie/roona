<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Daftar Kostum</h2>
<a href="index.php?action=admin_kostum_form">Tambah Kostum</a>
<table>
<tr><th>ID</th><th>Nama</th><th>Stok</th><th>Harga</th><th>Aksi</th></tr>
<?php foreach($items as $it): ?>
<tr>
  <td><?=$it['id']?></td>
  <td><?=htmlspecialchars($it['nama'])?></td>
  <td><?=$it['stok']?></td>
  <td>Rp <?=number_format($it['harga_sewa'],0,',','.')?></td>
  <td>
    <a href="index.php?action=admin_kostum_form&id=<?=$it['id']?>">Edit</a> |
    <a href="index.php?action=admin_kostum_delete&id=<?=$it['id']?>" onclick="return confirm('Hapus?')">Hapus</a>
  </td>
</tr>
<?php endforeach; ?>
</table>
<?php include __DIR__ . '/../partials/footer.php'; ?>
