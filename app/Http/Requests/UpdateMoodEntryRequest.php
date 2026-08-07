<?php

namespace App\Http\Requests;

use App\Models\MoodEntry;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMoodEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var MoodEntry|null $moodEntry */
        $moodEntry = $this->route('mood');

        return [
            'mood' => ['required', Rule::in(MoodEntry::MOODS)],
            'reflection' => ['nullable', 'string', 'max:2000'],
            'entry_date' => [
                'required',
                'date',
                'before_or_equal:today',
                Rule::unique('mood_entries', 'entry_date')
                    ->where(fn ($query) => $query->where('user_id', $this->user()->id))
                    ->ignore($moodEntry?->id),
            ],
        ];
    }
}