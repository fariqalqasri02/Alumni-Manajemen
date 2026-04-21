<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $isAdminContext ? 'Kelola Lowongan Kerja' : 'Informasi Lowongan Kerja' }}</h2>
                <p class="text-sm text-slate-500">Cari, filter, dan pantau lowongan dari perusahaan mitra.</p>
            </div>
            @if ($isAdminContext)
                <a href="{{ route('admin.jobs.create') }}" class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white">Tambah Lowongan</a>
            @endif
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <form method="GET" class="grid gap-4 rounded-2xl bg-white p-6 shadow-sm md:grid-cols-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari jabatan, perusahaan, lokasi" class="rounded-lg border-slate-300 md:col-span-2">
                <select name="employment_type" class="rounded-lg border-slate-300">
                    <option value="">Semua tipe</option>
                    @foreach (['full-time', 'part-time', 'internship', 'contract'] as $type)
                        <option value="{{ $type }}" @selected(request('employment_type') === $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
                <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Cari</button>
            </form>

            <div class="space-y-4">
                @forelse ($jobVacancies as $job)
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900">{{ $job->title }}</h3>
                                <p class="text-sm text-slate-500">{{ $job->company }} • {{ $job->location }} • {{ ucfirst($job->employment_type) }}</p>
                                <p class="mt-3 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($job->description, 180) }}</p>
                            </div>
                            <div class="flex gap-2">
                                @if ($isAdminContext)
                                    <a href="{{ route('admin.jobs.edit', $job) }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700">Edit</a>
                                    <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-lg border border-rose-300 px-4 py-2 text-sm font-semibold text-rose-700" onclick="return confirm('Hapus lowongan ini?')">Hapus</button>
                                    </form>
                                @else
                                    <a href="{{ route('jobs.show', $job) }}" class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white">Detail</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl bg-white p-6 text-sm text-slate-500 shadow-sm">Belum ada lowongan yang tersedia.</div>
                @endforelse
            </div>

            {{ $jobVacancies->links() }}
        </div>
    </div>
</x-app-layout>
