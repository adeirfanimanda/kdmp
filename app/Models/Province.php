<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the regencies for the province.
     */
    public function regencies(): HasMany
    {
        return $this->hasMany(Regency::class);
    }
}
