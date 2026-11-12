@extends('layouts.app')

@section('title', 'Verifikasi & Manajemen Laporan - Satgas PPKS')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0"><i class="bi bi-check2-square me-2"></i>Verifikasi & Penanganan Kasus (Satgas)</h4>
        <button class="btn btn-outline-primary btn-sm"><i class="bi bi-file-earmark-excel me-1"></i> Ekspor Laporan Rekapitulasi</button>
    </div>

    <!-- Ringkasan Status -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-primary text-white p-3 rounded-3">
                <h6>Total Laporan Masuk</h6>
                <h3 class="fw-bold mb-0">12</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-warning text-dark p-3 rounded-3">
                <h6>Perlu Verifikasi</h6>
                <h3 class="fw-bold mb-0">4</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-info text-white p-3 rounded-3">
                <h6>Proses Investigasi</h6>
                <h3 class="fw-bold mb-0">5</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-danger text-white p-3 rounded-3">
                <h6>Kasus Mangkir / Eskalasi</h6>
                <h3 class="fw-bold mb-0">3</h3>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Laporan -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white py-3 fw-bold border-bottom">
            <i class="bi bi-table me-2"></i>Daftar Laporan Masuk untuk Verifikasi Kelayakan
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No Tiket</th>
                            <th>Tanggal Masuk</th>
                            <th>Identitas Pelapor (Masking)</th>
                            <th>Kategori</th>
                            <th>Status Laporan</th>
                            <th>Aksi Operasional</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-secondary">#PPKS-2026-001</span></td>
                            <td>25 Okt 2026</td>
                            <td>
                                <span class="fw-semibold text-monospace">N***a S*****a</span>
                                <button class="btn btn-sm btn-link text-decoration-none p-0 ms-1" data-bs-toggle="modal" data-bs-target="#modalUnmasking" title="Buka Masking (Khusus Ketua)"><i class="bi bi-eye-slash text-danger"></i></button>
                            </td>
                            <td>Fisik</td>
                            <td><span class="badge bg-warning text-dark">Perlu Verifikasi</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalVerifikasi"><i class="bi bi-check-circle me-1"></i> Verifikasi</button>
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalSP"><i class="bi bi-envelope-paper"></i> Draft SP</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-secondary">#PPKS-2026-002</span></td>
                            <td>26 Okt 2026</td>
                            <td>
                                <span class="fw-semibold text-monospace">A***d F****i</span>
                                <button class="btn btn-sm btn-link text-decoration-none p-0 ms-1" data-bs-toggle="modal" data-bs-target="#modalUnmasking" title="Buka Masking (Khusus Ketua)"><i class="bi bi-eye-slash text-danger"></i></button>
                            </td>
                            <td>Verbal</td>
                            <td><span class="badge bg-danger">Terlapor Mangkir (2x)</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalSP"><i class="bi bi-envelope-paper"></i> Draft SP</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEskalasi"><i class="bi bi-shield-lock-fill"></i> Eskalasi Pimpinan</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Unmasking Identitas (Sequence Diagram: Ketua Satgas) -->
<div class="modal fade" id="modalUnmasking" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-incognito me-2"></i>Konfirmasi Buka Masking Identitas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="small text-muted mb-3">Aksi ini memerlukan otoritas Ketua Satgas dan akan dicatat dalam log audit keamanan sistem.</p>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alasan Pembukaan Masking Identitas</label>
                    <textarea class="form-control" rows="3" placeholder="Masukkan alasan resmi pembukaan identitas korban/pelapor..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-unlock me-1"></i> Tampilkan Identitas Asli</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Verifikasi Kelayakan (Sequence Diagram: Controller Verifikasi) -->
<div class="modal fade" id="modalVerifikasi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-patch-check me-2"></i>Verifikasi Kelayakan Laporan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Keputusan Verifikasi</label>
                    <select class="form-select">
                        <option value="DIVERIFIKASI">Layak / Diverifikasi (Lanjut Investigasi)</option>
                        <option value="DITOLAK">Tidak Layak / Ditolak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan Verifikasi</label>
                    <textarea class="form-control" rows="3" placeholder="Masukkan pertimbangan hasil verifikasi..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-save me-1"></i> Simpan Hasil Verifikasi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Draft SP -->
<div class="modal fade" id="modalSP" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-file-earmark-word me-2"></i>Generate Draft SP Pemanggilan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Surat Pemanggilan</label>
                    <select class="form-select">
                        <option>Surat Pemanggilan I (SP 1) - Terlapor</option>
                        <option>Surat Pemanggilan II (SP 2) - Terlapor</option>
                        <option>Pemanggilan Saksi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal & Waktu Pemeriksaan</label>
                    <input type="datetime-local" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-printer me-1"></i> Cetak Draft PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eskalasi Mangkir -->
<div class="modal fade" id="modalEskalasi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-exclamation-triangle me-2"></i>Eskalasi Kasus ke Forum Pimpinan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="small text-muted">Pelapor/Terlapor telah mangkir 2x berturut-turut. Laporan ini akan diewalasi secara otomatis ke Dekan/Pimpinan.</p>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Rekomendasi Satgas untuk Pimpinan</label>
                    <textarea class="form-control" rows="3" placeholder="Masukkan rekomendasi penindakan sanksi atau tindakan tegas..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-send-exclamation me-1"></i> Kirim Eskalasi</button>
            </div>
        </div>
    </div>
</div>
@endsection