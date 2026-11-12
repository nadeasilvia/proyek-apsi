<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class InternalRoleAccountSeeder extends Seeder
{
    public function run(): void
    {
        if (! filter_var(env('SEED_INTERNAL_USERS', false), FILTER_VALIDATE_BOOL)) {
            return;
        }

        foreach (['tim_satgas', 'ketua_satgas', 'psikolog', 'pimpinan'] as $role) {
            $key = strtoupper($role);
            $email = env('INTERNAL_'.$key.'_EMAIL');
            $password = env('INTERNAL_'.$key.'_PASSWORD');
            if (! $email || ! $password) {
                continue;
            }
            User::updateOrCreate(['email' => $email], [
                'name' => env('INTERNAL_'.$key.'_NAME', ucfirst(str_replace('_', ' ', $role))),
                'password' => $password,
                'role' => $role,
                'is_active' => true,
            ]);
        }
    }
}
