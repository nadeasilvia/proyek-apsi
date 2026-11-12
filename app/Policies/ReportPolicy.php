<?php

namespace App\Policies;

use App\Models\CaseAssignment;
use App\Models\Report;
use App\Models\User;

class ReportPolicy
{
    public function view(User $user, Report $report): bool
    {
        if (! $user->is_active) {
            return false;
        }
        if ($user->role === 'ketua_satgas') {
            return true;
        }
        if ($user->role === 'tim_satgas') {
            return $report->assigned_user_id === null || $report->assigned_user_id === $user->id;
        }
        if ($user->role === 'psikolog') {
            return CaseAssignment::where('report_id', $report->id)->where('user_id', $user->id)->where('kind', 'psikolog')->exists();
        }

        return false;
    }

    public function update(User $user, Report $report): bool
    {
        return $user->is_active && ($user->role === 'ketua_satgas' || ($user->role === 'tim_satgas' && ($report->assigned_user_id === null || $report->assigned_user_id === $user->id)));
    }

    public function unmask(User $user, Report $report): bool
    {
        return $user->hasRole('ketua_satgas');
    }
}
