<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_type',
        'companies_id',
        'study_programs_id',
    ];

    public function companyjob(): BelongsTo{
        return $this->belongsTo(Company::class);
    }

    public function study_programjob(): BelongsTo{
        return $this->belongsTo(Study_program::class);
    }

    public function jobcontract(): HasMany{
        return $this->hasMany(Contract::class);
    }
}