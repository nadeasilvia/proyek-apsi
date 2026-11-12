@extends('layouts.internal')
@section('title','Unmasking Data')
@section('heading','Unmasking Data')
@section('content')
<div class="alert alert-warning"><i class="bi bi-shield-lock me-2"></i>Identitas pelapor tetap tersamar di daftar ini. Buka detail kasus untuk mengajukan pembukaan identitas; alasan wajib dicatat dalam Audit Log.</div><div class="card"><div class="table-responsive"><table class="table align-middle mb-0"><thead class="table-light"><tr><th>Nomor tiket</th><th>Kategori</th><th>Status</th><th>Tanggal masuk</th><th>Aksi</th></tr></thead><tbody>@forelse($reports as $report)<tr><td class="fw-semibold">{{ $report->ticket_number }}</td><td>{{ str_replace('_',' ',$report->incident_type) }}</td><td>{{ str_replace('_',' ',$report->status) }}</td><td>{{ $report->created_at->format('d M Y') }}</td><td><a class="btn btn-sm btn-outline-danger" href="{{ route('internal.case.show',$report->id) }}"><i class="bi bi-person-vcard me-1"></i>Tinjau & unmask</a></td></tr>@empty<tr><td colspan="5" class="text-center muted py-4">Belum ada kasus.</td></tr>@endforelse</tbody></table></div><div class="p-3">{{ $reports->links() }}</div></div>
@endsection
