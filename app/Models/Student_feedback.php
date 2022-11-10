<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student_feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'text',
        'contracts_id',
    ];

    public function contractstudent_feedback(): BelongsTo{
        return $this->belongsTo(Contract::class);
    }
}
