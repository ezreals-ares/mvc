<?php
// 1. Panggil header dengan path __DIR__ yang benar
include __DIR__ . '/../includes/header.php';
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Manajemen Berita</h6>
                    <a href="index.php?page=berita&action=create" class="btn btn-primary btn-sm">
                        Tambah Berita Baru
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_berita as $berita): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($berita['judul']); ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($berita['kategori']); ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($berita['tanggal']); ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo htmlspecialchars($berita['tempat']); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="index.php?page=berita&action=edit&uuid=<?php echo $berita['uuid']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit berita">
                                                Edit
                                            </a>
                                            |
                                            <a href="index.php?page=berita&action=delete&uuid=<?php echo $berita['uuid']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?');" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Hapus berita">
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

<?php
// 2. Panggil footer (yang sudah bersih) dengan path __DIR__ yang benar
include __DIR__ . '/../includes/footer.php';
?>