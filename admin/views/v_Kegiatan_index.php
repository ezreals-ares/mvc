<?php include 'includes/header.php'; // Panggil header Anda 
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Manajemen Kegiatan</h6>
                    <a href="index.php?page=kegiatan&action=create" class="btn btn-primary btn-sm">
                        Tambah Kegiatan Baru
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kegiatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pemateri</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_kegiatan as $keg): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($keg['nama']); ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($keg['kategori_kegiatan']); ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($keg['tanggal']); ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($keg['pemateri']); ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="index.php?page=kegiatan&action=edit&uuid=<?php echo $keg['uuid']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit kegiatan">
                                                Edit
                                            </a>
                                            |
                                            <a href="index.php?page=kegiatan&action=delete&uuid=<?php echo $keg['uuid']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Hapus kegiatan">
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

<?php include 'includes/footer.php'; // Panggil footer Anda 
?>