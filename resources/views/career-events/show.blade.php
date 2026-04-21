<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detail Kegiatan</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white p-8 shadow-sm">
                <h1 class="text-3xl font-bold text-slate-900">{{ $careerEvent->title }}</h1>
                <p class="mt-2 text-slate-500">{{ $careerEvent->event_type }} • {{ $careerEvent->location }}</p>
                <p class="mt-1 text-sm text-slate-500">{{ $careerEvent->start_at->format('d M Y H:i') }} - {{ $careerEvent->end_at->format('d M Y H:i') }}</p>
                <div class="mt-6 whitespace-pre-line text-sm text-slate-700">{{ $careerEvent->description }}</div>
                <div class="mt-6 flex gap-3">
                    @if (! $registration)
                        <form method="POST" action="{{ route('events.register', $careerEvent) }}">
                            @csrf
                            <button class="rounded-lg bg-cyan-600 px-5 py-3 text-sm font-semibold text-white">Daftar Kegiatan</button>
                        </form>
                    @else
                        <span class="rounded-lg bg-emerald-50 px-5 py-3 text-sm font-semibold text-emerald-700">Anda sudah terdaftar</span>
                    @endif
                    <a href="{{ route('events.index') }}" class="rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
