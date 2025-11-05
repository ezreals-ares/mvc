<?php include __DIR__ . '/../includes/header.php'; ?>

<?php
$is_edit = isset($produk) && $produk;
$form_action = $is_edit ? 'index.php?page=produk&action=update' : 'index.php?page=produk&action=store';
$page_title = $is_edit ? 'Edit Produk' : 'Tambah Produk Baru';

$val_nama = $is_edit ? htmlspecialchars($produk['nama']) : '';
$val_tahun = $is_edit ? htmlspecialchars($produk['tahun']) : '';
$val_pembuat_id = $is_edit ? $produk['pembuat_id'] : '';
$val_deskripsi = $is_edit ? htmlspecialchars($produk['deskripsi']) : '';
$val_link_demo = $is_edit ? htmlspecialchars($produk['link_demo']) : '';
$val_path_gambar = $is_edit ? $produk['path_gambar'] : '';
$val_uuid = $is_edit ? $produk['uuid'] : '';
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
                            <label for="nama">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $val_nama; ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="number" class="form-control" id="tahun" name="tahun" value="<?php echo $val_tahun; ?>" placeholder="Contoh: 2024">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pembuat_id">Pembuat (Anggota)</label>
                                    <select class="form-control" id="pembuat_id" name="pembuat_id">
                                        <option value="">-- Pilih Pembuat (Opsional) --</option>
                                        <?php
                                        foreach ($data_anggota as $anggota):
                                            $selected = ($val_pembuat_id == $anggota['uuid']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $anggota['uuid']; ?>" <?php echo $selected; ?>>
                                                <?php echo htmlspecialchars($anggota['nama']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="link_demo">Link Demo / Source Code</label>
                            <input type="text" class="form-control" id="link_demo" name="link_demo" value="<?php echo $val_link_demo; ?>" placeholder="Contoh: https://github.com/user/repo">
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Produk</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"><?php echo $val_deskripsi; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="path_gambar">Gambar Produk</label>
                            <input type="file" class="form-control" id="path_gambar" name="path_gambar" accept="image/*">
                            <?php if ($is_edit && $val_path_gambar): ?>
                                <p class="mt-2">Gambar saat ini: <br><img src="<?php echo htmlspecialchars($val_path_gambar); ?>" height="100"></p>
                                <small>Kosongkan jika tidak ingin mengubah gambar.</small>
                            <?php endif; ?>
                        </div>

                        <a href="index.php?page=produk" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>