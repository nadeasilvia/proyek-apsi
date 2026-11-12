<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'report_id', 'action', 'reason', 'ip_address', 'created_at'];

    protected function casts(): array
    {
        return ['created_at' => 'datetime'];
    }

    protected function reason(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decryptString($value) : null,
            set: fn (?string $value) => $value ? Crypt::encryptString($value) : null,
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
