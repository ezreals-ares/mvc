<?php include 'includes/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Manajemen Galeri (Album)</h6>
                    <a href="index.php?page=galeri&action=create" class="btn btn-primary btn-sm">
                        Tambah Galeri Baru
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Galeri</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_galeri as $galeri): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($galeri['judul']); ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars(substr($galeri['deskripsi'], 0, 100)); ?>...</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="index.php?page=galeri&action=view&uuid=<?php echo $galeri['uuid']; ?>" class="text-success font-weight-bold text-xs">
                                                Lihat Foto
                                            </a>
                                            |
                                            <a href="index.php?page=galeri&action=edit&uuid=<?php echo $galeri['uuid']; ?>" class="text-secondary font-weight-bold text-xs">
                                                Edit
                                            </a>
                                            |
                                            <a href="index.php?page=galeri&action=delete&uuid=<?php echo $galeri['uuid']; ?>" onclick="return confirm('Menghapus galeri akan menghapus SEMUA fotonya. Yakin?');" class="text-danger font-weight-bold text-xs">
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