<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StaffManagementController extends Controller
{
    private const MANAGED_ROLES = ['tim_satgas', 'psikolog', 'pimpinan'];

    public function index(Request $request)
    {
        abort_unless($request->user()->hasRole('ketua_satgas'), 403);
        $users = User::whereIn('role', self::MANAGED_ROLES)->orderBy('role')->orderBy('name')->paginate(25);

        return view('internal.staff', compact('users'));
    }

    public function store(Request $request)
    {
        abort_unless($request->user()->hasRole('ketua_satgas'), 403);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email'],
            'role' => ['required', Rule::in(self::MANAGED_ROLES)],
            'gender' => ['nullable', Rule::in(['perempuan', 'laki_laki'])],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = $validator->validated();
        $user = DB::transaction(function () use ($data, $request) {
            $user = User::create(['name' => $data['name'], 'email' => $data['email'], 'role' => $data['role'], 'gender' => $data['gender'] ?? null, 'password' => $data['password'], 'is_active' => true]);
            AuditLog::create(['user_id' => $request->user()->id, 'action' => 'staff_account_created', 'reason' => 'Akun internal ID '.$user->id.' dengan role '.$user->role.' dibuat.', 'ip_address' => $request->ip(), 'created_at' => now()]);

            return $user;
        });

        return back()->with('success', 'Akun internal '.$user->role.' dibuat.');
    }

    public function update(Request $request, User $managedUser)
    {
        abort_unless($request->user()->hasRole('ketua_satgas'), 403);
        abort_unless(in_array($managedUser->role, self::MANAGED_ROLES, true), 404);
        abort_if($managedUser->is($request->user()), 403);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:190', Rule::unique('users', 'email')->ignore($managedUser->id)],
            'role' => ['required', Rule::in(self::MANAGED_ROLES)],
            'gender' => ['nullable', Rule::in(['perempuan', 'laki_laki'])],
            'is_active' => ['required', 'boolean'],
            'password' => ['nullable', 'string', 'min:12', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = $validator->validated();
        DB::transaction(function () use ($data, $managedUser, $request) {
            $managedUser->fill(['name' => $data['name'], 'email' => $data['email'], 'role' => $data['role'], 'gender' => $data['gender'] ?? null, 'is_active' => (bool) $data['is_active']]);
            if (! empty($data['password'])) {
                $managedUser->password = $data['password'];
            }
            $managedUser->save();
            AuditLog::create(['user_id' => $request->user()->id, 'action' => 'staff_account_updated', 'reason' => 'Akun internal ID '.$managedUser->id.' diperbarui.', 'ip_address' => $request->ip(), 'created_at' => now()]);
        });

        return back()->with('success', 'Akun internal diperbarui.');
    }
}
