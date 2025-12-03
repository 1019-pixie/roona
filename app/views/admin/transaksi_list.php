<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Daftar Transaksi</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Penyewa</th>
                            <th>Tanggal Sewa</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($trans as $t): ?>
                        <tr>
                            <td class="ps-4">#<?=$t['id']?></td>
                            <td>
                                <div class="fw-bold"><?=htmlspecialchars($t['penyewa'])?></div>
                                <div class="small text-muted">User ID: <?=$t['user_id']?></div>
                            </td>
                            <td><?=date('d M Y', strtotime($t['created_at']))?></td>
                            <td class="fw-bold">Rp <?=number_format($t['total_bayar'],0,',','.')?></td>
                            <td>
                                <?php if($t['status'] == 'paid'): ?>
                                    <span class="badge rounded-pill bg-success">LUNAS</span>
                                <?php else: ?>
                                    <span class="badge rounded-pill bg-warning text-dark">BELUM BAYAR</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <?php if($t['status'] != 'paid'): ?>
                                    <a href="index.php?action=admin_transaksi_markpaid&id=<?=$t['id']?>" 
                                       class="btn btn-sm btn-success"
                                       onclick="return confirm('Tandai pesanan ini sebagai LUNAS?')">
                                       <i class="bi bi-check-lg"></i> Tandai Lunas
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small"><i class="bi bi-check-all"></i> Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>