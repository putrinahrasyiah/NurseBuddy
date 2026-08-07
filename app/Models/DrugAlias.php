<?php

namespace App\Models;

use Database\Factories\DrugAliasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'drug_id',
    'alias',
])]
class DrugAlias extends Model
{
    /** @use HasFactory<DrugAliasFactory> */
    use HasFactory;

    /**
     * Get the drug for this alias.
     */
    public function drug(): BelongsTo
    {
        return $this->belongsTo(Drug::class);
    }
}
