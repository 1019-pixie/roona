<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-5 col-lg-4">
            
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-body p-5 text-center">
                    
                    <h2 class="fw-bold mb-2" style="color: #ff7eb3;">Join Roona ✨</h2>
                    <p class="text-muted small mb-4">Buat akun untuk mulai berpetualang!</p>
                    
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger py-2 small rounded-pill mb-3 border-0">
                            <?=htmlspecialchars($error)?>
                        </div>
                    <?php endif;?>
                    
                    <form method="post" action="index.php?action=register" class="text-start">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted ms-3">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-lg fs-6 ps-4" required placeholder="Your Name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted ms-3">Email Address</label>
                            <input type="email" name="email" class="form-control form-control-lg fs-6 ps-4" required placeholder="email@domain.com">
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted ms-3">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg fs-6 ps-4" required placeholder="••••••••">
                            <div class="form-text small ms-3 text-muted">Minimal 6 karakter ya!</div>
                        </div>
                        
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg fs-6 py-3 shadow-sm">
                                Daftar Akun <i class="bi bi-person-plus-fill ms-1"></i>
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center">
                        <p class="small text-muted mb-0">Sudah punya akun?</p>
                        <a href="index.php?action=login" class="text-decoration-none fw-bold" style="color: #ff7eb3;">Login di sini</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>