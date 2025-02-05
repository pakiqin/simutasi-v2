<?php

namespace App\Controllers;

use App\Models\PengirimanUsulanModel;
use App\Models\UsulanModel;
use App\Models\UsulanStatusHistoryModel;

class RevisiUsulanController extends BaseController
{
    public function deleteByNomorUsulan()
    {
        $nomorUsulan = $this->request->getPost('nomor_usulan');

        if (empty($nomorUsulan)) {
            return redirect()->back()->with('error', 'Nomor usulan tidak valid.');
        }

        // Inisialisasi model
        $pengirimanUsulanModel = new PengirimanUsulanModel();
        $usulanModel = new UsulanModel();
        $statusHistoryModel = new UsulanStatusHistoryModel();

        // Cari data pengiriman terkait
        $pengiriman = $pengirimanUsulanModel->where('nomor_usulan', $nomorUsulan)->first();

        if (!$pengiriman) {
            return redirect()->back()->with('error', 'Data pengiriman usulan tidak ditemukan.');
        }

        // Hapus file PDF rekomendasi jika ada
        if (!empty($pengiriman['dokumen_rekomendasi'])) {
            $filePath = WRITEPATH . 'uploads/rekomendasi/' . $pengiriman['dokumen_rekomendasi'];
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file
            }
        }

        // Hapus data dari tabel pengiriman_usulan
        $pengirimanUsulanModel->where('nomor_usulan', $nomorUsulan)->delete();

        // Update status di tabel usulan menjadi '01'
        $usulan = $usulanModel->where('nomor_usulan', $nomorUsulan)->first();
        if ($usulan) {
            $usulanModel->update($usulan['id'], [
                'status' => '01', // Status kembali ke awal
            ]);
        } else {
            return redirect()->back()->with('error', 'Data usulan tidak ditemukan.');
        }
        // Tambahkan riwayat status ke tabel usulan_status_history
        $statusHistoryModel->save([
            'nomor_usulan' => $nomorUsulan,
            'status' => '01',
            'updated_at' => date('Y-m-d H:i:s'),
            'catatan_history' => 'Data usulan mutasi dilakukan revisi oleh Cabang Dinas',
        ]);

        // Redirect ke halaman revisi dengan pesan sukses
        return redirect()->to("/usulan/revisi/$nomorUsulan")->with('success', '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Revisi berhasil dimulai. Data pengiriman dan file terkait telah dihapus, status usulan dikembalikan ke tahap awal.');
    }
}
