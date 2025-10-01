<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cooperative_id',
        'name',
        'code',
        'type',
        'description',
        'account_details',
        'is_active',
        'requires_proof',
        'display_order',
        'icon',
    ];

    protected $casts = [
        'account_details' => 'array',
        'is_active' => 'boolean',
        'requires_proof' => 'boolean',
        'display_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the cooperative that owns the payment method.
     */
    public function cooperative(): BelongsTo
    {
        return $this->belongsTo(Cooperative::class);
    }

    /**
     * Get the saving transactions for the payment method.
     */
    public function savingTransactions(): HasMany
    {
        return $this->hasMany(SavingTransaction::class);
    }
}
