<?php include 'includes/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Manajemen Fasilitas</h6>
                    <a href="index.php?page=fasilitas&action=create" class="btn btn-primary btn-sm">
                        Tambah Fasilitas Baru
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fasilitas</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kuantitas</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_fasilitas as $fas): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <?php if ($fas['path_gambar']): ?>
                                                        <img src="<?php echo htmlspecialchars($fas['path_gambar']); ?>" class="avatar avatar-sm me-3" alt="gambar fasilitas">
                                                    <?php else: ?>
                                                        <div class="avatar avatar-sm me-3 bg-light d-flex justify-content-center align-items-center">
                                                            <i class="ni ni-settings text-dark"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($fas['nama']); ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars(substr($fas['deskripsi'], 0, 100)); ?>...</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo htmlspecialchars($fas['kuantitas']); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="index.php?page=fasilitas&action=edit&uuid=<?php echo $fas['uuid']; ?>" class="text-secondary font-weight-bold text-xs">
                                                Edit
                                            </a>
                                            |
                                            <a href="index.php?page=fasilitas&action=delete&uuid=<?php echo $fas['uuid']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?');" class="text-danger font-weight-bold text-xs">
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