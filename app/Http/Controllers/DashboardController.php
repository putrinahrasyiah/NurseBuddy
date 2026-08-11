<?php

namespace App\Http\Controllers;

use App\Models\MoodEntry;
use App\Models\Note;
use App\Models\StudyMaterial;
use App\Models\StudyMaterialProgress;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the integrated dashboard for the authenticated user.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $today = now()->toDateString();

        $taskBaseQuery = Task::query()->whereBelongsTo($user);

        $todayTasks = (clone $taskBaseQuery)
            ->whereDate('deadline', $today)
            ->where('status', '!=', 'done')
            ->orderByRaw("CASE WHEN is_urgent = 1 THEN 0 ELSE 1 END")
            ->orderByRaw("CASE priority WHEN 'high' THEN 0 WHEN 'medium' THEN 1 ELSE 2 END")
            ->latest()
            ->limit(5)
            ->get();

        $taskSummary = [
            'total' => (clone $taskBaseQuery)->count(),
            'pending' => (clone $taskBaseQuery)->where('status', 'pending')->count(),
            'in_progress' => (clone $taskBaseQuery)->where('status', 'in_progress')->count(),
            'done' => (clone $taskBaseQuery)->where('status', 'done')->count(),
            'due_today' => (clone $taskBaseQuery)->whereDate('deadline', $today)->where('status', '!=', 'done')->count(),
            'overdue' => (clone $taskBaseQuery)->whereDate('deadline', '<', $today)->where('status', '!=', 'done')->count(),
        ];

        $latestMood = MoodEntry::query()
            ->whereBelongsTo($user)
            ->orderByDesc('entry_date')
            ->latest()
            ->first();

        $todayMood = MoodEntry::query()
            ->whereBelongsTo($user)
            ->whereDate('entry_date', $today)
            ->first();

        $dominantMood = MoodEntry::query()
            ->whereBelongsTo($user)
            ->whereDate('entry_date', '>=', now()->subDays(29)->toDateString())
            ->select('mood', DB::raw('COUNT(*) as total'))
            ->groupBy('mood')
            ->orderByDesc('total')
            ->first();

        $totalStudyMaterials = StudyMaterial::query()->count();
        $studyDoneCount = StudyMaterialProgress::query()
            ->whereBelongsTo($user)
            ->where('status', 'done')
            ->count();

        $studyStartedCount = StudyMaterialProgress::query()
            ->whereBelongsTo($user)
            ->count();

        $studyCompletionRate = $totalStudyMaterials > 0
            ? (int) round(($studyDoneCount / $totalStudyMaterials) * 100)
            : 0;

        $recentNotes = Note::query()
            ->whereBelongsTo($user)
            ->orderByDesc('is_pinned')
            ->latest()
            ->limit(5)
            ->get();

        $quickAccess = [
            [
                'title' => 'Tasks',
                'description' => 'Manage deadlines and priority.',
                'route' => route('tasks.index'),
                'metric' => $taskSummary['due_today'].' due today',
            ],
            [
                'title' => 'Study Library',
                'description' => 'Continue your pending materials.',
                'route' => route('study-library.index'),
                'metric' => max(0, $totalStudyMaterials - $studyDoneCount).' remaining',
            ],
            [
                'title' => 'Mood Tracker',
                'description' => 'Record your daily check-in.',
                'route' => route('moods.index'),
                'metric' => $todayMood ? 'today logged' : 'not checked in',
            ],
            [
                'title' => 'Notes',
                'description' => 'Keep learning highlights organized.',
                'route' => route('notes.index'),
                'metric' => $recentNotes->count().' recent',
            ],
            [
                'title' => 'Obatpedia',
                'description' => 'Review verified medication details.',
                'route' => route('obatpedia.index'),
                'metric' => 'drug knowledge base',
            ],
        ];

        $dailyConsistencyPoints = 0;
        $dailyConsistencyPoints += $taskSummary['due_today'] === 0 ? 1 : 0;
        $dailyConsistencyPoints += $todayMood ? 1 : 0;
        $dailyConsistencyPoints += $studyDoneCount > 0 ? 1 : 0;

        $rewardTreeStage = match (true) {
            $studyCompletionRate >= 85 && $dailyConsistencyPoints === 3 => 'Flourishing',
            $studyCompletionRate >= 60 => 'Growing',
            $studyCompletionRate >= 30 => 'Sprout',
            default => 'Seed',
        };

        $greeting = $this->resolveGreeting();

        return view('dashboard', [
            'greeting' => $greeting,
            'todayTasks' => $todayTasks,
            'taskSummary' => $taskSummary,
            'latestMood' => $latestMood,
            'todayMood' => $todayMood,
            'dominantMood' => $dominantMood,
            'totalStudyMaterials' => $totalStudyMaterials,
            'studyDoneCount' => $studyDoneCount,
            'studyStartedCount' => $studyStartedCount,
            'studyCompletionRate' => $studyCompletionRate,
            'recentNotes' => $recentNotes,
            'quickAccess' => $quickAccess,
            'rewardTreeStage' => $rewardTreeStage,
            'dailyConsistencyPoints' => $dailyConsistencyPoints,
        ]);
    }

    /**
     * Resolve a contextual greeting based on local time.
     */
    protected function resolveGreeting(): string
    {
        $hour = now()->hour;

        if ($hour < 11) {
            return 'Good morning';
        }

        if ($hour < 16) {
            return 'Good afternoon';
        }

        if ($hour < 19) {
            return 'Good evening';
        }

        return 'Good night';
    }
}