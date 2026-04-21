<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Models\SystemNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    public function index(Request $request): View
    {
        $query = JobVacancy::query();

        if (! $request->user()?->isAdmin()) {
            $query->published();
        }

        if ($search = $request->string('search')->toString()) {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($type = $request->string('employment_type')->toString()) {
            $query->where('employment_type', $type);
        }

        $jobVacancies = $query->latest()->paginate(10)->withQueryString();

        return view('job-vacancies.index', [
            'jobVacancies' => $jobVacancies,
            'isAdminContext' => $request->routeIs('admin.*'),
        ]);
    }

    public function create(): View
    {
        return view('job-vacancies.form', [
            'jobVacancy' => new JobVacancy(),
            'action' => route('admin.jobs.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);
        $validated['created_by'] = $request->user()->id;

        $jobVacancy = JobVacancy::create($validated);

        SystemNotification::create([
            'title' => 'Lowongan baru tersedia',
            'message' => "{$jobVacancy->title} dari {$jobVacancy->company} telah dipublikasikan.",
            'type' => 'job',
            'published_at' => now(),
        ]);

        return redirect()->route('admin.jobs.index')->with('status', 'Lowongan berhasil ditambahkan.');
    }

    public function show(JobVacancy $jobVacancy): View
    {
        abort_if(! $jobVacancy->is_published && ! request()->user()?->isAdmin(), 404);

        return view('job-vacancies.show', compact('jobVacancy'));
    }

    public function edit(JobVacancy $jobVacancy): View
    {
        return view('job-vacancies.form', [
            'jobVacancy' => $jobVacancy,
            'action' => route('admin.jobs.update', $jobVacancy),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, JobVacancy $jobVacancy): RedirectResponse
    {
        $jobVacancy->update($this->validateData($request));

        return redirect()->route('admin.jobs.index')->with('status', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(JobVacancy $jobVacancy): RedirectResponse
    {
        $jobVacancy->delete();

        return redirect()->route('admin.jobs.index')->with('status', 'Lowongan berhasil dihapus.');
    }

    protected function validateData(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', 'in:full-time,part-time,internship,contract'],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0'],
            'deadline' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'application_link' => ['nullable', 'url'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        return $validated;
    }
}
