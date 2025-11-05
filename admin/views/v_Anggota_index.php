<?php include 'includes/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Manajemen Anggota</h6>
                    <a href="index.php?page=anggota&action=create" class="btn btn-primary btn-sm">
                        Tambah Anggota Baru
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIDN</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jabatan</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_anggota as $anggota): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <?php if ($anggota['path_gambar']): ?>
                                                        <img src="<?php echo htmlspecialchars($anggota['path_gambar']); ?>" class="avatar avatar-sm me-3" alt="user image">
                                                    <?php else: ?>
                                                        <img src="assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="default image"> <?php endif; ?>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($anggota['nama']); ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($anggota['nidn']); ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($anggota['jabatan']); ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm bg-gradient-success"><?php echo htmlspecialchars($anggota['status']); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="index.php?page=anggota&action=edit&uuid=<?php echo $anggota['uuid']; ?>" class="text-secondary font-weight-bold text-xs">
                                                Edit
                                            </a>
                                            |
                                            <a href="index.php?page=anggota&action=delete&uuid=<?php echo $anggota['uuid']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');" class="text-danger font-weight-bold text-xs">
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