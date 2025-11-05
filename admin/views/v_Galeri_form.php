<?php include 'includes/header.php'; ?>

<?php
$is_edit = isset($galeri) && $galeri;
$form_action = $is_edit ? 'index.php?page=galeri&action=update' : 'index.php?page=galeri&action=store';
$page_title = $is_edit ? 'Edit Galeri' : 'Tambah Galeri Baru';

$val_judul = $is_edit ? htmlspecialchars($galeri['judul']) : '';
$val_deskripsi = $is_edit ? htmlspecialchars($galeri['deskripsi']) : '';
$val_uuid = $is_edit ? $galeri['uuid'] : '';
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
                            <label for="judul">Judul Galeri (Album)</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $val_judul; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"><?php echo $val_deskripsi; ?></textarea>
                        </div>

                        <a href="index.php?page=galeri" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>