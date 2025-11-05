<?php include 'includes/header.php'; ?>

<?php
$is_edit = isset($partner) && $partner;
$form_action = $is_edit ? 'index.php?page=partnership&action=update' : 'index.php?page=partnership&action=store';
$page_title = $is_edit ? 'Edit Partnership' : 'Tambah Partner Baru';

// Nilai default
$val_nama = $is_edit ? htmlspecialchars($partner['nama']) : '';
$val_website = $is_edit ? htmlspecialchars($partner['website']) : '';
$val_logo = $is_edit ? $partner['logo'] : '';
$val_uuid = $is_edit ? $partner['uuid'] : '';
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
                            <label for="nama">Nama Partner</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $val_nama; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" value="<?php echo $val_website; ?>" placeholder="Contoh: https://www.example.com">
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo Partner</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            <?php if ($is_edit && $val_logo): ?>
                                <p class="mt-2">Logo saat ini: <br><img src="<?php echo htmlspecialchars($val_logo); ?>" height="50"></p>
                                <small>Kosongkan jika tidak ingin mengubah logo.</small>
                            <?php endif; ?>
                        </div>

                        <a href="index.php?page=partnership" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>