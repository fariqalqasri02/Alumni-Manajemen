<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Manajemen Alumni</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-slate-900">
        <div class="landing-page min-h-screen overflow-x-hidden">
            <header class="relative z-10">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-6 sm:px-6 lg:px-8">
                    <div>
                        <p class="kicker text-cyan-700" style="letter-spacing: 0.4em">Portal Alumni</p>
                        <h1 class="mt-2 text-lg font-semibold text-slate-900 sm:text-xl">Sistem Manajemen Alumni</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="btn-pill-secondary">Login</a>
                        <a href="{{ route('register') }}" class="btn-pill-primary">Registrasi</a>
                    </div>
                </div>
            </header>

            <main>
                <section class="mx-auto max-w-7xl px-4 pb-10 pt-6 sm:px-6 lg:px-8 lg:pt-10">
                    <div class="landing-main-grid">
                        <div data-reveal>
                            <div class="eyebrow-chip">
                                <span class="h-2.5 w-2.5 rounded-full bg-cyan-500"></span>
                                Portal untuk alumni, mahasiswa, dan admin kampus
                            </div>

                            <h2 class="mt-6 max-w-4xl font-serif text-4xl font-semibold leading-tight text-slate-950 sm:text-5xl lg:text-6xl">
                                Satu pintu untuk menjaga koneksi alumni tetap aktif, rapi, dan mudah dikelola.
                            </h2>

                            <p class="mt-6 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
                                Landing page ini dibuat sebagai gerbang yang jelas untuk masuk ke sistem. Pengguna bisa langsung memahami manfaat portal, memilih perannya, lalu melanjutkan ke dashboard yang lebih lengkap.
                            </p>

                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                <a href="{{ route('register') }}" class="btn-pill-primary">Mulai Sekarang</a>
                                <a href="{{ route('login') }}" class="btn-pill-secondary">Masuk ke Portal</a>
                            </div>

                            <div class="mt-8 grid gap-3 sm:grid-cols-3">
                                <div class="landing-soft-card">
                                    <p class="kicker text-slate-500">Terpusat</p>
                                    <p class="mt-3 text-sm leading-6 text-slate-700">Lowongan, kegiatan, tracer study, dan laporan ada dalam satu alur.</p>
                                </div>
                                <div class="landing-soft-card">
                                    <p class="kicker text-slate-500">Responsif</p>
                                    <p class="mt-3 text-sm leading-6 text-slate-700">Nyaman diakses dari desktop, tablet, maupun perangkat mobile.</p>
                                </div>
                                <div class="landing-soft-card">
                                    <p class="kicker text-slate-500">Jelas</p>
                                    <p class="mt-3 text-sm leading-6 text-slate-700">Dashboard disusun berdasarkan peran agar tugas utama cepat ditemukan.</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-5" data-reveal>
                            <div class="hero-grid">
                                <div class="relative z-10">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="kicker-wide text-cyan-700">Akses Cepat</p>
                                            <h3 class="mt-3 text-3xl font-semibold text-slate-950">Masuk sesuai kebutuhan Anda</h3>
                                        </div>
                                        <div class="floating-orb rounded-3xl bg-slate-950 px-4 py-3 text-right text-white shadow-lg shadow-slate-300/40">
                                            <p class="kicker text-cyan-200">Portal</p>
                                            <p class="mt-1 text-2xl font-bold">24/7</p>
                                        </div>
                                    </div>

                                    <div class="mt-6 grid gap-4">
                                        <div class="landing-hero-card bg-slate-50/90 hover:shadow-cyan-100/50">
                                            <div class="flex items-center gap-3">
                                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700">A</span>
                                                <div>
                                                    <p class="text-lg font-semibold text-slate-900">Mahasiswa & Alumni</p>
                                                    <p class="text-sm text-slate-500">Kelola profil, peluang, dan aktivitas akun.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="landing-hero-card bg-slate-950 text-white hover:shadow-slate-400/30">
                                            <div class="flex items-center gap-3">
                                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-400/20 text-amber-300">B</span>
                                                <div>
                                                    <p class="text-lg font-semibold">Admin Kampus</p>
                                                    <p class="text-sm text-slate-300">Kelola data inti dan pantau laporan dari dashboard.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 rounded-3xl border border-dashed border-slate-300 bg-white/70 p-5">
                                        <p class="kicker-wide text-slate-500">Yang Bisa Dilakukan</p>
                                        <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                            <div class="rounded-2xl bg-slate-50 p-4">
                                                <p class="font-semibold text-slate-900">Temukan lowongan</p>
                                                <p class="mt-1 text-sm text-slate-500">Akses info karier yang dibuka kampus atau mitra.</p>
                                            </div>
                                            <div class="rounded-2xl bg-slate-50 p-4">
                                                <p class="font-semibold text-slate-900">Ikuti kegiatan</p>
                                                <p class="mt-1 text-sm text-slate-500">Daftar event karier dan pantau riwayat pendaftaran.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                    <div class="landing-panel" data-reveal>
                        <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
                            <div>
                                <p class="kicker-wide text-slate-500">Alur Utama</p>
                                <h3 class="mt-3 text-3xl font-semibold text-slate-950">Perjalanan pengguna dibuat ringkas, jelas, dan mudah diikuti</h3>
                            </div>
                            <p class="max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                                Pengguna tidak perlu membaca terlalu banyak di halaman depan. Cukup pahami alurnya, lalu masuk ke sistem untuk melihat detail yang lebih operasional.
                            </p>
                        </div>

                        <div class="mt-8 grid gap-4 lg:grid-cols-4">
                            <div class="landing-section-card">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-950 text-sm font-bold text-white">1</span>
                                <h4 class="mt-4 text-xl font-semibold text-slate-900">Buat akun</h4>
                                <p class="mt-2 text-sm leading-7 text-slate-600">Masuk ke sistem dengan peran yang sesuai sejak awal.</p>
                            </div>
                            <div class="landing-section-card">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-cyan-600 text-sm font-bold text-white">2</span>
                                <h4 class="mt-4 text-xl font-semibold text-slate-900">Lengkapi profil</h4>
                                <p class="mt-2 text-sm leading-7 text-slate-600">Isi data akademik dan identitas yang dibutuhkan portal.</p>
                            </div>
                            <div class="landing-section-card">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-amber-500 text-sm font-bold text-white">3</span>
                                <h4 class="mt-4 text-xl font-semibold text-slate-900">Gunakan fitur utama</h4>
                                <p class="mt-2 text-sm leading-7 text-slate-600">Lihat lowongan, kegiatan, dan isi tracer study saat dibutuhkan.</p>
                            </div>
                            <div class="landing-section-card">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600 text-sm font-bold text-white">4</span>
                                <h4 class="mt-4 text-xl font-semibold text-slate-900">Pantau dashboard</h4>
                                <p class="mt-2 text-sm leading-7 text-slate-600">Lanjutkan aktivitas dari halaman yang sudah disesuaikan dengan peran.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="rounded-4xl border border-slate-200/80 bg-white/90 p-6 shadow-lg shadow-slate-200/50 sm:p-8" data-reveal>
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="meta-badge text-cyan-700">Lowongan Unggulan</p>
                                    <h3 class="mt-2 text-2xl font-semibold text-slate-950">Peluang terbaru untuk alumni</h3>
                                </div>
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-cyan-700">Lihat semua</a>
                            </div>
                            <div class="mt-6 space-y-4">
                                @forelse ($featuredJobs as $job)
                                    <div class="dashboard-link-card">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <p class="text-lg font-semibold text-slate-900">{{ $job->title }}</p>
                                                <p class="mt-1 text-sm text-slate-500">{{ $job->company }} &middot; {{ $job->location }}</p>
                                            </div>
                                            <span class="rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-cyan-700">Aktif</span>
                                        </div>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit($job->description, 110) }}</p>
                                    </div>
                                @empty
                                    <p class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-5 text-sm text-slate-500">Belum ada lowongan publik saat ini.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="rounded-4xl border border-slate-200/80 bg-slate-950 p-6 text-white shadow-lg shadow-slate-300/30 sm:p-8" data-reveal>
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="meta-badge text-amber-300">Kegiatan Terdekat</p>
                                    <h3 class="mt-2 text-2xl font-semibold">Agenda yang sedang menunggu Anda</h3>
                                </div>
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-cyan-300">Masuk untuk mendaftar</a>
                            </div>
                            <div class="mt-6 space-y-4">
                                @forelse ($featuredEvents as $event)
                                    <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur transition duration-300 hover:-translate-y-1 hover:bg-white/10">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <p class="text-lg font-semibold">{{ $event->title }}</p>
                                                <p class="mt-1 text-sm text-slate-300">{{ $event->event_type }} &middot; {{ $event->start_at->format('d M Y H:i') }}</p>
                                            </div>
                                            <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-amber-200">Terjadwal</span>
                                        </div>
                                        <p class="mt-3 text-sm leading-7 text-slate-300">{{ \Illuminate\Support\Str::limit($event->description, 110) }}</p>
                                    </div>
                                @empty
                                    <p class="rounded-3xl border border-white/10 bg-white/5 p-5 text-sm text-slate-300">Belum ada kegiatan publik saat ini.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto max-w-7xl px-4 pb-16 pt-8 sm:px-6 lg:px-8 lg:pb-24">
                    <div class="landing-cta" data-reveal>
                        <div class="landing-cta-glow absolute inset-y-0 right-0 hidden w-1/2 lg:block"></div>
                        <div class="landing-cta-layout relative">
                            <div>
                                <p class="kicker-wide text-cyan-300">Siap Digunakan</p>
                                <h3 class="mt-4 max-w-3xl text-3xl font-semibold leading-tight sm:text-4xl">Masuk ke portal dan lanjutkan aktivitas dari dashboard yang paling relevan untuk Anda.</h3>
                                <p class="mt-4 max-w-2xl text-base leading-8 text-slate-200">Tampilan depan kini lebih ringan, sementara pekerjaan utama tetap diarahkan ke halaman dalam yang memang dibuat untuk pengelolaan data dan aktivitas.</p>
                            </div>
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('register') }}" class="btn-pill-contrast">Buat Akun</a>
                                <a href="{{ route('login') }}" class="btn-pill-light">Masuk</a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
