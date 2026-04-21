<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Sistem Alumni</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #0f172a; font-size: 11px; margin: 28px; }
        .header { border-bottom: 2px solid #0f172a; padding-bottom: 12px; margin-bottom: 18px; }
        .title { font-size: 20px; font-weight: bold; margin: 0 0 4px 0; }
        .subtitle { font-size: 11px; color: #475569; margin: 0; }
        .meta { margin-top: 10px; font-size: 10px; color: #475569; }
        .summary { width: 100%; margin: 12px 0 18px; }
        .summary td { border: 1px solid #cbd5e1; padding: 10px; width: 20%; }
        .summary .label { display: block; font-size: 10px; color: #64748b; }
        .summary .value { display: block; margin-top: 4px; font-size: 18px; font-weight: bold; }
        h2 { font-size: 14px; margin: 18px 0 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #cbd5e1; padding: 7px; text-align: left; vertical-align: top; }
        th { background: #e2e8f0; }
        .muted { color: #64748b; }
        .signature { margin-top: 42px; width: 100%; }
        .signature td { border: none; width: 50%; vertical-align: top; }
        .sign-box { padding-top: 48px; }
    </style>
</head>
<body>
    <div class="header">
        <p class="title">Laporan Resmi Sistem Manajemen Alumni</p>
        <p class="subtitle">Portal Alumni dan Pusat Karier Kampus</p>
        <p class="meta">
            Tanggal cetak: {{ $reportData['meta']['generated_at']->format('d F Y H:i') }}<br>
            Dibuat oleh: {{ $reportData['meta']['generated_by'] }}
        </p>
    </div>

    <table class="summary">
        <tr>
            <td><span class="label">Total Pengguna</span><span class="value">{{ $reportData['summary']['users'] }}</span></td>
            <td><span class="label">Total Lowongan</span><span class="value">{{ $reportData['summary']['jobs'] }}</span></td>
            <td><span class="label">Total Kegiatan</span><span class="value">{{ $reportData['summary']['events'] }}</span></td>
            <td><span class="label">Pendaftaran</span><span class="value">{{ $reportData['summary']['registrations'] }}</span></td>
            <td><span class="label">Tracer Study</span><span class="value">{{ $reportData['summary']['tracerStudies'] }}</span></td>
        </tr>
    </table>

    <h2>Distribusi Tracer Study</h2>
    <table>
        <thead>
            <tr><th>Status</th><th>Jumlah</th></tr>
        </thead>
        <tbody>
            @foreach ($reportData['tracerDistribution'] as $status => $total)
                <tr>
                    <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                    <td>{{ $total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Daftar Pengguna</h2>
    <table>
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach ($reportData['users']->take(12) as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->user_type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Ringkasan Kegiatan Karier</h2>
    <table>
        <thead>
            <tr><th>Nama Kegiatan</th><th>Jenis</th><th>Lokasi</th><th>Pendaftar</th></tr>
        </thead>
        <tbody>
            @foreach ($reportData['events']->take(10) as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->event_type }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->registrations_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Ringkasan Tracer Study Terbaru</h2>
    <table>
        <thead>
            <tr><th>Nama</th><th>Status Pekerjaan</th><th>Perusahaan</th><th>Relevansi</th></tr>
        </thead>
        <tbody>
            @foreach ($reportData['tracerStudies']->take(10) as $study)
                <tr>
                    <td>{{ $study->user?->name }}</td>
                    <td>{{ $study->employment_status }}</td>
                    <td>{{ $study->company_name ?: '-' }}</td>
                    <td>{{ $study->relevance_level }}/5</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="signature">
        <tr>
            <td>
                <div class="muted">Mengetahui,</div>
                <div class="sign-box">Kepala Pusat Karier</div>
            </td>
            <td style="text-align:right;">
                <div class="muted">Dicetak oleh,</div>
                <div class="sign-box">{{ $reportData['meta']['generated_by'] }}</div>
            </td>
        </tr>
    </table>
</body>
</html>
