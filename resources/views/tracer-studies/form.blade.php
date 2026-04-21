<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Tracer Study Alumni</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <form method="POST" action="{{ $tracerStudy->exists ? route('tracer-studies.update', $tracerStudy) : route('tracer-studies.store') }}" class="space-y-6 rounded-2xl bg-white p-8 shadow-sm">
                @csrf
                @if ($tracerStudy->exists)
                    @method('PUT')
                @endif
                <div class="grid gap-4 md:grid-cols-2">
                    <div><label class="text-sm font-semibold text-slate-700">Status Pekerjaan</label><select name="employment_status" class="mt-1 w-full rounded-lg border-slate-300">@foreach (['bekerja', 'wirausaha', 'studi_lanjut', 'belum_bekerja'] as $status)<option value="{{ $status }}" @selected(old('employment_status', $tracerStudy->employment_status) === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>@endforeach</select></div>
                    <div><label class="text-sm font-semibold text-slate-700">Tingkat Relevansi Kompetensi</label><input type="number" min="1" max="5" name="relevance_level" value="{{ old('relevance_level', $tracerStudy->relevance_level) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Perusahaan</label><input type="text" name="company_name" value="{{ old('company_name', $tracerStudy->company_name) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Jabatan</label><input type="text" name="job_title" value="{{ old('job_title', $tracerStudy->job_title) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Masa Tunggu Kerja (bulan)</label><input type="number" min="0" name="waiting_period_months" value="{{ old('waiting_period_months', $tracerStudy->waiting_period_months) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Gaji</label><input type="number" step="0.01" min="0" name="salary" value="{{ old('salary', $tracerStudy->salary) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                </div>
                <div><label class="text-sm font-semibold text-slate-700">Masukan Alumni</label><textarea name="feedback" rows="5" class="mt-1 w-full rounded-lg border-slate-300">{{ old('feedback', $tracerStudy->feedback) }}</textarea></div>
                <button class="rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Simpan Tracer Study</button>
            </form>
        </div>
    </div>
</x-app-layout>
