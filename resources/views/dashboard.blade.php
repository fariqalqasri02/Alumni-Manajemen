<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <span class="badge-soft">{{ $user->isAdmin() ? 'Dashboard Admin' : 'Dashboard User' }}</span>
                <h2 class="mt-3 text-2xl font-semibold text-slate-900 md:text-3xl">Selamat datang, {{ $user->name }}</h2>
                <p class="mt-1 max-w-2xl text-sm text-slate-500 md:text-base">
                    {{ $user->isAdmin() ? 'Kelola ekosistem portal, akses insight tracer study, dan pantau aktivitas terbaru dalam satu layar kerja yang lebih nyaman.' : 'Pantau peluang, kegiatan, dan aktivitas akun Anda dari dashboard yang lebih ringkas dan mudah dipahami.' }}
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

            <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" data-reveal>
                @foreach ($stats as $label => $value)
                    <div class="metric-card">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="meta-badge text-slate-500">{{ ucfirst($label) }}</p>
                                <p class="mt-3 text-3xl font-bold text-slate-900 md:text-4xl">{{ $value }}</p>
                            </div>
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-600">
                                {{ strtoupper(substr($label, 0, 1)) }}
                            </span>
                        </div>
                        <p class="mt-4 text-sm text-slate-500">
                            {{ $user->isAdmin() ? 'Ringkasan cepat untuk membantu Anda melihat kondisi portal saat ini.' : 'Angka ringkas agar aktivitas penting lebih cepat dipantau.' }}
                        </p>
                    </div>
                @endforeach
            </section>

            <section class="dashboard-tracer-grid">
                <div class="panel p-5 md:p-6" data-reveal>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="section-title">Statistik Tracer Study</h3>
                            <p class="mt-1 text-sm text-slate-500">Distribusi status alumni dari seluruh respons tracer study yang sudah masuk.</p>
                        </div>
                        <div class="rounded-3xl bg-cyan-50 px-4 py-3 text-right">
                            <p class="meta-badge text-cyan-700">Total Respons</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900">{{ $tracerChartData['total'] }}</p>
                        </div>
                    </div>
                    <div class="dashboard-canvas-card">
                        <canvas id="dashboardTracerChart"></canvas>
                    </div>
                </div>

                <div class="panel p-5 md:p-6" data-reveal>
                    <div class="flex items-center justify-between">
                        <h3 class="section-title">Distribusi Cepat</h3>
                        <span class="meta-badge text-slate-400">Live</span>
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
                                        class="h-2 rounded-full bg-linear-to-r from-cyan-500 to-sky-400"
                                        style="width: {{ $tracerChartData['total'] > 0 ? max(8, round(($total / $tracerChartData['total']) * 100)) : 0 }}%"
                                    ></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada data tracer study.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="grid gap-6 lg:grid-cols-2">
                <div class="panel p-5 md:p-6" data-reveal>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="section-title">Lowongan Terbaru</h3>
                            <p class="mt-1 text-sm text-slate-500">Peluang yang bisa langsung Anda tindak lanjuti.</p>
                        </div>
                        <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-cyan-700">Lihat semua</a>
                    </div>
                    <div class="mt-4 space-y-4">
                        @forelse ($recentJobs as $job)
                            <a href="{{ route('jobs.show', $job) }}" class="dashboard-link-card">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $job->title }}</p>
                                        <p class="text-sm text-slate-500">{{ $job->company }} &middot; {{ $job->location }}</p>
                                    </div>
                                    <span class="rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-cyan-700">Aktif</span>
                                </div>
                                <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($job->description, 120) }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada lowongan.</p>
                        @endforelse
                    </div>
                </div>

                <div class="panel p-5 md:p-6" data-reveal>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="section-title">Kegiatan Karier</h3>
                            <p class="mt-1 text-sm text-slate-500">Agenda terdekat yang bisa Anda ikuti.</p>
                        </div>
                        <a href="{{ route('events.index') }}" class="text-sm font-semibold text-cyan-700">Lihat semua</a>
                    </div>
                    <div class="mt-4 space-y-4">
                        @forelse ($recentEvents as $event)
                            <a href="{{ route('events.show', $event) }}" class="dashboard-link-card">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $event->title }}</p>
                                        <p class="text-sm text-slate-500">{{ $event->event_type }} &middot; {{ $event->start_at->format('d M Y H:i') }}</p>
                                    </div>
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-amber-700">Agenda</span>
                                </div>
                                <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($event->description, 120) }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada kegiatan.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="dashboard-bottom-grid">
                <div class="panel p-5 md:p-6" data-reveal>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="section-title">Notifikasi Sistem</h3>
                            <p class="mt-1 text-sm text-slate-500">Informasi terbaru yang berkaitan dengan akun dan sistem.</p>
                        </div>
                        <span class="meta-badge text-slate-400">{{ $notifications->count() }} item</span>
                    </div>
                    <div class="mt-4 space-y-3">
                        @forelse ($notifications as $notification)
                            <div class="rounded-2xl border border-slate-200 p-4 transition duration-300 hover:border-cyan-300 hover:bg-cyan-50/40">
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

                @if ($user->isAdmin())
                    <div class="grid gap-6 md:grid-cols-2" data-reveal>
                        <div class="panel p-5 md:p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="section-title">Pengguna Terbaru</h3>
                                    <p class="mt-1 text-sm text-slate-500">Akun yang baru masuk ke portal.</p>
                                </div>
                                <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-cyan-700">Kelola user</a>
                            </div>
                            <div class="mt-4 space-y-3">
                                @foreach (($adminInsights['latestUsers'] ?? collect()) as $latestUser)
                                    <div class="rounded-2xl border border-slate-200 p-4">
                                        <p class="font-semibold text-slate-900">{{ $latestUser->name }}</p>
                                        <p class="text-sm text-slate-500">{{ $latestUser->email }} &middot; {{ $latestUser->role }} / {{ $latestUser->user_type }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="panel p-5 md:p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="section-title">Pendaftaran Terbaru</h3>
                                    <p class="mt-1 text-sm text-slate-500">Riwayat pendaftaran kegiatan yang baru masuk.</p>
                                </div>
                                <a href="{{ route('admin.reports.index') }}" class="text-sm font-semibold text-cyan-700">Lihat laporan</a>
                            </div>
                            <div class="mt-4 space-y-3">
                                @foreach (($adminInsights['latestRegistrations'] ?? collect()) as $registration)
                                    <div class="rounded-2xl border border-slate-200 p-4">
                                        <p class="font-semibold text-slate-900">{{ $registration->user?->name }}</p>
                                        <p class="text-sm text-slate-500">{{ $registration->event?->title }} &middot; {{ $registration->status }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="panel p-5 md:p-6" data-reveal>
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="section-title">Riwayat Pendaftaran Kegiatan</h3>
                                <p class="mt-1 text-sm text-slate-500">Pantau agenda yang pernah Anda ikuti atau daftar.</p>
                            </div>
                            <a href="{{ route('events.index') }}" class="text-sm font-semibold text-cyan-700">Cari kegiatan</a>
                        </div>
                        <div class="mt-4 grid gap-3 md:grid-cols-2">
                            @forelse ($userRegistrations as $registration)
                                <div class="rounded-2xl border border-slate-200 p-4 transition duration-300 hover:border-cyan-300 hover:bg-cyan-50/40">
                                    <p class="font-semibold text-slate-900">{{ $registration->event?->title }}</p>
                                    <p class="text-sm text-slate-500">{{ $registration->status }} &middot; {{ optional($registration->registered_at)->format('d M Y H:i') }}</p>
                                </div>
                            @empty
                                <p class="text-sm text-slate-500">Anda belum memiliki riwayat pendaftaran kegiatan.</p>
                            @endforelse
                        </div>
                    </div>
                @endif
            </section>
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
                            backgroundColor: ['#0891b2', '#06b6d4', '#22d3ee', '#67e8f9', '#f59e0b'],
                            borderRadius: 16,
                            borderSkipped: false,
                            maxBarThickness: 54,
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
