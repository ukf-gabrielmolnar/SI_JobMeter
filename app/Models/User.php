<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Itstructure\LaRbac\Interfaces\RbacUserInterface;
use Itstructure\LaRbac\Traits\Administrable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Study_program;

/**
 * Class App\Models\User
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 */
class User extends Authenticatable implements RbacUserInterface
{
    use HasApiTokens, HasFactory, Notifiable, Administrable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'tel',
        'companies_id',
        'study_programs_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function companyuser(): BelongsTo{
        return $this->belongsTo(Company::class);
    }

    public function study_program(): BelongsTo{
        return $this->belongsTo(Study_program::class);
    }

    public function usercontract(): HasMany{
        return $this->hasMany(Contract::class);
    }

    public function userfeedback_report(): HasMany{
        return $this->hasMany(Feedback_Report::class);
    }
}
