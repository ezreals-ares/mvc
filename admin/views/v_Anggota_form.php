<?php include 'includes/header.php'; ?>

<?php
$is_edit = isset($anggota) && $anggota;
$form_action = $is_edit ? 'index.php?page=anggota&action=update' : 'index.php?page=anggota&action=store';
$page_title = $is_edit ? 'Edit Anggota' : 'Tambah Anggota Baru';

// Nilai default
$val_nama = $is_edit ? htmlspecialchars($anggota['nama']) : '';
$val_nidn = $is_edit ? htmlspecialchars($anggota['nidn']) : '';
$val_jabatan = $is_edit ? $anggota['jabatan'] : '';
$val_status = $is_edit ? $anggota['status'] : '';
$val_path_gambar = $is_edit ? $anggota['path_gambar'] : '';
$val_uuid = $is_edit ? $anggota['uuid'] : '';
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

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $val_nama; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="nidn">NIDN / NIM</label>
                            <input type="text" class="form-control" id="nidn" name="nidn" value="<?php echo $val_nidn; ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select class="form-control" id="jabatan" name="jabatan" required>
                                        <option value="ketua" <?php echo ($val_jabatan == 'ketua') ? 'selected' : ''; ?>>Ketua</option>
                                        <option value="anggota" <?php echo ($val_jabatan == 'anggota') ? 'selected' : ''; ?>>Anggota</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="mahasiswa" <?php echo ($val_status == 'mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
                                        <option value="dosen" <?php echo ($val_status == 'dosen') ? 'selected' : ''; ?>>Dosen</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="path_gambar">Foto Anggota</label>
                            <input type="file" class="form-control" id="path_gambar" name="path_gambar" accept="image/*">
                            <?php if ($is_edit && $val_path_gambar): ?>
                                <p class="mt-2">Gambar saat ini: <br><img src="<?php echo htmlspecialchars($val_path_gambar); ?>" height="100"></p>
                                <small>Kosongkan jika tidak ingin mengubah gambar.</small>
                            <?php endif; ?>
                        </div>

                        <a href="index.php?page=anggota" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>