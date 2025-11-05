<?php include 'includes/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Upload Foto ke Galeri: "<?php echo htmlspecialchars($galeri['judul']); ?>"</h6>
                </div>
                <div class="card-body">
                    <form action="index.php?page=foto&action=store" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_galeri" value="<?php echo $galeri['uuid']; ?>">

                        <div class="form-group">
                            <label for="path_gambar">Pilih File Gambar</label>
                            <input type="file" class="form-control" id="path_gambar" name="path_gambar" accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload</button>
                        <a href="index.php?page=galeri" class="btn btn-secondary">Kembali ke Daftar Galeri</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Daftar Foto (<?php echo count($data_foto); ?> foto)</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if (empty($data_foto)): ?>
                            <p class="text-center">Belum ada foto di galeri ini.</p>
                        <?php else: ?>
                            <?php foreach ($data_foto as $foto): ?>
                                <div class="col-md-3 mb-4">
                                    <div class="card">
                                        <img src="<?php echo htmlspecialchars($foto['path_gambar']); ?>" class="card-img-top" alt="Foto Galeri" style="height: 200px; object-fit: cover;">
                                        <div class="card-footer text-center">
                                            <a href="index.php?page=foto&action=delete&uuid=<?php echo $foto['uuid']; ?>"
                                                onclick="return confirm('Yakin ingin menghapus foto ini?');"
                                                class="btn btn-danger btn-sm">
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>