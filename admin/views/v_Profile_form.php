<?php include 'includes/header.php'; ?>

<?php
// Cek apakah data profile ada
$is_data_exists = isset($profile) && $profile;

// Nilai default
$val_visi = $is_data_exists ? htmlspecialchars($profile['visi']) : '';
$val_misi = $is_data_exists ? htmlspecialchars($profile['misi']) : '';
$val_sejarah = $is_data_exists ? htmlspecialchars($profile['sejarah']) : '';
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Manajemen Profile Lab</h6>
                    <p>Atur Visi, Misi, dan Sejarah lab Anda di sini.</p>
                </div>
                <div class="card-body">

                    <?php if (isset($_GET['status']) && $_GET['status'] == 'saved'): ?>
                        <div class="alert alert-success text-white" role="alert">
                            <strong>Sukses!</strong> Data profile berhasil diperbarui.
                        </div>
                    <?php endif; ?>

                    <form action="index.php?page=profile&action=save" method="POST">

                        <div class="form-group">
                            <label for="visi">Visi</label>
                            <textarea class="form-control" id="visi" name="visi" rows="5"><?php echo $val_visi; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="misi">Misi</label>
                            <textarea class="form-control" id="misi" name="misi" rows="8"><?php echo $val_misi; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="sejarah">Sejarah</label>
                            <textarea class="form-control" id="sejarah" name="sejarah" rows="10"><?php echo $val_sejarah; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>