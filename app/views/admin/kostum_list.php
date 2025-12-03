<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Kelola Kostum</h2>
        <a href="index.php?action=admin_kostum_form" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Data
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Produk</th>
                            <th>Stok</th>
                            <th>Harga Sewa</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($items as $it): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div style="width: 50px; height: 50px; flex-shrink: 0; overflow: hidden;" class="rounded bg-light me-3 border">
                                        <?php if(!empty($it['gambar']) && file_exists('assets/images/'.$it['gambar'])): ?>
                                            <img src="assets/images/<?=$it['gambar']?>" style="width:100%; height:100%; object-fit:cover;">
                                        <?php else: ?>
                                            <div class="d-flex align-items-center justify-content-center h-100 text-muted small">Img</div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark"><?=htmlspecialchars($it['nama'])?></div>
                                        <div class="small text-muted">ID: <?=$it['id']?> | Kat: <?=htmlspecialchars($it['kategori'] ?? '-')?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if($it['stok'] > 0): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success px-3"><?=htmlspecialchars($it['stok'])?> Unit</span>
                                <?php else: ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3">Habis</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-muted">
                                Rp <?=number_format($it['harga_sewa'],0,',','.')?>
                            </td>
                            <td class="text-end pe-4">
                                <a href="index.php?action=admin_kostum_form&id=<?=$it['id']?>" class="btn btn-sm btn-outline-warning me-1">Edit</a>
                                <a href="index.php?action=admin_kostum_delete&id=<?=$it['id']?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Yakin ingin menghapus kostum ini?')">Hapus</a>
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