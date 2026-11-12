<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class CounselingSession extends Model
{
    protected $fillable = ['report_id', 'psychologist_id', 'scheduled_at', 'session_type', 'status', 'private_note', 'follow_up'];

    protected function casts(): array
    {
        return ['scheduled_at' => 'datetime'];
    }

    public function setPrivateNoteAttribute(?string $value): void
    {
        $this->attributes['private_note'] = $value === null ? null : Crypt::encryptString($value);
    }

    public function getPrivateNoteAttribute(?string $value): ?string
    {
        return $value === null ? null : Crypt::decryptString($value);
    }

    public function setFollowUpAttribute(?string $value): void
    {
        $this->attributes['follow_up'] = $value === null ? null : Crypt::encryptString($value);
    }

    public function getFollowUpAttribute(?string $value): ?string
    {
        return $value === null ? null : Crypt::decryptString($value);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function psychologist()
    {
        return $this->belongsTo(User::class, 'psychologist_id');
    }
}
