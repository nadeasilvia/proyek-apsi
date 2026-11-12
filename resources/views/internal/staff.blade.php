@extends('layouts.internal')
@section('title','Manajemen Petugas')
@section('heading','Manajemen Petugas')
@section('content')
<div class="card p-4 mb-4">
    <h2 class="h6 fw-bold">Tambah Akun Internal</h2>
    <form method="post" action="{{ route('internal.staff.store') }}">
        @csrf
        <div class="row g-2">
            <div class="col-md-3"><input class="form-control" name="name" placeholder="Nama" required></div>
            <div class="col-md-3"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
            <div class="col-md-2"><select class="form-select" name="role" required><option value="tim_satgas">Tim Satgas</option><option value="psikolog">Psikolog</option><option value="pimpinan">Pimpinan</option></select></div>
            <div class="col-md-2"><select class="form-select" name="gender"><option value="">Gender petugas (opsional)</option><option value="perempuan">Perempuan</option><option value="laki_laki">Laki-laki</option></select></div>
            <div class="col-md-2"><input class="form-control" type="password" name="password" placeholder="Kata sandi min. 12" minlength="12" required></div>
            <div class="col-md-2"><input class="form-control" type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required></div>
            <div class="col-12"><button class="btn btn-sm btn-success">Buat akun</button></div>
        </div>
    </form>
    <p class="small muted mt-3 mb-0">Akun Ketua Satgas tidak dapat dibuat atau ditetapkan melalui halaman ini.</p>
</div>
<div class="card"><div class="table-responsive"><table class="table align-middle mb-0">
    <thead class="table-light"><tr><th>Nama</th><th>Email</th><th>Role</th><th>Gender pemeriksa</th><th>Status</th><th>Simpan Perubahan</th></tr></thead>
    <tbody>
    @forelse($users as $managedUser)
        @php($formId='staff-update-'.$managedUser->id)
        <tr>
            <td><form id="{{ $formId }}" method="post" action="{{ route('internal.staff.update',$managedUser) }}">@csrf @method('PATCH')</form><input form="{{ $formId }}" class="form-control form-control-sm" name="name" value="{{ $managedUser->name }}" required></td>
            <td><input form="{{ $formId }}" class="form-control form-control-sm" type="email" name="email" value="{{ $managedUser->email }}" required></td>
            <td><select form="{{ $formId }}" class="form-select form-select-sm" name="role">@foreach(['tim_satgas'=>'Tim Satgas','psikolog'=>'Psikolog','pimpinan'=>'Pimpinan'] as $roleValue=>$roleLabel)<option value="{{ $roleValue }}" @selected($managedUser->role===$roleValue)>{{ $roleLabel }}</option>@endforeach</select></td>
            <td><select form="{{ $formId }}" class="form-select form-select-sm" name="gender"><option value="">Belum ditentukan</option><option value="perempuan" @selected($managedUser->gender==='perempuan')>Perempuan</option><option value="laki_laki" @selected($managedUser->gender==='laki_laki')>Laki-laki</option></select></td>
            <td><select form="{{ $formId }}" class="form-select form-select-sm" name="is_active"><option value="1" @selected($managedUser->is_active)>Aktif</option><option value="0" @selected(!$managedUser->is_active)>Nonaktif</option></select></td>
            <td><input form="{{ $formId }}" class="form-control form-control-sm mb-1" type="password" name="password" placeholder="Password baru (opsional)"><input form="{{ $formId }}" type="password" class="form-control form-control-sm mb-1" name="password_confirmation" placeholder="Ulangi password"><button form="{{ $formId }}" class="btn btn-sm btn-outline-primary">Simpan</button></td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center py-4 muted">Belum ada akun petugas yang dikelola.</td></tr>
    @endforelse
    </tbody>
</table></div><div class="p-3">{{ $users->links() }}</div></div>
@endsection
