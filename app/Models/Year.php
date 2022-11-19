<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Year extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
    ];

    public function useryear(): HasMany{
        return $this->hasMany(User::class);
    }

    public function yearstudy_program(): BelongsTo{
        return $this->belongsTo(Study_program::class);
    }
}
