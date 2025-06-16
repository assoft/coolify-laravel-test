<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'tax_id',
        'address',
        'phone',
        'user_id'
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function branches(): HasMany {
        return $this->hasMany(\App\Models\Branch::class);
    }

    public function users(): HasMany {
        return $this->hasMany(\App\Models\User::class)
            ->whereNotNull('company_id'); // Owner'ı hariç tutar
    }
}
