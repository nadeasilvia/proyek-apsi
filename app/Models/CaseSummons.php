<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseSummons extends Model
{
    protected $fillable = ['report_id', 'created_by', 'sequence', 'target_name', 'target_role', 'scheduled_at', 'location', 'status', 'delivered_at', 'notes'];

    protected function casts(): array
    {
        return ['scheduled_at' => 'datetime', 'delivered_at' => 'datetime'];
    }

    public function report() { return $this->belongsTo(Report::class); }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
}
