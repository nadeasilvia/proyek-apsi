@extends('layouts.app')

@section('title', 'Layanan Rujukan & Pendampingan Korban')

@section('content')
<div class="container">
    <h4 class="fw-bold text-primary mb-4"><i class="bi bi-heart-pulse me-2"></i>Sub-Sistem Layanan Rujukan Psikologis & Hukum</h4>

    <div class="row g-4">
        <!-- Form Penerbitan Surat Rujukan -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white fw-bold py-3">
                    <i class="bi bi-file-earmark-plus me-2"></i>Terbitkan Surat Rujukan
                </div>
                <div class="card-body p-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Nomor Tiket Kasus</label>
                            <select class="form-select">
                                <option>#PPKS-2026-001 (Kategori: Fisik)</option>
                                <option>#PPKS-2026-002 (Kategori: Verbal)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mitra Lembaga Rujukan</label>
                            <select class="form-select">
                                <option value="Psikolog">Layanan Konseling Psikologi UINSA</option>
                                <option value="LBH">Advokat / Lembaga Bantuan Hukum (LBH)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan Pengantar Satgas</label>
                            <textarea class="form-control" rows="3" placeholder="Catatan kondisi awal korban untuk mitra rujukan..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-send-check me-1"></i> Generate Surat Rujukan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Log Feedback Kondisi Korban (Psikolog / Advokat) -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-success text-white fw-bold py-3">
                    <i class="bi bi-journal-check me-2"></i>Input Feedback Perkembangan Korban (Psikolog/LBH)
                </div>
                <div class="card-body p-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Role Pengisi</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="roleMitra" id="role1" checked>
                                    <label class="form-check-label" for="role1">Psikolog Kampus</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="roleMitra" id="role2">
                                    <label class="form-check-label" for="role2">Advokat / LBH</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Data Rujukan Selesai</label>
                            <select class="form-select">
                                <option>#RJK-2026-01 - Pendampingan Korban #PPKS-2026-001</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Perkembangan Kondisi Korban</label>
                            <textarea class="form-control" rows="4" placeholder="Input perkembangan psikologis atau status pendampingan hukum korban secara berkala..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Simpan Record Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection