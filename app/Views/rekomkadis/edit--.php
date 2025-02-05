<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-edit"></i> Edit Surat Rekomendasi</h1>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('rekomkadis/updaterekomkadis/' . esc($rekom['id'])) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label for="nomor_rekomkadis">Nomor Surat Rekomendasi</label>
                <input type="text" name="nomor_rekomkadis" id="nomor_rekomkadis" class="form-control" value="<?= esc($rekom['nomor_rekomkadis']) ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_rekomkadis">Tanggal Surat</label>
                <input type="date" name="tanggal_rekomkadis" id="tanggal_rekomkadis" class="form-control" value="<?= esc($rekom['tanggal_rekomkadis']) ?>" required>
            </div>
            <div class="form-group">
                <label for="perihal_rekomkadis">Perihal Surat</label>
                <input type="text" name="perihal_rekomkadis" id="perihal_rekomkadis" class="form-control" value="<?= esc($rekom['perihal_rekomkadis']) ?>" required>
            </div>
            <div class="form-group">
                <label for="file_rekomkadis">Upload Surat Baru (Opsional, PDF Maksimal 1 MB)</label>
                <input type="file" name="file_rekomkadis" id="file_rekomkadis" class="form-control" accept=".pdf">
                <small>File saat ini: <a href="<?= base_url('file/rekomkadis/' . esc($rekom['file_rekomkadis'])) ?>" target="_blank"><?= esc($rekom['file_rekomkadis']) ?></a></small>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('rekomkadis') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
