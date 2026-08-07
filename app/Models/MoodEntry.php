<?php

namespace App\Models;

use Database\Factories\MoodEntryFactory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'mood',
    'reflection',
    'entry_date',
])]
class MoodEntry extends Model
{
    /** @use HasFactory<MoodEntryFactory> */
    use HasFactory;

    public const MOODS = [
        'happy',
        'calm',
        'excited',
        'tired',
        'sad',
        'anxious',
        'stressed',
    ];

    /**
     * Get the user that owns the mood entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Normalize entry date to date-only format for unique-per-day behavior.
     */
    public function setEntryDateAttribute(string $value): void
    {
        $this->attributes['entry_date'] = Carbon::parse($value)->toDateString();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'entry_date' => 'date',
        ];
    }
}