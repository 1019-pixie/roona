<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-4">
    <div class="p-4 mb-4 bg-white shadow-sm d-flex align-items-center position-relative overflow-hidden" style="border-radius: 40px;">
       
        <div class="flex-grow-1 position-relative" style="z-index:1;">
            <h2 class="fw-bold text-dark mb-1">Ohayou, Admin-san! 👋</h2>
            <p class="text-muted mb-0">Semangat mengelola kostum hari ini ya!</p>
        </div>
        
        <div class="d-none d-md-block ms-4">
            <img src="assets/images/gojo.gif" 
                 style="height:120px; object-fit:contain; border-radius: 35px;" 
                 alt="Mascot Admin">
        </div>
    </div>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Dashboard Admin</h2>
        <span class="text-muted"><?=date('l, d F Y')?></span>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card text-white bg-primary h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title opacity-75">Total Kostum</h5>
                    <h1 class="display-4 fw-bold mb-0"><?=htmlspecialchars($countKostum)?></h1>
                    <a href="index.php?action=admin_kostum" class="text-white text-decoration-none small stretched-link">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-success h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title opacity-75">Total User</h5>
                    <h1 class="display-4 fw-bold mb-0"><?=htmlspecialchars($countUsers)?></h1>
                    <a href="index.php?action=admin_users" class="text-white text-decoration-none small stretched-link">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title opacity-75">Transaksi</h5>
                    <h1 class="display-4 fw-bold mb-0">Manage</h1>
                    <a href="index.php?action=admin_transaksi" class="text-white text-decoration-none small stretched-link">Kelola Transaksi &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold py-3">Menu Cepat</div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-block">
                <a href="index.php?action=admin_kostum_form" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Kostum Baru
                </a>
                <a href="index.php?action=admin_transaksi" class="btn btn-outline-dark">
                    <i class="bi bi-list-check"></i> Cek Pembayaran
                </a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>