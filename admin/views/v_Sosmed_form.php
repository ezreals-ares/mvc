<?php include 'includes/header.php'; ?>

<?php
$is_edit = isset($sosmed) && $sosmed;
$form_action = $is_edit ? 'index.php?page=sosmed&action=update' : 'index.php?page=sosmed&action=store';
$page_title = $is_edit ? 'Edit Link Sosmed' : 'Tambah Link Sosmed Baru';

// Nilai default
$val_nama = $is_edit ? htmlspecialchars($sosmed['nama']) : '';
$val_url = $is_edit ? htmlspecialchars($sosmed['url']) : '';
$val_uuid = $is_edit ? $sosmed['uuid'] : '';
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
                            <label for="nama">Nama Media Sosial</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $val_nama; ?>" required placeholder="Contoh: Instagram, Facebook, LinkedIn">
                        </div>

                        <div class="form-group">
                            <label for="url">URL / Link</label>
                            <input type="text" class="form-control" id="url" name="url" value="<?php echo $val_url; ?>" required placeholder="Contoh: https://www.instagram.com/akun">
                        </div>

                        <a href="index.php?page=sosmed" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>