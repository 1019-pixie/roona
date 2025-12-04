<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1" style="font-family: 'Fredoka', sans-serif;">Pesanan Saya</h2>
            <p class="text-muted mb-0">Pantau status sewa kostummu di sini</p>
        </div>
        <div class="d-none d-md-block">
            <span class="badge bg-white text-primary shadow-sm p-3 rounded-pill">
                <i class="bi bi-bag-heart-fill me-2"></i> Total: <?=count($bookings)?> Pesanan
            </span>
        </div>
    </div>

    <?php if(empty($bookings)): ?>
        <div class="card border-0 shadow-sm rounded-4 py-5 text-center">
            <div class="card-body">
                <div class="mb-3 text-muted opacity-25">
                    <i class="bi bi-basket3 fs-1" style="font-size: 4rem;"></i>
                </div>
                <h4 class="fw-bold text-muted">Belum ada riwayat pesanan</h4>
                <p class="text-muted mb-4">Yuk, cari kostum impianmu sekarang!</p>
                <a href="index.php?action=catalog" class="btn btn-primary rounded-pill px-4">
                    Lihat Katalog
                </a>
            </div>
        </div>
    <?php else: ?>

        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 30px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted small text-uppercase">
                            <tr>
                                <th class="ps-4 py-3">ID Order</th>
                                <th class="py-3">Tanggal Sewa</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Total Tagihan</th>
                                <th class="pe-4 py-3 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($bookings as $b): ?>
                            <tr>
                                <td class="ps-4 py-3 fw-bold text-primary">
                                    #<?=str_pad($b['id'], 5, '0', STR_PAD_LEFT)?>
                                </td>
                                
                                <td>
                                    <div class="d-flex align-items-center text-dark">
                                        <i class="bi bi-calendar-event me-2 text-muted"></i>
                                        <?=date('d M Y', strtotime($b['tanggal_booking']))?>
                                    </div>
                                </td>
                                
                                <td>
                                    <?php if($b['status'] == 'pending'): ?>
                                        <span class="badge bg-warning text-dark border border-warning border-opacity-25 rounded-pill px-3">
                                            <i class="bi bi-hourglass-split me-1"></i> Menunggu
                                        </span>
                                    <?php elseif($b['status'] == 'approved'): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3">
                                            <i class="bi bi-check-circle-fill me-1"></i> Disetujui
                                        </span>
                                    <?php elseif($b['status'] == 'cancelled'): ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3">
                                            <i class="bi bi-x-circle-fill me-1"></i> Dibatalkan
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary rounded-pill px-3"><?=htmlspecialchars($b['status'])?></span>
                                    <?php endif; ?>

                                    <?php if(($b['status_bayar'] ?? 'unpaid') == 'paid'): ?>
                                        <span class="badge bg-success rounded-pill ms-1" title="Lunas">Paid</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="fw-bold" style="color: #4a4a4a;">
                                    Rp <?=number_format($b['total_bayar'] ?? 0,0,',','.')?>
                                </td>
                                
                                <td class="pe-4 text-end">
                                    <a href="index.php?action=booking_success&id=<?=$b['id']?>" 
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1" 
                                       title="Lihat Nota">
                                        Detail
                                    </a>
                                    
                                    <?php if(!empty($b['allow_cancel'])): ?>
                                        <a href="index.php?action=cancel_booking&id=<?=$b['id']?>" 
                                           class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                           onclick="return confirm('Yakin ingin membatalkan pesanan ini? Stok akan dikembalikan.')"
                                           title="Batalkan Pesanan">
                                            Batal
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>