<?php include 'includes/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Manajemen Publikasi</h6>
                    <a href="index.php?page=publikasi&action=create" class="btn btn-primary btn-sm">
                        Tambah Publikasi Baru
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Penulis</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_publikasi as $pub): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($pub['judul']); ?></h6>
                                                    <a href="<?php echo htmlspecialchars($pub['tautan']); ?>" target="_blank" class="text-xs text-secondary mb-0">
                                                        Lihat Tautan
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($pub['penulis_nama'] ?? 'N/A'); ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($pub['kategori']); ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo htmlspecialchars($pub['tahun']); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="index.php?page=publikasi&action=edit&uuid=<?php echo $pub['uuid']; ?>" class="text-secondary font-weight-bold text-xs">
                                                Edit
                                            </a>
                                            |
                                            <a href="index.php?page=publikasi&action=delete&uuid=<?php echo $pub['uuid']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus publikasi ini?');" class="text-danger font-weight-bold text-xs">
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