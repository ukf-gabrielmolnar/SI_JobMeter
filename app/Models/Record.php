<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'hours',
        'approved',
        'contracts_id',
    ];

    public function contractrecord(): BelongsTo{
        return $this->belongsTo(Contract::class);
    }
}
