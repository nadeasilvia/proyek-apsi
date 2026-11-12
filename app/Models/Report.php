<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Report extends Model
{
    protected $fillable = [
        'ticket_number', 'reporter_type', 'reporter_data', 'incident_type',
        'incident_date', 'incident_time', 'incident_location', 'incident_story',
        'expectation', 'status', 'assigned_user_id', 'requires_follow_up', 'referred_at', 'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'incident_date' => 'date',
            'referred_at' => 'datetime',
            'resolved_at' => 'datetime',
            'requires_follow_up' => 'boolean',
        ];
    }

    public function setReporterDataAttribute(array $data): void
    {
        $this->attributes['reporter_data'] = Crypt::encryptString(json_encode($data, JSON_THROW_ON_ERROR));
    }

    public function getReporterDataAttribute(?string $value): array
    {
        return $value ? json_decode(Crypt::decryptString($value), true, 512, JSON_THROW_ON_ERROR) : [];
    }

    public function setIncidentStoryAttribute(?string $value): void
    {
        $this->attributes['incident_story'] = $value === null ? null : Crypt::encryptString($value);
    }

    public function getIncidentStoryAttribute(?string $value): ?string
    {
        return $value === null ? null : Crypt::decryptString($value);
    }

    public function setIncidentLocationAttribute(?string $value): void
    {
        $this->attributes['incident_location'] = $value === null ? null : Crypt::encryptString($value);
    }

    public function getIncidentLocationAttribute(?string $value): ?string
    {
        return $value === null ? null : Crypt::decryptString($value);
    }

    public function setExpectationAttribute(?string $value): void
    {
        $this->attributes['expectation'] = $value === null ? null : Crypt::encryptString($value);
    }

    public function getExpectationAttribute(?string $value): ?string
    {
        return $value === null ? null : Crypt::decryptString($value);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function statusHistories()
    {
        return $this->hasMany(ReportStatusHistory::class)->latest();
    }

    public function assignments()
    {
        return $this->hasMany(CaseAssignment::class);
    }

    public function evidence()
    {
        return $this->hasMany(Evidence::class);
    }
}
