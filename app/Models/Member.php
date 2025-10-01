<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cooperative_id',
        'user_id',
        'member_number',
        'nik',
        'full_name',
        'birth_place',
        'birth_date',
        'gender',
        'address',
        'phone',
        'occupation',
        'education',
        'monthly_income',
        'emergency_contact_name',
        'emergency_contact_phone',
        'membership_status',
        'join_date',
        'resign_date',
        'profile_photo',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'join_date' => 'date',
        'resign_date' => 'date',
        'monthly_income' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the cooperative that owns the member.
     */
    public function cooperative(): BelongsTo
    {
        return $this->belongsTo(Cooperative::class);
    }

    /**
     * Get the user associated with the member.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the documents for the member.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(MemberDocument::class);
    }

    /**
     * Get the bank accounts for the member.
     */
    public function bankAccounts(): HasMany
    {
        return $this->hasMany(MemberBankAccount::class);
    }

    /**
     * Get the saving accounts for the member.
     */
    public function savingAccounts(): HasMany
    {
        return $this->hasMany(SavingAccount::class);
    }

    /**
     * Get the saving obligations for the member.
     */
    public function savingObligations(): HasMany
    {
        return $this->hasMany(SavingObligation::class);
    }

    /**
     * Get the saving withdrawals for the member.
     */
    public function savingWithdrawals(): HasMany
    {
        return $this->hasMany(SavingWithdrawal::class);
    }
}
