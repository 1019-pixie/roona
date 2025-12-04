<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-5 col-lg-4">
            
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-body p-5 text-center">
                    
                    <div class="mb-4">
                        <img src="assets/images/logo.jpg" alt="Logo Roona" 
                             class="rounded-circle shadow-sm p-2 bg-white"
                             style="width: 100px; height: 100px; object-fit: contain;">
                    </div>
                    
                    <h2 class="fw-bold mb-1" style="color: #ff7eb3;">Welcome Back!</h2>
                    <p class="text-muted small mb-4">Silakan login untuk menyewa kostum</p>
                    
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger py-2 small rounded-pill mb-3 border-0 shadow-sm">
                            <i class="bi bi-exclamation-circle me-1"></i> <?=htmlspecialchars($error)?>
                        </div>
                    <?php endif;?>
                    
                    <form method="post" action="index.php?action=login" class="text-start">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted ms-3">Email Address</label>
                            <input type="email" name="email" class="form-control form-control-lg fs-6 ps-4" required placeholder="name@example.com">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted ms-3">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg fs-6 ps-4" required placeholder="••••••••">
                        </div>
                        
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg fs-6 py-3 shadow-sm">
                                Masuk Sekarang <i class="bi bi-arrow-right-short"></i>
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center">
                        <p class="small text-muted mb-0">Belum punya akun?</p>
                        <a href="index.php?action=register" class="text-decoration-none fw-bold" style="color: #ff7eb3;">Daftar Akun Baru</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4 text-muted small opacity-50">
                &copy; <?=date('Y')?> Roona Cosplay Rent
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>