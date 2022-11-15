<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Study_program extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'study_program',
    ];


    public function study_programyear(): HasMany{
        return $this->hasMany(Year::class);
    }

    public function study_programjob(): HasMany{
        return $this->hasMany(Job::class);
    }
}
