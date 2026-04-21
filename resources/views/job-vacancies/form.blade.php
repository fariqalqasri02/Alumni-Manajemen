<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">{{ $jobVacancy->exists ? 'Edit Lowongan' : 'Tambah Lowongan' }}</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <form method="POST" action="{{ $action }}" class="space-y-6 rounded-2xl bg-white p-8 shadow-sm">
                @csrf
                @if ($method !== 'POST')
                    @method($method)
                @endif
                <div class="grid gap-4 md:grid-cols-2">
                    <div><label class="text-sm font-semibold text-slate-700">Judul</label><input type="text" name="title" value="{{ old('title', $jobVacancy->title) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Perusahaan</label><input type="text" name="company" value="{{ old('company', $jobVacancy->company) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Lokasi</label><input type="text" name="location" value="{{ old('location', $jobVacancy->location) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Tipe Pekerjaan</label><select name="employment_type" class="mt-1 w-full rounded-lg border-slate-300">@foreach (['full-time', 'part-time', 'internship', 'contract'] as $type)<option value="{{ $type }}" @selected(old('employment_type', $jobVacancy->employment_type ?: 'full-time') === $type)>{{ ucfirst($type) }}</option>@endforeach</select></div>
                    <div><label class="text-sm font-semibold text-slate-700">Gaji Minimum</label><input type="number" step="0.01" name="salary_min" value="{{ old('salary_min', $jobVacancy->salary_min) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Gaji Maksimum</label><input type="number" step="0.01" name="salary_max" value="{{ old('salary_max', $jobVacancy->salary_max) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Deadline</label><input type="date" name="deadline" value="{{ old('deadline', optional($jobVacancy->deadline)->format('Y-m-d')) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Link Lamaran</label><input type="url" name="application_link" value="{{ old('application_link', $jobVacancy->application_link) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                </div>
                <div><label class="text-sm font-semibold text-slate-700">Deskripsi</label><textarea name="description" rows="5" class="mt-1 w-full rounded-lg border-slate-300">{{ old('description', $jobVacancy->description) }}</textarea></div>
                <div><label class="text-sm font-semibold text-slate-700">Persyaratan</label><textarea name="requirements" rows="5" class="mt-1 w-full rounded-lg border-slate-300">{{ old('requirements', $jobVacancy->requirements) }}</textarea></div>
                <label class="flex items-center gap-2 text-sm text-slate-700"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $jobVacancy->is_published ?? true))>Publikasikan lowongan</label>
                <div class="flex gap-3">
                    <button class="rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Simpan</button>
                    <a href="{{ route('admin.jobs.index') }}" class="rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
