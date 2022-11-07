<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback_Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'text',
        'contracts_id',
        'users_id',
    ];

    public function userfeedback_report(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function contractfeedback_report(): BelongsTo{
        return $this->belongsTo(Contract::class);
    }
}
