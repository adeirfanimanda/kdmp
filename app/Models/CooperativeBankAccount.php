<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CooperativeBankAccount extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cooperative_id',
        'bank_name',
        'account_number',
        'account_holder_name',
        'is_active',
        'is_primary',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_primary' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the cooperative that owns the bank account.
     */
    public function cooperative(): BelongsTo
    {
        return $this->belongsTo(Cooperative::class);
    }
}
