<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-bold"><?= $item ? 'Edit' : 'Tambah' ?> Kostum</h4>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="index.php?action=admin_kostum_form" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama Kostum</label>
                            <input type="text" name="nama" class="form-control" value="<?=htmlspecialchars($item['nama'] ?? '')?>" required placeholder="Misal: Cosplay Naruto Uzumaki">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar Kostum</label>
                            <div class="d-flex align-items-start gap-3">
                                <?php if(!empty($item['gambar'])): ?>
                                    <img src="assets/images/<?=$item['gambar']?>" class="img-thumbnail" style="width:100px; height:100px; object-fit:cover;">
                                <?php endif; ?>
                                <div class="w-100">
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                    <div class="form-text">Format: JPG, PNG, WEBP. Kosongkan jika tidak ingin mengubah gambar.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori (ID)</label>
                                <input type="number" name="kategori_id" class="form-control" value="<?=htmlspecialchars($item['kategori_id'] ?? '')?>" placeholder="ID Kategori">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ukuran</label>
                                <input type="text" name="ukuran" class="form-control" value="<?=htmlspecialchars($item['ukuran'] ?? '')?>" placeholder="S, M, L, XL, All Size">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" value="<?=htmlspecialchars($item['stok'] ?? 0)?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Sewa (Rp)</label>
                                <input type="number" name="harga_sewa" class="form-control" value="<?=htmlspecialchars($item['harga_sewa'] ?? 0)?>" step="0.01">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Deskripsi Lengkap</label>
                            <textarea name="deskripsi" class="form-control" rows="4"><?=htmlspecialchars($item['deskripsi'] ?? '')?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="index.php?action=admin_kostum" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>