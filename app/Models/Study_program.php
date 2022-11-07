<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Study_program extends Model
{
    use HasFactory;
    protected $fillable = [
        'study_program',
        'year',
    ];

    public function study_programjob(): HasMany{
        return $this->hasMany(Job::class);
    }

    public function study_programuser(): HasMany{
        return $this->hasMany(User::class);
    }
}
