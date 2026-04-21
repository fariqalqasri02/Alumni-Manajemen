<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Laporan Sistem</h2>
                <p class="text-sm text-slate-500">Ringkasan pengguna, lowongan, kegiatan, pendaftaran, dan tracer study.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.reports.pdf') }}" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white">Export PDF</a>
                <a href="{{ route('admin.reports.excel') }}" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white">Export Excel</a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="shell-container space-y-6">
            <div class="grid gap-4 md:grid-cols-4">
                <div class="panel-soft"><p class="text-sm text-slate-500">Pengguna</p><p class="mt-2 text-3xl font-bold">{{ $reportData['summary']['users'] }}</p></div>
                <div class="panel-soft"><p class="text-sm text-slate-500">Lowongan</p><p class="mt-2 text-3xl font-bold">{{ $reportData['summary']['jobs'] }}</p></div>
                <div class="panel-soft"><p class="text-sm text-slate-500">Kegiatan</p><p class="mt-2 text-3xl font-bold">{{ $reportData['summary']['events'] }}</p></div>
                <div class="panel-soft"><p class="text-sm text-slate-500">Tracer Study</p><p class="mt-2 text-3xl font-bold">{{ $reportData['summary']['tracerStudies'] }}</p></div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="panel-soft">
                    <h3 class="text-lg font-semibold text-slate-900">Statistik Tracer Study</h3>
                    <canvas id="tracerChart" class="mt-4 h-32"></canvas>
                </div>

                <div class="panel-soft">
                    <h3 class="text-lg font-semibold text-slate-900">Kinerja Kegiatan</h3>
                    <canvas id="eventChart" class="mt-4 h-32"></canvas>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="panel-soft">
                    <h3 class="text-lg font-semibold text-slate-900">Lowongan Terbaru</h3>
                    <div class="mt-4 space-y-3">
                        @foreach ($reportData['jobs']->take(5) as $job)
                            <div class="rounded-xl border border-slate-200 p-4">
                                <p class="font-semibold text-slate-900">{{ $job->title }}</p>
                                <p class="text-sm text-slate-500">{{ $job->company }} • {{ $job->location }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="panel-soft">
                    <h3 class="text-lg font-semibold text-slate-900">Tracer Study Terbaru</h3>
                    <div class="mt-4 space-y-3">
                        @foreach ($reportData['tracerStudies']->take(5) as $study)
                            <div class="rounded-xl border border-slate-200 p-4">
                                <p class="font-semibold text-slate-900">{{ $study->user?->name }}</p>
                                <p class="text-sm text-slate-500">{{ $study->employment_status }} • Relevansi {{ $study->relevance_level }}/5</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="panel-soft">
                <h3 class="text-lg font-semibold text-slate-900">Statistik Tracer Study</h3>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-200 text-left text-slate-500">
                                <th class="pb-3 pr-4">Nama</th>
                                <th class="pb-3 pr-4">Email</th>
                                <th class="pb-3 pr-4">Role</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportData['users']->take(10) as $user)
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 pr-4">{{ $user->name }}</td>
                                    <td class="py-3 pr-4">{{ $user->email }}</td>
                                    <td class="py-3 pr-4">{{ $user->role }}</td>
                                    <td class="py-3">{{ $user->user_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const tracerData = @json($reportData['tracerDistribution']);
        const eventData = @json($reportData['eventPerformance']);
        new Chart(document.getElementById('tracerChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(tracerData),
                datasets: [{ label: 'Jumlah Alumni', data: Object.values(tracerData), backgroundColor: '#06b6d4', borderRadius: 12 }]
            }
        });

        new Chart(document.getElementById('eventChart'), {
            type: 'line',
            data: {
                labels: eventData.map(item => item.title),
                datasets: [{ label: 'Pendaftar', data: eventData.map(item => item.registrations), backgroundColor: 'rgba(14,165,233,0.2)', borderColor: '#0f172a', tension: 0.35, fill: true }]
            }
        });
    </script>
</x-app-layout>
