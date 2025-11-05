<?php include 'includes/header.php'; ?>

<?php
// Cek apakah ini mode edit (jika $berita ada isinya) atau mode create (jika $berita = null)
$is_edit = isset($berita) && $berita;
$form_action = $is_edit ? 'index.php?page=berita&action=update' : 'index.php?page=berita&action=store';
$page_title = $is_edit ? 'Edit Berita' : 'Tambah Berita Baru';

// Nilai default untuk form
$val_judul = $is_edit ? htmlspecialchars($berita['judul']) : '';
$val_tanggal = $is_edit ? htmlspecialchars($berita['tanggal']) : '';
$val_tempat = $is_edit ? htmlspecialchars($berita['tempat']) : '';
$val_deskripsi = $is_edit ? htmlspecialchars($berita['deskripsi']) : '';
$val_kategori = $is_edit ? $berita['kategori'] : '';
$val_uuid = $is_edit ? $berita['uuid'] : '';
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
                            <label for="judul">Judul Berita</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $val_judul; ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $val_tanggal; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat">Tempat</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" value="<?php echo $val_tempat; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori" required>
                                <option value="agenda" <?php echo ($val_kategori == 'agenda') ? 'selected' : ''; ?>>Agenda</option>
                                <option value="pengumuman" <?php echo ($val_kategori == 'pengumuman') ? 'selected' : ''; ?>>Pengumuman</option>
                                <option value="berita" <?php echo ($val_kategori == 'berita') ? 'selected' : ''; ?>>Berita</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"><?php echo $val_deskripsi; ?></textarea>
                        </div>

                        <a href="index.php?page=berita" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>