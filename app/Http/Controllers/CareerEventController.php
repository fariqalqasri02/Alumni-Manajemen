<?php

namespace App\Http\Controllers;

use App\Models\CareerEvent;
use App\Models\EventRegistration;
use App\Models\SystemNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CareerEventController extends Controller
{
    public function index(Request $request): View
    {
        $query = CareerEvent::withCount('registrations');

        if (! $request->user()?->isAdmin()) {
            $query->published();
        }

        $careerEvents = $query->orderBy('start_at')->paginate(10);

        return view('career-events.index', [
            'careerEvents' => $careerEvents,
            'isAdminContext' => $request->routeIs('admin.*'),
        ]);
    }

    public function create(): View
    {
        return view('career-events.form', [
            'careerEvent' => new CareerEvent(),
            'action' => route('admin.events.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);
        $validated['created_by'] = $request->user()->id;

        $careerEvent = CareerEvent::create($validated);

        SystemNotification::create([
            'title' => 'Kegiatan karier baru',
            'message' => "{$careerEvent->title} akan berlangsung di {$careerEvent->location}.",
            'type' => 'event',
            'published_at' => now(),
        ]);

        return redirect()->route('admin.events.index')->with('status', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(CareerEvent $careerEvent): View
    {
        abort_if(! $careerEvent->is_published && ! request()->user()?->isAdmin(), 404);

        $registration = auth()->check()
            ? EventRegistration::where('career_event_id', $careerEvent->id)->where('user_id', auth()->id())->first()
            : null;

        return view('career-events.show', compact('careerEvent', 'registration'));
    }

    public function edit(CareerEvent $careerEvent): View
    {
        return view('career-events.form', [
            'careerEvent' => $careerEvent,
            'action' => route('admin.events.update', $careerEvent),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, CareerEvent $careerEvent): RedirectResponse
    {
        $careerEvent->update($this->validateData($request));

        return redirect()->route('admin.events.index')->with('status', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(CareerEvent $careerEvent): RedirectResponse
    {
        $careerEvent->delete();

        return redirect()->route('admin.events.index')->with('status', 'Kegiatan berhasil dihapus.');
    }

    public function register(CareerEvent $careerEvent): RedirectResponse
    {
        $user = request()->user();

        EventRegistration::firstOrCreate(
            ['career_event_id' => $careerEvent->id, 'user_id' => $user->id],
            ['registered_at' => now(), 'status' => 'registered']
        );

        return redirect()->route('events.show', $careerEvent)->with('status', 'Pendaftaran kegiatan berhasil.');
    }

    protected function validateData(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'event_type' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'quota' => ['nullable', 'integer', 'min:1'],
            'is_published' => ['nullable', 'boolean'],
            'description' => ['required', 'string'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        return $validated;
    }
}
