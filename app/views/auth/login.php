<?php include __DIR__ . '/../partials/header.php'; ?>
<h2>Login</h2>
<?php if(!empty($error)): ?><p style="color:red"><?=htmlspecialchars($error)?></p><?php endif;?>
<form method="post" action="index.php?action=login">
  <label>Email <input type="email" name="email" required></label><br><br>
  <label>Password <input type="password" name="password" required></label><br><br>
  <button type="submit">Login</button>
</form>
<p>Belum punya akun? <a href="index.php?action=register">Register</a></p>
<?php include __DIR__ . '/../partials/footer.php'; ?>
