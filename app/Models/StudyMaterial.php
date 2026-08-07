<?php

namespace App\Models;

use Database\Factories\StudyMaterialFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'category_id',
    'title',
    'description',
    'resource_type',
    'resource_url',
    'thumbnail',
])]
class StudyMaterial extends Model
{
    /** @use HasFactory<StudyMaterialFactory> */
    use HasFactory;

    public const RESOURCE_TYPES = ['pdf', 'image', 'youtube', 'website', 'quizlet'];

    /**
     * Get the category for this material.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(StudyCategory::class, 'category_id');
    }

    /**
     * Get all user progress entries for this material.
     */
    public function progresses(): HasMany
    {
        return $this->hasMany(StudyMaterialProgress::class);
    }
}
