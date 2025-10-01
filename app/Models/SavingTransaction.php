<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'saving_account_id',
        'saving_obligation_id',
        'processed_by',
        'transaction_type',
        'amount',
        'balance_before',
        'balance_after',
        'payment_method_id',
        'transfer_proof',
        'cooperative_bank_account_id',
        'member_bank_account_id',
        'confirmation_status',
        'description',
        'reference_number',
        'transaction_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'transaction_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the saving account that owns the transaction.
     */
    public function savingAccount(): BelongsTo
    {
        return $this->belongsTo(SavingAccount::class);
    }

    /**
     * Get the saving obligation that owns the transaction.
     */
    public function savingObligation(): BelongsTo
    {
        return $this->belongsTo(SavingObligation::class);
    }

    /**
     * Get the user that processed the transaction.
     */
    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Get the payment method that owns the transaction.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the cooperative bank account that owns the transaction.
     */
    public function cooperativeBankAccount(): BelongsTo
    {
        return $this->belongsTo(CooperativeBankAccount::class);
    }

    /**
     * Get the member bank account that owns the transaction.
     */
    public function memberBankAccount(): BelongsTo
    {
        return $this->belongsTo(MemberBankAccount::class);
    }
}
