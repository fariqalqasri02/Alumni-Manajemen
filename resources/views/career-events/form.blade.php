<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">{{ $careerEvent->exists ? 'Edit Kegiatan' : 'Tambah Kegiatan' }}</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <form method="POST" action="{{ $action }}" class="space-y-6 rounded-2xl bg-white p-8 shadow-sm">
                @csrf
                @if ($method !== 'POST')
                    @method($method)
                @endif
                <div class="grid gap-4 md:grid-cols-2">
                    <div><label class="text-sm font-semibold text-slate-700">Nama Kegiatan</label><input type="text" name="title" value="{{ old('title', $careerEvent->title) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Jenis Kegiatan</label><input type="text" name="event_type" value="{{ old('event_type', $careerEvent->event_type) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Lokasi</label><input type="text" name="location" value="{{ old('location', $careerEvent->location) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Kuota</label><input type="number" name="quota" value="{{ old('quota', $careerEvent->quota) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Mulai</label><input type="datetime-local" name="start_at" value="{{ old('start_at', optional($careerEvent->start_at)->format('Y-m-d\TH:i')) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                    <div><label class="text-sm font-semibold text-slate-700">Selesai</label><input type="datetime-local" name="end_at" value="{{ old('end_at', optional($careerEvent->end_at)->format('Y-m-d\TH:i')) }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
                </div>
                <div><label class="text-sm font-semibold text-slate-700">Deskripsi</label><textarea name="description" rows="6" class="mt-1 w-full rounded-lg border-slate-300">{{ old('description', $careerEvent->description) }}</textarea></div>
                <label class="flex items-center gap-2 text-sm text-slate-700"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $careerEvent->is_published ?? true))>Publikasikan kegiatan</label>
                <div class="flex gap-3">
                    <button class="rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Simpan</button>
                    <a href="{{ route('admin.events.index') }}" class="rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
