<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <a href="index.php?action=catalog" class="btn btn-outline-primary btn-sm rounded-pill mb-4 px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog
            </a>

            <div class="card shadow-lg border-0 overflow-hidden" style="border-radius: 30px;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        
                        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-4">
                             <?php
                                // Logika Cek Gambar (Sama seperti di Katalog)
                                if(!empty($item['gambar'])){
                                    $imgSrc = 'assets/images/'.$item['gambar'];
                                } else {
                                    $imgSrc = 'https://placehold.co/400x500/png?text='.urlencode($item['nama']);
                                }
                             ?>
                             <img src="<?=$imgSrc?>" alt="<?=htmlspecialchars($item['nama'])?>" 
                                  class="img-fluid shadow-sm" 
                                  style="border-radius: 20px; max-height: 500px; width: 100%; object-fit: cover;">
                        </div>

                        <div class="col-md-7 p-4 p-md-5 d-flex flex-column">
                            
                            <div class="mb-3">
                                <span class="badge bg-info text-dark rounded-pill me-2 px-3">
                                    <i class="bi bi-tag-fill me-1"></i> <?=htmlspecialchars($item['kategori'] ?? 'Umum')?>
                                </span>
                                <?php if($item['stok'] > 0): ?>
                                    <span class="badge bg-success rounded-pill px-3">
                                        <i class="bi bi-check-circle-fill me-1"></i> Stok: <?=htmlspecialchars($item['stok'])?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger rounded-pill px-3">
                                        <i class="bi bi-x-circle-fill me-1"></i> Habis
                                    </span>
                                <?php endif; ?>
                            </div>

                            <h1 class="fw-bold mb-2" style="font-family: 'Fredoka', sans-serif; color: #4a4a4a;">
                                <?=htmlspecialchars($item['nama'])?>
                            </h1>
                            
                            <h2 class="fw-bold mb-4" style="color: #ff7eb3;">
                                Rp <?=number_format($item['harga_sewa'] ?? 0,0,',','.')?>
                                <span class="fs-6 text-muted fw-normal">/ 3 hari</span>
                            </h2>

                            <div class="row mb-4 p-3 bg-light rounded-4 mx-0 border border-light">
                                <div class="col-6 border-end">
                                    <small class="text-muted fw-bold d-block mb-1" style="font-size: 0.75rem;">UKURAN</small>
                                    <span class="fs-5 fw-bold text-dark"><?=htmlspecialchars($item['ukuran'])?></span>
                                </div>
                                <div class="col-6 ps-4">
                                    <small class="text-muted fw-bold d-block mb-1" style="font-size: 0.75rem;">VENDOR</small>
                                    <span class="fs-5 fw-bold text-dark">Roona Official</span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="fw-bold mb-2">Deskripsi Kostum</h5>
                                <p class="text-muted" style="line-height: 1.8; text-align: justify;">
                                    <?=nl2br(htmlspecialchars($item['deskripsi'] ?? 'Tidak ada deskripsi tambahan.'))?>
                                </p>
                            </div>

                            <div class="mt-auto pt-3 border-top">
                                <?php if(isset($_SESSION['user']) && $_SESSION['user']['role']=='penyewa'): ?>
                                    
                                    <?php if($item['stok'] > 0): ?>
                                        <form method="post" action="index.php?action=create_booking">
                                            <div class="d-flex align-items-end gap-3">
                                                <div class="flex-grow-1">
                                                    <label class="form-label small fw-bold text-muted">Jumlah Sewa</label>
                                                    <input type="number" name="items[<?=$item['id']?>]" value="1" min="1" max="<?=max(1,$item['stok']??1)?>" class="form-control form-control-lg text-center fw-bold">
                                                </div>
                                                <input type="hidden" name="tanggal_booking" value="<?=date('Y-m-d')?>">
                                                
                                                <button type="submit" class="btn btn-primary btn-lg flex-grow-1 px-4 shadow-sm" style="height: 52px;">
                                                    <i class="bi bi-bag-heart-fill me-2"></i> Booking Sekarang
                                                </button>
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-secondary w-100 btn-lg rounded-pill" disabled>
                                            <i class="bi bi-emoji-frown me-2"></i> Stok Sedang Habis
                                        </button>
                                    <?php endif; ?>

                                <?php elseif(isset($_SESSION['user']) && $_SESSION['user']['role']=='admin'): ?>
                                    <a href="index.php?action=admin_kostum_form&id=<?=$item['id']?>" class="btn btn-warning w-100 btn-lg rounded-pill text-white">
                                        <i class="bi bi-pencil-square me-2"></i> Edit Kostum Ini
                                    </a>
                                <?php else: ?>
                                    <div class="alert alert-primary border-0 rounded-4 shadow-sm mb-0 d-flex align-items-center">
                                        <i class="bi bi-info-circle-fill fs-4 me-3 text-primary"></i>
                                        <div>
                                            Ingin menyewa kostum ini?<br>
                                            Silakan <a href="index.php?action=login" class="fw-bold text-decoration-none">Login</a> atau <a href="index.php?action=register" class="fw-bold text-decoration-none">Daftar</a> terlebih dahulu.
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
