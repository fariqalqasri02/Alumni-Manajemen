<?php

namespace App\Http\Controllers;

use App\Models\CareerEvent;
use App\Models\JobVacancy;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('welcome', [
            'featuredJobs' => $this->getFeaturedJobs(),
            'featuredEvents' => $this->getFeaturedEvents(),
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
    private function tableExists(string $table): bool
    {
        return Schema::hasTable($table);
    }
}
