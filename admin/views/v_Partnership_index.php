<?php include 'includes/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Manajemen Partnership</h6>
                    <a href="index.php?page=partnership&action=create" class="btn btn-primary btn-sm">
                        Tambah Partner Baru
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Partner</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Website</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_partnership as $partner): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <?php if ($partner['logo']): ?>
                                                        <img src="<?php echo htmlspecialchars($partner['logo']); ?>" class="avatar avatar-sm me-3" alt="logo partner">
                                                    <?php else: ?>
                                                        <div class="avatar avatar-sm me-3 bg-light d-flex justify-content-center align-items-center">
                                                            <i class="ni ni-building text-dark"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($partner['nama']); ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo htmlspecialchars($partner['website']); ?>" target="_blank" class="text-xs font-weight-bold mb-0">
                                                <?php echo htmlspecialchars($partner['website']); ?>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="index.php?page=partnership&action=edit&uuid=<?php echo $partner['uuid']; ?>" class="text-secondary font-weight-bold text-xs">
                                                Edit
                                            </a>
                                            |
                                            <a href="index.php?page=partnership&action=delete&uuid=<?php echo $partner['uuid']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus partner ini?');" class="text-danger font-weight-bold text-xs">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>