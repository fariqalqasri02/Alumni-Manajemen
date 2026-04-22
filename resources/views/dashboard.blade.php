<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <span class="badge-soft">{{ $user->isAdmin() ? 'Dashboard Admin' : 'Dashboard User' }}</span>
                <h2 class="mt-3 text-2xl font-semibold text-slate-900 md:text-3xl">Selamat datang, {{ $user->name }}</h2>
                <p class="mt-1 text-sm text-slate-500 md:text-base">
                    {{ $user->isAdmin() ? 'Pantau performa sistem, kelola data utama, dan akses laporan formal.' : 'Temukan lowongan, kegiatan karier, dan pantau aktivitas akun Anda.' }}
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('jobs.index') }}" class="btn-secondary">Lowongan</a>
                <a href="{{ route('events.index') }}" class="btn-secondary">Kegiatan</a>
                <a href="{{ route('tracer-studies.index') }}" class="btn-primary">{{ $user->isAdmin() ? 'Tracer Study' : 'Isi Tracer Study' }}</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-10">
        <div class="shell-container space-y-6">
            @if (session('status'))
                <div class="panel rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                @foreach ($stats as $label => $value)
                    <div class="panel p-5 md:p-6">
                        <p class="text-sm uppercase tracking-[0.2em] text-slate-500">{{ ucfirst($label) }}</p>
                        <p class="mt-3 text-3xl font-bold text-slate-900 md:text-4xl">{{ $value }}</p>
                    </div>
                @endforeach
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="panel p-5 md:p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="section-title !text-lg">Lowongan Terbaru</h3>
                        <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-cyan-700">Lihat semua</a>
                    </div>
                    <div class="mt-4 space-y-4">
                        @forelse ($recentJobs as $job)
                            <a href="{{ route('jobs.show', $job) }}" class="block rounded-2xl border border-slate-200 p-4 transition hover:border-cyan-300 hover:bg-cyan-50/40">
                                <p class="font-semibold text-slate-900">{{ $job->title }}</p>
                                <p class="text-sm text-slate-500">{{ $job->company }} • {{ $job->location }}</p>
                                <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($job->description, 120) }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada lowongan.</p>
                        @endforelse
                    </div>
                </div>

                <div class="panel p-5 md:p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="section-title !text-lg">Kegiatan Karier</h3>
                        <a href="{{ route('events.index') }}" class="text-sm font-semibold text-cyan-700">Lihat semua</a>
                    </div>
                    <div class="mt-4 space-y-4">
                        @forelse ($recentEvents as $event)
                            <a href="{{ route('events.show', $event) }}" class="block rounded-2xl border border-slate-200 p-4 transition hover:border-cyan-300 hover:bg-cyan-50/40">
                                <p class="font-semibold text-slate-900">{{ $event->title }}</p>
                                <p class="text-sm text-slate-500">{{ $event->event_type }} • {{ $event->start_at->format('d M Y H:i') }}</p>
                                <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($event->description, 120) }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada kegiatan.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="panel p-5 md:p-6">
                <h3 class="section-title !text-lg">Notifikasi Sistem</h3>
                <div class="mt-4 space-y-3">
                    @forelse ($notifications as $notification)
                        <div class="rounded-2xl border border-slate-200 p-4">
                            <div class="flex items-center justify-between gap-3">
                                <p class="font-semibold text-slate-800">{{ $notification->title }}</p>
                                <span class="text-xs uppercase tracking-wide text-slate-400">{{ $notification->type }}</span>
                            </div>
                            <p class="mt-2 text-sm text-slate-500">{{ $notification->message }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada notifikasi.</p>
                    @endforelse
                </div>
            </div>

            <div class="panel p-5 md:p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="section-title !text-lg">Statistik Tracer Study</h3>
                        <p class="mt-1 text-sm text-slate-500">Distribusi status alumni dari seluruh respons tracer study.</p>
                    </div>
                    <div class="rounded-2xl bg-cyan-50 px-4 py-3 text-right">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-700">Total Respons</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900">{{ $tracerChartData['total'] }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="h-72">
                        <canvas id="dashboardTracerChart"></canvas>
                    </div>
                </div>
                <div class="mt-5 space-y-3">
                    @forelse ($tracerStats as $status => $total)
                        <div class="rounded-2xl border border-slate-200 px-4 py-3">
                            <div class="flex items-center justify-between gap-3 text-sm text-slate-600">
                                <span>{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                                <span class="font-semibold text-slate-900">{{ $total }} alumni</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-slate-100">
                                <div
                                    class="h-2 rounded-full bg-cyan-500"
                                    style="width: {{ $tracerChartData['total'] > 0 ? max(8, round(($total / $tracerChartData['total']) * 100)) : 0 }}%"
                                ></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada data tracer study.</p>
                    @endforelse
                </div>
            </div>

            @if ($user->isAdmin())
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="panel p-5 md:p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="section-title !text-lg">Pengguna Terbaru</h3>
                            <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-cyan-700">Kelola user</a>
                        </div>
                        <div class="mt-4 space-y-3">
                            @foreach (($adminInsights['latestUsers'] ?? collect()) as $latestUser)
                                <div class="rounded-2xl border border-slate-200 p-4">
                                    <p class="font-semibold text-slate-900">{{ $latestUser->name }}</p>
                                    <p class="text-sm text-slate-500">{{ $latestUser->email }} • {{ $latestUser->role }} / {{ $latestUser->user_type }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="panel p-5 md:p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="section-title !text-lg">Pendaftaran Kegiatan Terbaru</h3>
                            <a href="{{ route('admin.reports.index') }}" class="text-sm font-semibold text-cyan-700">Lihat laporan</a>
                        </div>
                        <div class="mt-4 space-y-3">
                            @foreach (($adminInsights['latestRegistrations'] ?? collect()) as $registration)
                                <div class="rounded-2xl border border-slate-200 p-4">
                                    <p class="font-semibold text-slate-900">{{ $registration->user?->name }}</p>
                                    <p class="text-sm text-slate-500">{{ $registration->event?->title }} • {{ $registration->status }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="panel p-5 md:p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="section-title !text-lg">Riwayat Pendaftaran Kegiatan</h3>
                        <a href="{{ route('events.index') }}" class="text-sm font-semibold text-cyan-700">Cari kegiatan</a>
                    </div>
                    <div class="mt-4 grid gap-3 md:grid-cols-2">
                        @forelse ($userRegistrations as $registration)
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <p class="font-semibold text-slate-900">{{ $registration->event?->title }}</p>
                                <p class="text-sm text-slate-500">{{ $registration->status }} • {{ optional($registration->registered_at)->format('d M Y H:i') }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">Anda belum memiliki riwayat pendaftaran kegiatan.</p>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if ($tracerStats->isNotEmpty())
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const dashboardTracerChartData = @json($tracerChartData);
            const tracerCanvas = document.getElementById('dashboardTracerChart');

            if (tracerCanvas) {
                new Chart(tracerCanvas, {
                    type: 'bar',
                    data: {
                        labels: dashboardTracerChartData.labels,
                        datasets: [{
                            label: 'Jumlah Alumni',
                            data: dashboardTracerChartData.values,
                            backgroundColor: ['#0891b2', '#06b6d4', '#22d3ee', '#67e8f9', '#a5f3fc'],
                            borderRadius: 14,
                            borderSkipped: false,
                            maxBarThickness: 56,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                },
                                grid: {
                                    color: 'rgba(148, 163, 184, 0.18)',
                                },
                            },
                            x: {
                                grid: {
                                    display: false,
                                },
                            },
                        },
                    },
                });
            }
        </script>
    @endif
</x-app-layout>
