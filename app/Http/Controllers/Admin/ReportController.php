<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerEvent;
use App\Models\EventRegistration;
use App\Models\JobVacancy;
use App\Models\TracerStudy;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(): View
    {
        $reportData = $this->data();

        return view('admin.reports.index', compact('reportData'));
    }

    public function exportPdf(): Response
    {
        $reportData = $this->data();
        $pdf = Pdf::loadView('reports.summary-pdf', compact('reportData'));

        return $pdf->download('laporan-sistem-alumni.pdf');
    }

    public function exportExcel(): Response
    {
        $reportData = $this->data();
        $content = view('reports.summary-excel', compact('reportData'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="laporan-sistem-alumni.xls"',
        ]);
    }

    protected function data(): array
    {
        $users = User::latest()->get();
        $jobs = JobVacancy::latest()->get();
        $events = CareerEvent::withCount('registrations')->orderBy('start_at')->get();
        $registrations = EventRegistration::with(['user', 'event'])->latest()->get();
        $tracerStudies = TracerStudy::with('user')->latest()->get();

        return [
            'users' => $users,
            'jobs' => $jobs,
            'events' => $events,
            'registrations' => $registrations,
            'tracerStudies' => $tracerStudies,
            'summary' => [
                'users' => $users->count(),
                'jobs' => $jobs->count(),
                'events' => $events->count(),
                'registrations' => $registrations->count(),
                'tracerStudies' => $tracerStudies->count(),
            ],
            'tracerDistribution' => $tracerStudies->groupBy('employment_status')->map->count(),
            'eventPerformance' => $events->map(fn ($event) => [
                'title' => $event->title,
                'registrations' => $event->registrations_count,
            ])->take(6)->values(),
            'meta' => [
                'generated_at' => now(),
                'generated_by' => auth()->user()?->name ?? 'System',
            ],
        ];
    }
}
