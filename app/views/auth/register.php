<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Register</h2>
<?php if(!empty($error)): ?><p style="color:red"><?=htmlspecialchars($error)?></p><?php endif;?>
<form method="post" action="index.php?action=register">
  <label>Nama <input type="text" name="nama" required></label><br><br>
  <label>Email <input type="email" name="email" required></label><br><br>
  <label>Password <input type="password" name="password" required></label><br><br>
  <button type="submit">Register</button>
</form>
<?php include __DIR__ . '/../partials/footer.php'; ?>
