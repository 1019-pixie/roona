<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="index.php?action=my_bookings" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Riwayat
                </a>
                <span class="text-muted small">
                    <i class="bi bi-clock me-1"></i> <?=date('d F Y, H:i', strtotime($booking['created_at']))?>
                </span>
            </div>

            <div class="card border-0 shadow-lg overflow-hidden position-relative" style="border-radius: 30px; background: #fff;">
                
                <div style="height: 10px; background: linear-gradient(90deg, #ff7eb3, #ff758c);"></div>
                
                <div class="card-body p-5">
                    
                    <div class="text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-check-lg fs-1"></i>
                        </div>
                        <h2 class="fw-bold mb-1" style="font-family: 'Fredoka', sans-serif; color: #4a4a4a;">Booking Berhasil!</h2>
                        <p class="text-muted">Terima kasih telah memesan di Roona.</p>
                        
                        <div class="d-inline-block border border-2 border-light px-4 py-2 rounded-pill mt-2">
                            <span class="text-muted small fw-bold text-uppercase">ID Pesanan</span>
                            <span class="ms-2 fw-bold text-dark">#<?=str_pad($booking['id'], 6, '0', STR_PAD_LEFT)?></span>
                        </div>
                    </div>

                    <div class="row text-center mb-5 gx-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border border-light h-100">
                                <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 0.7rem;">Status Pesanan</small>
                                <?php if($booking['status']=='pending'): ?>
                                    <span class="badge bg-warning text-dark rounded-pill px-3">Menunggu Konfirmasi</span>
                                <?php elseif($booking['status']=='approved'): ?>
                                    <span class="badge bg-success rounded-pill px-3">Disetujui</span>
                                <?php else: ?>
                                    <span class="badge bg-danger rounded-pill px-3">Dibatalkan</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border border-light h-100">
                                <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 0.7rem;">Pembayaran</small>
                                <?php if(($trans['status'] ?? 'unpaid') == 'paid'): ?>
                                    <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> LUNAS</span>
                                <?php else: ?>
                                    <span class="text-danger fw-bold"><i class="bi bi-exclamation-circle-fill me-1"></i> BELUM LUNAS</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-3" style="font-family: 'Fredoka', sans-serif;">Rincian Item</h5>
                    <div class="table-responsive mb-4 rounded-4 border border-light overflow-hidden">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light text-muted small text-uppercase">
                                <tr>
                                    <th class="py-3 ps-4">Kostum</th>
                                    <th class="py-3 text-center">Qty</th>
                                    <th class="py-3 pe-4 text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($details as $d): ?>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="fw-bold text-dark"><?=htmlspecialchars($d['kostum_nama'])?></div>
                                        <div class="small text-muted">Sewa 3 Hari</div>
                                    </td>
                                    <td class="text-center py-3">
                                        <span class="badge bg-white text-dark border rounded-pill px-3"><?=htmlspecialchars($d['qty'])?></span>
                                    </td>
                                    <td class="pe-4 text-end fw-bold text-dark py-3">
                                        Rp <?=number_format($d['subtotal'],0,',','.')?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td colspan="2" class="ps-4 py-3 fw-bold text-dark">Total Tagihan</td>
                                    <td class="pe-4 py-3 text-end fw-bold fs-5" style="color: #ff7eb3;">
                                        Rp <?=number_format($trans['total_bayar'] ?? 0,0,',','.')?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <?php if(($trans['status'] ?? 'unpaid') == 'unpaid' && $booking['status'] != 'cancelled'): ?>
                        <div class="alert alert-warning border-0 rounded-4 d-flex align-items-center mb-0 p-3 shadow-sm">
                            <div class="fs-1 me-3">🏦</div>
                            <div>
                                <h6 class="fw-bold mb-1">Instruksi Pembayaran</h6>
                                <p class="mb-0 small text-muted">Silakan transfer ke <strong>BCA 123-456-7890</strong> a.n Roona Official. Tunjukkan bukti transfer saat pengambilan kostum.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                
                <div class="card-footer bg-light border-0 py-3 text-center">
                    <button onclick="window.print()" class="btn btn-link text-decoration-none text-muted small fw-bold">
                        <i class="bi bi-printer me-1"></i> Cetak Nota / Simpan PDF
                    </button>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted small opacity-50">Butuh bantuan? Hubungi Admin via WhatsApp (+62 812-3456-7890)</p>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>