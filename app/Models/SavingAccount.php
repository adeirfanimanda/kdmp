<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SavingAccount extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'member_id',
        'saving_type_id',
        'account_number',
        'balance',
        'total_deposits',
        'total_withdrawals',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'total_deposits' => 'decimal:2',
        'total_withdrawals' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the member that owns the saving account.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get the saving type that owns the saving account.
     */
    public function savingType(): BelongsTo
    {
        return $this->belongsTo(SavingType::class);
    }

    /**
     * Get the saving transactions for the saving account.
     */
    public function savingTransactions(): HasMany
    {
        return $this->hasMany(SavingTransaction::class);
    }

    /**
     * Get the saving withdrawals for the saving account.
     */
    public function savingWithdrawals(): HasMany
    {
        return $this->hasMany(SavingWithdrawal::class);
    }
}
