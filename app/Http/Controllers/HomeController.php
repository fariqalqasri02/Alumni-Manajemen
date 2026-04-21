<?php

namespace App\Http\Controllers;

use App\Models\CareerEvent;
use App\Models\JobVacancy;
use App\Models\TracerStudy;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $tracerDistribution = $this->getTracerDistribution();

        return view('welcome', [
            'publicStats' => [
                'users' => $this->tableExists('users') ? User::count() : 0,
                'jobs' => $this->tableExists('job_vacancies') ? JobVacancy::published()->count() : 0,
                'events' => $this->tableExists('career_events') ? CareerEvent::published()->count() : 0,
                'tracer' => $this->tableExists('tracer_studies') ? TracerStudy::count() : 0,
            ],
            'featuredJobs' => $this->getFeaturedJobs(),
            'featuredEvents' => $this->getFeaturedEvents(),
            'publicTracerChart' => [
                'labels' => $tracerDistribution
                    ->keys()
                    ->map(fn (string $status) => str($status)->replace('_', ' ')->title())
                    ->values(),
                'values' => $tracerDistribution->values(),
            ],
        ]);
    }

    private function getFeaturedJobs(): Collection
    {
        if (! $this->tableExists('job_vacancies')) {
            return collect();
        }

        return JobVacancy::published()->latest()->take(3)->get();
    }

    private function getFeaturedEvents(): Collection
    {
        if (! $this->tableExists('career_events')) {
            return collect();
        }

        return CareerEvent::published()->orderBy('start_at')->take(3)->get();
    }

    private function getTracerDistribution(): Collection
    {
        if (! $this->tableExists('tracer_studies')) {
            return collect();
        }

        return TracerStudy::query()
            ->selectRaw('employment_status, count(*) as total')
            ->groupBy('employment_status')
            ->pluck('total', 'employment_status');
    }

    private function tableExists(string $table): bool
    {
        return Schema::hasTable($table);
    }
}
