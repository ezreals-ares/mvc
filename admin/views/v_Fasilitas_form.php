<?php include 'includes/header.php'; ?>

<?php
$is_edit = isset($fasilitas) && $fasilitas;
$form_action = $is_edit ? 'index.php?page=fasilitas&action=update' : 'index.php?page=fasilitas&action=store';
$page_title = $is_edit ? 'Edit Fasilitas' : 'Tambah Fasilitas Baru';

// Nilai default
$val_nama = $is_edit ? htmlspecialchars($fasilitas['nama']) : '';
$val_deskripsi = $is_edit ? htmlspecialchars($fasilitas['deskripsi']) : '';
$val_kuantitas = $is_edit ? htmlspecialchars($fasilitas['kuantitas']) : '1';
$val_path_gambar = $is_edit ? $fasilitas['path_gambar'] : '';
$val_uuid = $is_edit ? $fasilitas['uuid'] : '';
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><?php echo $page_title; ?></h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">

                        <?php if ($is_edit): ?>
                            <input type="hidden" name="uuid" value="<?php echo $val_uuid; ?>">
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nama">Nama Fasilitas</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $val_nama; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kuantitas">Kuantitas</label>
                                    <input type="number" class="form-control" id="kuantitas" name="kuantitas" value="<?php echo $val_kuantitas; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"><?php echo $val_deskripsi; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="path_gambar">Gambar Fasilitas</label>
                            <input type="file" class="form-control" id="path_gambar" name="path_gambar" accept="image/*">
                            <?php if ($is_edit && $val_path_gambar): ?>
                                <p class="mt-2">Gambar saat ini: <br><img src="<?php echo htmlspecialchars($val_path_gambar); ?>" height="100"></p>
                                <small>Kosongkan jika tidak ingin mengubah gambar.</small>
                            <?php endif; ?>
                        </div>

                        <a href="index.php?page=fasilitas" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>