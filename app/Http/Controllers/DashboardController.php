<?php

namespace App\Http\Controllers;

use App\Models\CareerEvent;
use App\Models\EventRegistration;
use App\Models\JobVacancy;
use App\Models\SystemNotification;
use App\Models\TracerStudy;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user()->loadMissing('profile');

        $stats = $user->isAdmin()
            ? [
                'users' => User::count(),
                'jobs' => JobVacancy::count(),
                'events' => CareerEvent::count(),
                'tracer' => TracerStudy::count(),
            ]
            : [
                'jobs' => JobVacancy::published()->count(),
                'events' => CareerEvent::published()->count(),
                'registrations' => EventRegistration::where('user_id', $user->id)->count(),
                'notifications' => $this->notificationQuery($user->id)->count(),
            ];

        $recentJobs = JobVacancy::published()->latest()->take(5)->get();
        $recentEvents = CareerEvent::published()->orderBy('start_at')->take(5)->get();
        $notifications = $this->notificationQuery($user->id)
            ->latest('published_at')
            ->take(6)
            ->get();

        $tracerStats = $this->getTracerStats();

        $tracerChartData = [
            'labels' => $tracerStats
                ->keys()
                ->map(fn (string $status) => str($status)->replace('_', ' ')->title())
                ->values(),
            'values' => $tracerStats->values(),
            'total' => $tracerStats->sum(),
        ];

        $userRegistrations = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $adminInsights = $user->isAdmin() ? [
            'latestUsers' => User::latest()->take(5)->get(),
            'latestRegistrations' => EventRegistration::with(['user', 'event'])->latest()->take(5)->get(),
        ] : [];

        return view('dashboard', compact(
            'user',
            'stats',
            'recentJobs',
            'recentEvents',
            'notifications',
            'tracerStats',
            'tracerChartData',
            'userRegistrations',
            'adminInsights'
        ));
    }

    private function notificationQuery(int $userId)
    {
        return SystemNotification::query()
            ->where(function ($query) use ($userId) {
                $query->whereNull('user_id')->orWhere('user_id', $userId);
            });
    }

    private function getTracerStats()
    {
        return TracerStudy::query()
            ->select('employment_status', DB::raw('count(*) as total'))
            ->groupBy('employment_status')
            ->pluck('total', 'employment_status');
    }
}
