<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMoodEntryRequest;
use App\Http\Requests\UpdateMoodEntryRequest;
use App\Models\MoodEntry;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MoodEntryController extends Controller
{
    /**
     * Display the user's mood history.
     */
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'month' => ['nullable', 'date_format:Y-m'],
        ]);

        $moodMeta = [
            'happy' => ['label' => 'Happy', 'color' => '#10b981'],
            'calm' => ['label' => 'Calm', 'color' => '#06b6d4'],
            'excited' => ['label' => 'Excited', 'color' => '#f59e0b'],
            'tired' => ['label' => 'Tired', 'color' => '#64748b'],
            'sad' => ['label' => 'Sad', 'color' => '#3b82f6'],
            'anxious' => ['label' => 'Anxious', 'color' => '#8b5cf6'],
            'stressed' => ['label' => 'Stressed', 'color' => '#ef4444'],
        ];

        $baseQuery = MoodEntry::query()
            ->whereBelongsTo($request->user())
            ->when(
                filled($filters['month'] ?? null),
                function ($query) use ($filters) {
                    $month = Carbon::createFromFormat('Y-m', $filters['month'])->startOfMonth();

                    $query->whereBetween('entry_date', [
                        $month->copy()->toDateString(),
                        $month->copy()->endOfMonth()->toDateString(),
                    ]);
                }
            );

        $moods = (clone $baseQuery)
            ->orderByDesc('entry_date')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalEntries = (clone $baseQuery)->count();

        $distributionRaw = (clone $baseQuery)
            ->select('mood', DB::raw('COUNT(*) as total'))
            ->groupBy('mood')
            ->pluck('total', 'mood');

        $maxDistribution = max([1, ...$distributionRaw->values()->all()]);

        $distribution = collect(MoodEntry::MOODS)->map(function (string $mood) use ($distributionRaw, $moodMeta, $maxDistribution) {
            $count = (int) ($distributionRaw[$mood] ?? 0);

            return [
                'mood' => $mood,
                'label' => $moodMeta[$mood]['label'],
                'color' => $moodMeta[$mood]['color'],
                'count' => $count,
                'percentage' => (int) round(($count / $maxDistribution) * 100),
            ];
        })->filter(fn (array $item) => $item['count'] > 0)->values();

        $dominantMood = $distribution
            ->sortByDesc('count')
            ->first(fn (array $item) => $item['count'] > 0);

        $today = now()->startOfDay();
        $periodEnd = $today->copy();
        $periodStart = $periodEnd->copy()->subDays(13);

        if (filled($filters['month'] ?? null)) {
            $selectedMonth = Carbon::createFromFormat('Y-m', $filters['month'])->startOfMonth();
            $selectedMonthEnd = $selectedMonth->copy()->endOfMonth();

            if ($periodEnd->greaterThan($selectedMonthEnd)) {
                $periodEnd = $selectedMonthEnd;
            }

            if ($periodStart->lessThan($selectedMonth)) {
                $periodStart = $selectedMonth;
            }
        }

        $recentEntries = MoodEntry::query()
            ->whereBelongsTo($request->user())
            ->whereBetween('entry_date', [$periodStart->toDateString(), $periodEnd->toDateString()])
            ->orderBy('entry_date')
            ->get()
            ->keyBy(fn (MoodEntry $entry) => $entry->entry_date->toDateString());

        $trendDays = collect();

        if ($periodStart->lessThanOrEqualTo($periodEnd)) {
            $cursor = $periodStart->copy();

            while ($cursor->lessThanOrEqualTo($periodEnd)) {
                $entry = $recentEntries->get($cursor->toDateString());

                $trendDays->push([
                    'date_label' => $cursor->format('d M'),
                    'short_label' => $cursor->format('d'),
                    'mood_label' => $entry
                        ? ($moodMeta[$entry->mood]['label'] ?? str($entry->mood)->headline()->toString())
                        : 'No Entry',
                    'color' => $entry
                        ? ($moodMeta[$entry->mood]['color'] ?? '#94a3b8')
                        : '#e5e7eb',
                    'has_entry' => (bool) $entry,
                ]);

                $cursor->addDay();
            }
        }

        return view('moods.index', [
            'moods' => $moods,
            'moodOptions' => MoodEntry::MOODS,
            'selectedMonth' => $filters['month'] ?? null,
            'totalEntries' => $totalEntries,
            'dominantMood' => $dominantMood,
            'distribution' => $distribution,
            'trendDays' => $trendDays,
            'trendRangeLabel' => $periodStart->lessThanOrEqualTo($periodEnd)
                ? $periodStart->format('d M').' - '.$periodEnd->format('d M Y')
                : null,
        ]);
    }

    /**
     * Show the form for creating a mood entry.
     */
    public function create(): View
    {
        return view('moods.create', [
            'moodEntry' => new MoodEntry(['entry_date' => now()->toDateString()]),
            'moodOptions' => MoodEntry::MOODS,
        ]);
    }

    /**
     * Store a newly created mood entry in storage.
     */
    public function store(StoreMoodEntryRequest $request): RedirectResponse
    {
        $entry = new MoodEntry($request->validated());
        $entry->user()->associate($request->user());
        $entry->save();

        return Redirect::route('moods.index')->with('status', 'mood-created');
    }

    /**
     * Show the form for editing the specified mood entry.
     */
    public function edit(Request $request, MoodEntry $mood): View
    {
        $mood = $this->ownedMood($request, $mood);

        return view('moods.edit', [
            'moodEntry' => $mood,
            'moodOptions' => MoodEntry::MOODS,
        ]);
    }

    /**
     * Update the specified mood entry in storage.
     */
    public function update(UpdateMoodEntryRequest $request, MoodEntry $mood): RedirectResponse
    {
        $mood = $this->ownedMood($request, $mood);

        $mood->fill($request->validated());
        $mood->save();

        return Redirect::route('moods.index')->with('status', 'mood-updated');
    }

    /**
     * Resolve mood ownership for the current user.
     */
    protected function ownedMood(Request $request, MoodEntry $mood): MoodEntry
    {
        abort_if($mood->user_id !== $request->user()->id, 404);

        return $mood;
    }
}