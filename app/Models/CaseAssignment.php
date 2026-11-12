<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseAssignment extends Model
{
    protected $fillable = ['report_id', 'user_id', 'assigned_by', 'kind'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
