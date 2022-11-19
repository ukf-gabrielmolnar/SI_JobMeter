<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'text',
        'contracts_id',
        'users_id',
    ];

    public function contractfeedbackreport(): BelongsTo{
        return $this->belongsTo(Contract::class);
    }

    public function userfeedbackreport(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
