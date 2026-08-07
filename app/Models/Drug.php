<?php

namespace App\Models;

use Database\Factories\DrugFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'generic_name',
    'description',
    'indication',
    'dosage',
    'route',
    'contraindication',
    'side_effects',
])]
class Drug extends Model
{
    /** @use HasFactory<DrugFactory> */
    use HasFactory;

    /**
     * Get all aliases for this drug.
     */
    public function aliases(): HasMany
    {
        return $this->hasMany(DrugAlias::class);
    }

    /**
     * Get all community votes for this drug.
     */
    public function votes(): HasMany
    {
        return $this->hasMany(DrugVote::class);
    }
}
