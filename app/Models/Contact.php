<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'e-mail',
        'tel',
        'companies_id',
    ];

    public function companycontact(): BelongsTo{
        return $this->belongsTo(Company::class);
    }

    public function contactContract(): HasMany{
        return $this->hasMany(Contract::class);
    }
}
