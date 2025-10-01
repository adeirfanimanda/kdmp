<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cooperative extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'village_id',
        'legal_number',
        'name',
        'address',
        'phone',
        'email',
        'established_date',
        'logo',
        'status',
    ];

    protected $casts = [
        'established_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the village that owns the cooperative.
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * Get the bank accounts for the cooperative.
     */
    public function bankAccounts(): HasMany
    {
        return $this->hasMany(CooperativeBankAccount::class);
    }

    /**
     * Get the users for the cooperative.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the members for the cooperative.
     */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Get the saving types for the cooperative.
     */
    public function savingTypes(): HasMany
    {
        return $this->hasMany(SavingType::class);
    }

    /**
     * Get the payment methods for the cooperative.
     */
    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }
}
