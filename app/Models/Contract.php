<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'jobs_id',
        'contact_id',
        'od',
        'do',
        'approved',
        'closed',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function job(): BelongsTo{
        return $this->belongsTo(Job::class);
    }

    public function contactcontract(): BelongsTo{
        return $this->belongsTo(Contact::class);
    }

    public function contractstudent_feedback(): HasMany{
        return $this->hasMany(Student_feedback::class);
    }

    public function contractrecord(): HasMany{
        return $this->hasMany(Record::class);
    }

    public function contractfeedback_report(): HasMany{
        return $this->hasMany(Feedback_Report::class);
    }
}
