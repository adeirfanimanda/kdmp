<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SavingObligation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'member_id',
        'saving_type_id',
        'period_year',
        'period_month',
        'obligated_amount',
        'paid_amount',
        'remaining_amount',
        'status',
        'paid_off_date',
    ];

    protected $casts = [
        'period_year' => 'integer',
        'period_month' => 'integer',
        'obligated_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'paid_off_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the member that owns the saving obligation.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get the saving type that owns the saving obligation.
     */
    public function savingType(): BelongsTo
    {
        return $this->belongsTo(SavingType::class);
    }

    /**
     * Get the saving transactions for the saving obligation.
     */
    public function savingTransactions(): HasMany
    {
        return $this->hasMany(SavingTransaction::class);
    }
}
