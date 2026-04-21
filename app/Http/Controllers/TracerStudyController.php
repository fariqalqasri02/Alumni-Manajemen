<?php

namespace App\Http\Controllers;

use App\Models\TracerStudy;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TracerStudyController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->user()->isAdmin()) {
            $tracerStudies = TracerStudy::with('user')->latest()->paginate(10);

            return view('tracer-studies.index', compact('tracerStudies'));
        }

        $tracerStudy = TracerStudy::firstOrNew([
            'user_id' => $request->user()->id,
            'survey_year' => now()->year,
        ]);

        return view('tracer-studies.form', compact('tracerStudy'));
    }

    public function create(): View
    {
        $tracerStudy = TracerStudy::firstOrNew([
            'user_id' => request()->user()->id,
            'survey_year' => now()->year,
        ]);

        return view('tracer-studies.form', compact('tracerStudy'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);
        $validated['user_id'] = $request->user()->id;
        $validated['survey_year'] = now()->year;

        TracerStudy::updateOrCreate(
            ['user_id' => $request->user()->id, 'survey_year' => now()->year],
            $validated
        );

        return redirect()->route('tracer-studies.index')->with('status', 'Tracer study berhasil disimpan.');
    }

    public function show(TracerStudy $tracerStudy): View
    {
        abort_unless(request()->user()->isAdmin() || $tracerStudy->user_id === request()->user()->id, 403);

        return view('tracer-studies.show', compact('tracerStudy'));
    }

    public function edit(TracerStudy $tracerStudy): View
    {
        abort_unless(request()->user()->isAdmin() || $tracerStudy->user_id === request()->user()->id, 403);

        return view('tracer-studies.form', compact('tracerStudy'));
    }

    public function update(Request $request, TracerStudy $tracerStudy): RedirectResponse
    {
        abort_unless(request()->user()->isAdmin() || $tracerStudy->user_id === request()->user()->id, 403);

        $tracerStudy->update($this->validateData($request));

        return redirect()->route('tracer-studies.index')->with('status', 'Tracer study berhasil diperbarui.');
    }

    public function destroy(TracerStudy $tracerStudy): RedirectResponse
    {
        abort_unless(request()->user()->isAdmin(), 403);

        $tracerStudy->delete();

        return redirect()->route('tracer-studies.index')->with('status', 'Data tracer study berhasil dihapus.');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'employment_status' => ['required', 'in:bekerja,wirausaha,studi_lanjut,belum_bekerja'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'relevance_level' => ['required', 'integer', 'min:1', 'max:5'],
            'waiting_period_months' => ['required', 'integer', 'min:0'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'feedback' => ['nullable', 'string'],
        ]);
    }
}
