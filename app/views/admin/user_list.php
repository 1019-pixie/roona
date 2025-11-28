<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Daftar Users</h2>
<table>
<tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th></tr>
<?php foreach($users as $u): ?>
<tr>
  <td><?=$u['id']?></td>
  <td><?=htmlspecialchars($u['nama'])?></td>
  <td><?=htmlspecialchars($u['email'])?></td>
  <td><?=htmlspecialchars($u['role'])?></td>
</tr>
<?php endforeach; ?>
</table>
<?php include __DIR__ . '/../partials/footer.php'; ?>
