<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detail Lowongan</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl space-y-6 sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white p-8 shadow-sm">
                <h1 class="text-3xl font-bold text-slate-900">{{ $jobVacancy->title }}</h1>
                <p class="mt-2 text-slate-500">{{ $jobVacancy->company }} • {{ $jobVacancy->location }} • {{ ucfirst($jobVacancy->employment_type) }}</p>
                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <div>
                        <p class="text-sm font-semibold text-slate-700">Deskripsi</p>
                        <p class="mt-2 whitespace-pre-line text-sm text-slate-600">{{ $jobVacancy->description }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-700">Persyaratan</p>
                        <p class="mt-2 whitespace-pre-line text-sm text-slate-600">{{ $jobVacancy->requirements ?: '-' }}</p>
                    </div>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    @if ($jobVacancy->application_link)
                        <a href="{{ $jobVacancy->application_link }}" target="_blank" class="rounded-lg bg-cyan-600 px-5 py-3 text-sm font-semibold text-white">Lamar Sekarang</a>
                    @endif
                    <a href="{{ route('jobs.index') }}" class="rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
