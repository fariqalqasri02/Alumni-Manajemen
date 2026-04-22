<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Manajemen Alumni</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f5f7fb] text-slate-900">
        <div class="min-h-screen overflow-x-hidden bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.18),_transparent_30%),radial-gradient(circle_at_top_right,_rgba(245,158,11,0.16),_transparent_24%),linear-gradient(180deg,#f8fafc_0%,#e2e8f0_100%)]">
            <header class="relative">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-6 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.4em] text-cyan-700">Portal Alumni</p>
                        <h1 class="mt-2 text-lg font-semibold text-slate-900 sm:text-xl">Sistem Manajemen Alumni</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="btn-secondary !rounded-full !border-slate-300 !bg-white/80 !px-5">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary !rounded-full !bg-slate-950 !px-5 hover:!bg-cyan-700">Registrasi</a>
                    </div>
                </div>
            </header>

            <main>
                <section class="relative">
                    <div class="mx-auto grid max-w-7xl gap-10 px-4 pb-16 pt-6 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:pb-24 lg:pt-10">
                        <div class="relative">
                            <div class="inline-flex items-center gap-2 rounded-full border border-cyan-200 bg-white/80 px-4 py-2 text-sm text-cyan-800 shadow-sm shadow-cyan-100/70 backdrop-blur">
                                <span class="h-2.5 w-2.5 rounded-full bg-cyan-500"></span>
                                Terhubung untuk alumni, kampus, dan admin
                            </div>
                            <h2 class="mt-6 max-w-3xl font-serif text-4xl font-semibold leading-tight text-slate-950 sm:text-5xl lg:text-6xl">
                                Bangun hubungan alumni yang hidup, terukur, dan siap mendukung karier.
                            </h2>
                            <p class="mt-6 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
                                Portal alumni ini menyatukan informasi karier, tracer study, dan statistik kampus dalam satu alur yang rapi, ringan, dan mudah diakses dari berbagai perangkat.
                            </p>

                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                <a href="{{ route('register') }}" class="btn-primary !rounded-full !px-6 !py-3">Mulai Sekarang</a>
                                <a href="{{ route('login') }}" class="btn-secondary !rounded-full !px-6 !py-3">Masuk ke Portal</a>
                            </div>


                        </div>

                        <div class="grid gap-5">
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div class="rounded-[28px] border border-slate-200/80 bg-white/80 p-6 shadow-md shadow-slate-200/40">
                                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-cyan-700">Mahasiswa & Alumni</p>
                                    <h3 class="mt-3 text-2xl font-semibold text-slate-950">Temukan peluang yang relevan</h3>
                                    <p class="mt-3 text-sm leading-7 text-slate-600">Cari lowongan, daftar kegiatan, dan simpan perjalanan karier dalam satu akun yang mudah dipakai.</p>
                                </div>
                                <div class="rounded-[28px] border border-slate-200/80 bg-slate-950 p-6 text-white shadow-md shadow-slate-300/30">
                                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-amber-300">Admin Kampus</p>
                                    <h3 class="mt-3 text-2xl font-semibold">Pantau data dengan cepat</h3>
                                    <p class="mt-3 text-sm leading-7 text-slate-300">Kelola user, konten, tracer study, dan laporan dari dashboard yang lebih visual dan terukur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
                    <div class="rounded-[36px] border border-white/70 bg-white/85 p-6 shadow-xl shadow-slate-200/60 backdrop-blur sm:p-8 lg:p-10">
                        <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Alur Utama</p>
                                <h3 class="mt-3 text-3xl font-semibold text-slate-950">Satu portal untuk seluruh perjalanan alumni</h3>
                            </div>
                            <p class="max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">Dari registrasi sampai pelaporan, semua dirancang agar kampus bisa melihat aktivitas alumni dengan lebih jelas.</p>
                        </div>

                        <div class="mt-8 grid gap-4 lg:grid-cols-4">
                            <div class="rounded-[28px] border border-slate-200 bg-slate-50 p-5">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-950 text-sm font-bold text-white">1</span>
                                <h4 class="mt-4 text-xl font-semibold text-slate-900">Buat akun</h4>
                                <p class="mt-2 text-sm leading-7 text-slate-600">Mahasiswa, alumni, atau admin masuk ke portal sesuai perannya.</p>
                            </div>
                            <div class="rounded-[28px] border border-slate-200 bg-slate-50 p-5">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-cyan-600 text-sm font-bold text-white">2</span>
                                <h4 class="mt-4 text-xl font-semibold text-slate-900">Aktifkan profil</h4>
                                <p class="mt-2 text-sm leading-7 text-slate-600">Lengkapi identitas, riwayat, dan preferensi karier dengan cepat.</p>
                            </div>
                            <div class="rounded-[28px] border border-slate-200 bg-slate-50 p-5">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-amber-500 text-sm font-bold text-white">3</span>
                                <h4 class="mt-4 text-xl font-semibold text-slate-900">Ikuti peluang</h4>
                                <p class="mt-2 text-sm leading-7 text-slate-600">Jelajahi lowongan dan kegiatan karier yang sedang tersedia.</p>
                            </div>
                            <div class="rounded-[28px] border border-slate-200 bg-slate-50 p-5">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600 text-sm font-bold text-white">4</span>
                                <h4 class="mt-4 text-xl font-semibold text-slate-900">Lihat insight</h4>
                                <p class="mt-2 text-sm leading-7 text-slate-600">Tracer study membantu kampus membaca outcome alumni secara real time.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="rounded-[32px] border border-slate-200/80 bg-white/90 p-6 shadow-lg shadow-slate-200/50 sm:p-8">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-700">Lowongan Unggulan</p>
                                    <h3 class="mt-2 text-2xl font-semibold text-slate-950">Peluang terbaru untuk alumni</h3>
                                </div>
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-cyan-700">Masuk untuk lihat semua</a>
                            </div>
                            <div class="mt-6 space-y-4">
                                @forelse ($featuredJobs as $job)
                                    <div class="rounded-[24px] border border-slate-200 bg-slate-50 p-5">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <p class="text-lg font-semibold text-slate-900">{{ $job->title }}</p>
                                                <p class="mt-1 text-sm text-slate-500">{{ $job->company }} • {{ $job->location }}</p>
                                            </div>
                                            <span class="rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-cyan-700">Aktif</span>
                                        </div>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit($job->description, 110) }}</p>
                                    </div>
                                @empty
                                    <p class="rounded-[24px] border border-dashed border-slate-300 bg-slate-50 p-5 text-sm text-slate-500">Belum ada lowongan publik saat ini.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="rounded-[32px] border border-slate-200/80 bg-slate-950 p-6 text-white shadow-lg shadow-slate-300/30 sm:p-8">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-300">Kegiatan Terdekat</p>
                                    <h3 class="mt-2 text-2xl font-semibold">Agenda yang sedang menunggu Anda</h3>
                                </div>
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-cyan-300">Masuk untuk mendaftar</a>
                            </div>
                            <div class="mt-6 space-y-4">
                                @forelse ($featuredEvents as $event)
                                    <div class="rounded-[24px] border border-white/10 bg-white/5 p-5 backdrop-blur">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <p class="text-lg font-semibold">{{ $event->title }}</p>
                                                <p class="mt-1 text-sm text-slate-300">{{ $event->event_type }} • {{ $event->start_at->format('d M Y H:i') }}</p>
                                            </div>
                                            <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-amber-200">Terjadwal</span>
                                        </div>
                                        <p class="mt-3 text-sm leading-7 text-slate-300">{{ \Illuminate\Support\Str::limit($event->description, 110) }}</p>
                                    </div>
                                @empty
                                    <p class="rounded-[24px] border border-white/10 bg-white/5 p-5 text-sm text-slate-300">Belum ada kegiatan publik saat ini.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto max-w-7xl px-4 pb-16 pt-8 sm:px-6 lg:px-8 lg:pb-24">
                    <div class="relative overflow-hidden rounded-[40px] bg-[linear-gradient(135deg,#082f49_0%,#0f172a_45%,#164e63_100%)] px-6 py-10 text-white shadow-2xl shadow-slate-400/30 sm:px-10 lg:px-12">
                        <div class="absolute inset-y-0 right-0 hidden w-1/2 bg-[radial-gradient(circle_at_center,_rgba(255,255,255,0.16),_transparent_55%)] lg:block"></div>
                        <div class="relative grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300">Siap Digunakan</p>
                                <h3 class="mt-4 max-w-3xl text-3xl font-semibold leading-tight sm:text-4xl">Mulai dari landing page ini, lanjutkan ke dashboard, dan kelola ekosistem alumni dalam satu alur.</h3>
                                <p class="mt-4 max-w-2xl text-base leading-8 text-slate-200">Pengguna bisa memulai dari halaman utama, menjelajahi informasi penting, lalu masuk ke dashboard untuk mengelola aktivitas dan data alumni dengan lebih lengkap.</p>
                            </div>
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('register') }}" class="btn-primary !rounded-full !bg-white !px-6 !py-3 !text-slate-950 hover:!bg-cyan-100">Buat Akun</a>
                                <a href="{{ route('login') }}" class="btn-secondary !rounded-full !border-white/20 !bg-white/5 !px-6 !py-3 !text-white hover:!bg-white/10">Masuk</a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>

        @if (count($publicTracerChart['labels']) > 0)
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const landingTracerChart = @json($publicTracerChart);
                const landingTracerCanvas = document.getElementById('landingTracerChart');

                if (landingTracerCanvas) {
                    new Chart(landingTracerCanvas, {
                        type: 'bar',
                        data: {
                            labels: landingTracerChart.labels,
                            datasets: [{
                                label: 'Jumlah Alumni',
                                data: landingTracerChart.values,
                                backgroundColor: ['#0f172a', '#0891b2', '#06b6d4', '#f59e0b', '#14b8a6'],
                                borderRadius: 16,
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
                                        color: 'rgba(148, 163, 184, 0.2)',
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
    </body>
</html>
