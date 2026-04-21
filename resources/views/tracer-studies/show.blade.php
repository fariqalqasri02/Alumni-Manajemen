<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detail Tracer Study</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white p-8 shadow-sm">
                <h3 class="text-2xl font-semibold text-slate-900">{{ $tracerStudy->user->name ?? 'Tracer Study' }}</h3>
                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <div><span class="font-semibold text-slate-700">Status:</span> {{ $tracerStudy->employment_status }}</div>
                    <div><span class="font-semibold text-slate-700">Relevansi:</span> {{ $tracerStudy->relevance_level }}/5</div>
                    <div><span class="font-semibold text-slate-700">Perusahaan:</span> {{ $tracerStudy->company_name ?: '-' }}</div>
                    <div><span class="font-semibold text-slate-700">Jabatan:</span> {{ $tracerStudy->job_title ?: '-' }}</div>
                    <div><span class="font-semibold text-slate-700">Masa tunggu:</span> {{ $tracerStudy->waiting_period_months }} bulan</div>
                    <div><span class="font-semibold text-slate-700">Gaji:</span> {{ $tracerStudy->salary ?: '-' }}</div>
                </div>
                <div class="mt-6">
                    <p class="font-semibold text-slate-700">Masukan</p>
                    <p class="mt-2 whitespace-pre-line text-sm text-slate-600">{{ $tracerStudy->feedback ?: '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
