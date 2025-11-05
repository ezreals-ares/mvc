<?php include 'includes/header.php'; ?>

<?php
// Cek mode edit atau create
$is_edit = isset($publikasi) && $publikasi;
$form_action = $is_edit ? 'index.php?page=publikasi&action=update' : 'index.php?page=publikasi&action=store';
$page_title = $is_edit ? 'Edit Publikasi' : 'Tambah Publikasi Baru';

// Nilai default
$val_judul = $is_edit ? htmlspecialchars($publikasi['judul']) : '';
$val_tahun = $is_edit ? htmlspecialchars($publikasi['tahun']) : '';
$val_penulis_id = $is_edit ? $publikasi['penulis_id'] : '';
$val_tautan = $is_edit ? htmlspecialchars($publikasi['tautan']) : '';
$val_kategori = $is_edit ? htmlspecialchars($publikasi['kategori']) : '';
$val_uuid = $is_edit ? $publikasi['uuid'] : '';
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><?php echo $page_title; ?></h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo $form_action; ?>" method="POST">

                        <?php if ($is_edit): ?>
                            <input type="hidden" name="uuid" value="<?php echo $val_uuid; ?>">
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="judul">Judul Publikasi</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $val_judul; ?>" required>
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
                                    <label for="penulis_id">Penulis (Anggota)</label>
                                    <select class="form-control" id="penulis_id" name="penulis_id">
                                        <option value="">-- Pilih Penulis (Opsional) --</option>
                                        <?php
                                        // Loop data anggota yang dikirim dari controller
                                        foreach ($data_anggota as $anggota):
                                            $selected = ($val_penulis_id == $anggota['uuid']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $anggota['uuid']; ?>" <?php echo $selected; ?>>
                                                <?php echo htmlspecialchars($anggota['nama']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tautan">Tautan (Link)</label>
                                    <input type="text" class="form-control" id="tautan" name="tautan" value="<?php echo $val_tautan; ?>" placeholder="Contoh: https://jurnal.example.com/...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $val_kategori; ?>" placeholder="Contoh: Jurnal Nasional, Konferensi, dll.">
                                </div>
                            </div>
                        </div>

                        <a href="index.php?page=publikasi" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>