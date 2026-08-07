<?php

namespace App\Models;

use Database\Factories\StudyMaterialProgressFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'study_material_id',
    'status',
])]
class StudyMaterialProgress extends Model
{
    /** @use HasFactory<StudyMaterialProgressFactory> */
    use HasFactory;

    protected $table = 'study_material_progresses';

    public const STATUSES = ['pending', 'done'];

    /**
     * Get the user who owns this progress record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the material linked to this progress record.
     */
    public function studyMaterial(): BelongsTo
    {
        return $this->belongsTo(StudyMaterial::class);
    }
}
