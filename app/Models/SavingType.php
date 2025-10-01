<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SavingType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cooperative_id',
        'name',
        'code',
        'minimum_amount',
        'is_mandatory',
        'is_withdrawable',
        'is_auto_generate_monthly',
        'monthly_due_date',
        'description',
        'is_active',
    ];

    protected $casts = [
        'minimum_amount' => 'decimal:2',
        'is_mandatory' => 'boolean',
        'is_withdrawable' => 'boolean',
        'is_auto_generate_monthly' => 'boolean',
        'monthly_due_date' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the cooperative that owns the saving type.
     */
    public function cooperative(): BelongsTo
    {
        return $this->belongsTo(Cooperative::class);
    }

    /**
     * Get the saving accounts for the saving type.
     */
    public function savingAccounts(): HasMany
    {
        return $this->hasMany(SavingAccount::class);
    }

    /**
     * Get the saving obligations for the saving type.
     */
    public function savingObligations(): HasMany
    {
        return $this->hasMany(SavingObligation::class);
    }
}
