<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="text-center mb-5">
    <h1 class="fw-bold">Katalog Kostum</h1>
    <p class="text-muted">Temukan kostum terbaik untuk acaramu</p>
</div>

<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
<?php foreach($items as $it): ?>
  <div class="col">
    <div class="card h-100 shadow-sm border-0 hover-card">
<div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px; overflow:hidden;">
        <?php 
            if(!empty($it['gambar'])){
                $imgSrc = 'assets/images/'.$it['gambar'];
            } else {
                $imgSrc = 'https://placehold.co/400x300/png?text='.urlencode($it['nama']);
            }
        ?>
        <img src="<?=$imgSrc?>" alt="<?=htmlspecialchars($it['nama'])?>" style="width:100%; height:100%; object-fit:cover;">
      </div>
      
      <div class="card-body d-flex flex-column">
        <h5 class="card-title text-truncate"><?=htmlspecialchars($it['nama'])?></h5>
        <p class="card-text small text-muted mb-1">
            <span class="badge bg-info text-dark"><?=htmlspecialchars($it['kategori'] ?? 'Umum')?></span>
            | Ukuran: <strong><?=htmlspecialchars($it['ukuran'])?></strong>
        </p>
        <h6 class="text-primary fw-bold my-2">Rp <?=number_format($it['harga_sewa'],0,',','.')?></h6>
        
        <div class="mt-auto d-grid gap-2">
            <a href="index.php?action=detail&id=<?=$it['id']?>" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
            
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role']=='penyewa'): ?>
              <form method="post" action="index.php?action=create_booking" class="d-grid">
                <input type="hidden" name="items[<?=$it['id']?>]" value="1">
                <input type="hidden" name="tanggal_booking" value="<?=date('Y-m-d')?>">
                <button type="submit" class="btn btn-primary btn-sm" <?= ($it['stok'] <= 0) ? 'disabled' : '' ?>>
                    <?= ($it['stok'] > 0) ? 'Booking Langsung' : 'Stok Habis' ?>
                </button>
              </form>
            <?php endif; ?>
        </div>
      </div>
      <div class="card-footer bg-white border-0 text-muted small">
        Stok Tersedia: <?=htmlspecialchars($it['stok'])?>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
