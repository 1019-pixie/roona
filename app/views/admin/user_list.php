<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1" style="font-family: 'Fredoka', sans-serif;">Daftar Pengguna</h2>
            <p class="text-muted mb-0">Kelola data penyewa dan admin di sini</p>
        </div>
        
        <div class="bg-white px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-people-fill text-primary"></i>
            <span class="fw-bold text-dark"><?=count($users)?> User Terdaftar</span>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 30px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small text-uppercase fw-bold">User Profile</th>
                            <th class="py-3 text-muted small text-uppercase fw-bold">Role / Peran</th>
                            <th class="py-3 text-muted small text-uppercase fw-bold">Tanggal Bergabung</th>
                            <th class="pe-4 py-3 text-end text-muted small text-uppercase fw-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $u): ?>
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=<?=urlencode($u['nama'])?>&background=random&color=fff&size=128" 
                                         alt="Avatar" 
                                         class="rounded-circle shadow-sm me-3" 
                                         style="width: 45px; height: 45px; border: 2px solid white;">
                                    
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark"><?=htmlspecialchars($u['nama'])?></span>
                                        <span class="text-muted small" style="font-size: 0.85rem;"><?=htmlspecialchars($u['email'])?></span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <?php if($u['role'] == 'admin'): ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill border border-danger border-opacity-25">
                                        <i class="bi bi-shield-lock-fill me-1"></i> ADMIN
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill border border-info border-opacity-25">
                                        <i class="bi bi-person-fill me-1"></i> PENYEWA
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="d-flex align-items-center text-muted">
                                    <i class="bi bi-calendar4-week me-2"></i>
                                    <?=date('d M Y', strtotime($u['created_at']))?>
                                </div>
                            </td>

                            <td class="pe-4 text-end">
                                <span class="d-inline-block bg-success rounded-circle" style="width: 10px; height: 10px;" title="Aktif"></span>
                                <span class="ms-1 text-success fw-bold small">Aktif</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white py-3 text-center border-0">
            <small class="text-muted">Menampilkan seluruh data pengguna</small>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>