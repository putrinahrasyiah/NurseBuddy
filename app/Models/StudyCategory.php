<?php

namespace App\Models;

use Database\Factories\StudyCategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'description',
])]
class StudyCategory extends Model
{
    /** @use HasFactory<StudyCategoryFactory> */
    use HasFactory;

    /**
     * Get all materials in this category.
     */
    public function studyMaterials(): HasMany
    {
        return $this->hasMany(StudyMaterial::class, 'category_id');
    }
}
