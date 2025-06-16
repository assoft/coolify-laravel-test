<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Branch extends Model
{
    /** @use HasFactory<\Database\Factories\BranchFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "region",
        "address",
        "phone",
        "city",
        "state",
        "company_id"
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'branch_user', 'branch_id', 'user_id')
            ->withPivot('role');
    }
}
