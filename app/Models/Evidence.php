<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Evidence extends Model
{
    protected $fillable = ['report_id', 'disk', 'path', 'original_name', 'mime_type', 'size'];

    protected function originalName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decryptString($value) : null,
            set: fn (?string $value) => $value ? Crypt::encryptString($value) : null,
        );
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
