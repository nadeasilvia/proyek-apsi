<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternalAuthController extends Controller
{
    public function create()
    {
        if (auth()->check() && auth()->user()->is_active && auth()->user()->role) {
            return redirect()->route('internal.dashboard');
        }

        return view('auth.internal-login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'role' => ['nullable', 'in:tim_satgas,ketua_satgas,psikolog,pimpinan'],
        ]);
        $role = $credentials['role'] ?? null;
        unset($credentials['role']);
        if (! Auth::attempt($credentials + ($role ? ['role' => $role] : []), $request->boolean('remember')) || ! Auth::user()->is_active || ! Auth::user()->role) {
            AuditLog::create(['user_id' => Auth::id(), 'action' => 'login_denied', 'ip_address' => $request->ip(), 'created_at' => now()]);
            Auth::logout();

            return back()->withErrors(['email' => 'Akun internal tidak ditemukan atau tidak aktif.'])->onlyInput('email');
        }
        $request->session()->regenerate();
        AuditLog::create(['user_id' => Auth::id(), 'action' => 'login_succeeded', 'ip_address' => $request->ip(), 'created_at' => now()]);

        return redirect()->route('internal.dashboard');
    }

    public function destroy(Request $request)
    {
        AuditLog::create(['user_id' => $request->user()->id, 'action' => 'logout', 'ip_address' => $request->ip(), 'created_at' => now()]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('internal.login');
    }
}
