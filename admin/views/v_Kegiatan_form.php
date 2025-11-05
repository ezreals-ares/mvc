<?php include 'includes/header.php'; ?>

<?php
// Cek mode edit atau create
$is_edit = isset($kegiatan) && $kegiatan;
$form_action = $is_edit ? 'index.php?page=kegiatan&action=update' : 'index.php?page=kegiatan&action=store';
$page_title = $is_edit ? 'Edit Kegiatan' : 'Tambah Kegiatan Baru';

// Nilai default untuk form
$val_nama = $is_edit ? htmlspecialchars($kegiatan['nama']) : '';
$val_tanggal = $is_edit ? htmlspecialchars($kegiatan['tanggal']) : '';
$val_pemateri = $is_edit ? htmlspecialchars($kegiatan['pemateri']) : '';
$val_deskripsi = $is_edit ? htmlspecialchars($kegiatan['deskripsi_singkat']) : '';
$val_kategori = $is_edit ? $kegiatan['kategori_kegiatan'] : '';
$val_uuid = $is_edit ? $kegiatan['uuid'] : '';
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
                            <label for="nama">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $val_nama; ?>" required>
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
                                    <label for="pemateri">Pemateri</label>
                                    <input type="text" class="form-control" id="pemateri" name="pemateri" value="<?php echo $val_pemateri; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kategori_kegiatan">Kategori Kegiatan</label>
                            <select class="form-control" id="kategori_kegiatan" name="kategori_kegiatan" required>
                                <option value="workshop" <?php echo ($val_kategori == 'workshop') ? 'selected' : ''; ?>>Workshop</option>
                                <option value="seminar" <?php echo ($val_kategori == 'seminar') ? 'selected' : ''; ?>>Seminar</option>
                                <option value="pengabdian" <?php echo ($val_kategori == 'pengabdian') ? 'selected' : ''; ?>>Pengabdian</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_singkat">Deskripsi Singkat</label>
                            <textarea class="form-control" id="deskripsi_singkat" name="deskripsi_singkat" rows="5"><?php echo $val_deskripsi; ?></textarea>
                        </div>

                        <a href="index.php?page=kegiatan" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>