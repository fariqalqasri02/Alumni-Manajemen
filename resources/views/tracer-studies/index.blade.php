<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Kelola Tracer Study</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
            @forelse ($tracerStudies as $study)
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-semibold text-slate-900">{{ $study->user->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $study->employment_status }} • Relevansi: {{ $study->relevance_level }}/5 • Tahun: {{ $study->survey_year }}</p>
                            <p class="mt-2 text-sm text-slate-600">{{ $study->company_name ?: '-' }} / {{ $study->job_title ?: '-' }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('tracer-studies.show', $study) }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700">Detail</a>
                            <form method="POST" action="{{ route('admin.tracer-studies.destroy', $study) }}">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-lg border border-rose-300 px-4 py-2 text-sm font-semibold text-rose-700" onclick="return confirm('Hapus data tracer study ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl bg-white p-6 text-sm text-slate-500 shadow-sm">Belum ada data tracer study.</div>
            @endforelse
            {{ $tracerStudies->links() }}
        </div>
    </div>
</x-app-layout>
