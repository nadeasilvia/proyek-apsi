@extends('layouts.internal')
@section('title','Riwayat Monitoring')
@section('heading','Riwayat Monitoring')
@section('content')<div class="card"><div class="table-responsive"><table class="table align-middle mb-0"><thead class="table-light"><tr><th>Waktu</th><th>Nomor Tiket</th><th>Tahapan</th><th>Petugas</th></tr></thead><tbody>@forelse($events as $event)<tr><td>{{ $event->created_at }}</td><td>{{ $event->ticket_number }}</td><td>{{ str_replace('_',' ',$event->to_status) }}</td><td>{{ $event->actor ?? 'Sistem' }}</td></tr>@empty<tr><td colspan="4" class="text-center py-4">Belum ada riwayat monitoring.</td></tr>@endforelse</tbody></table></div><div class="p-3">{{ $events->links() }}</div></div>@endsection
