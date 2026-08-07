<?php

namespace App\Models;

use Database\Factories\DrugVoteFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'drug_id',
    'vote',
])]
class DrugVote extends Model
{
    /** @use HasFactory<DrugVoteFactory> */
    use HasFactory;

    public const VOTE_UP = 1;

    public const VOTE_DOWN = -1;

    public const VOTES = [
        self::VOTE_UP,
        self::VOTE_DOWN,
    ];

    /**
     * Get the user who cast this vote.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the drug for this vote.
     */
    public function drug(): BelongsTo
    {
        return $this->belongsTo(Drug::class);
    }
}
