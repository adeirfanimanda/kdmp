<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingWithdrawal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'member_id',
        'saving_account_id',
        'amount',
        'reason',
        'member_bank_account_id',
        'status',
        'request_date',
        'approval_date',
        'approved_by',
        'approval_notes',
        'disbursement_date',
        'disbursed_by',
        'disbursement_method',
        'bank_reference_number',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'request_date' => 'date',
        'approval_date' => 'date',
        'disbursement_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the member that owns the saving withdrawal.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get the saving account that owns the saving withdrawal.
     */
    public function savingAccount(): BelongsTo
    {
        return $this->belongsTo(SavingAccount::class);
    }

    /**
     * Get the member bank account that owns the saving withdrawal.
     */
    public function memberBankAccount(): BelongsTo
    {
        return $this->belongsTo(MemberBankAccount::class);
    }

    /**
     * Get the user that approved the saving withdrawal.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the user that disbursed the saving withdrawal.
     */
    public function disbursedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'disbursed_by');
    }
}
