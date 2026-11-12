@extends('layouts.internal')
@section('title','Audit Log')
@section('heading','Audit Log')
@section('content')<div class="card"><div class="table-responsive"><table class="table align-middle mb-0"><thead class="table-light"><tr><th>Waktu</th><th>Pengguna</th><th>Aktivitas</th><th>Nomor Tiket</th><th>Alasan</th></tr></thead><tbody>@forelse($logs as $log)<tr><td>{{ $log->created_at }}</td><td>{{ $log->user?->name ?? 'Sistem' }}</td><td>{{ $log->action }}</td><td>{{ $log->report?->ticket_number ?? '—' }}</td><td>{{ $log->reason }}</td></tr>@empty<tr><td colspan="5" class="text-center py-4">Belum ada catatan audit.</td></tr>@endforelse</tbody></table></div><div class="p-3">{{ $logs->links() }}</div></div>@endsection
