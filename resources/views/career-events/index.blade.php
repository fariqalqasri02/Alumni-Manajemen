<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $isAdminContext ? 'Kelola Kegiatan Karier' : 'Informasi Kegiatan Karier' }}</h2>
                <p class="text-sm text-slate-500">Seminar, pelatihan, lokakarya, dan bursa kerja.</p>
            </div>
            @if ($isAdminContext)
                <a href="{{ route('admin.events.create') }}" class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white">Tambah Kegiatan</a>
            @endif
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
            @forelse ($careerEvents as $event)
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="flex flex-col gap-4 md:flex-row md:justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-slate-900">{{ $event->title }}</h3>
                            <p class="text-sm text-slate-500">{{ $event->event_type }} • {{ $event->location }} • {{ $event->start_at->format('d M Y H:i') }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($event->description, 160) }}</p>
                            @if ($isAdminContext)
                                <p class="mt-2 text-xs text-slate-500">Pendaftar: {{ $event->registrations_count }}</p>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            @if ($isAdminContext)
                                <a href="{{ route('admin.events.edit', $event) }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700">Edit</a>
                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg border border-rose-300 px-4 py-2 text-sm font-semibold text-rose-700" onclick="return confirm('Hapus kegiatan ini?')">Hapus</button>
                                </form>
                            @else
                                <a href="{{ route('events.show', $event) }}" class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white">Detail</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl bg-white p-6 text-sm text-slate-500 shadow-sm">Belum ada kegiatan karier.</div>
            @endforelse

            {{ $careerEvents->links() }}
        </div>
    </div>
</x-app-layout>
