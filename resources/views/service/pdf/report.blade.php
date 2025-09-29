<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            /* beri jarak ke area TTD */
        }

        table th,
        table td {
            border: 1px solid #333;
            padding: 6px 10px;
            text-align: left;
        }

        table th {
            background-color: #f0f0f0;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 4px;
            color: white;
            font-size: 11px;
        }

        .badge-pending {
            background-color: #f0ad4e;
        }

        .badge-proses {
            background-color: #5bc0de;
        }

        .badge-selesai {
            background-color: #5cb85c;
        }

        .text-center {
            text-align: center;
        }

        .ttd-section {
            width: 100%;
            margin-top: 60px;
        }

        .ttd-box {
            width: 45%;
            display: inline-block;
            text-align: center;
            vertical-align: top;
        }

        .ttd-space {
            height: 80px;
            /* ruang kosong untuk tanda tangan */
        }
    </style>
</head>

<body>
    <h2>Laporan Service</h2>

    <table>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Barang</th>
                <th>Layanan Servis</th>
                <th>Tanggal Servis</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $index => $service)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $service->product->name ?? '-' }}</td>
                    <td>{{ $service->serviceType->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($service->date)->format('d-m-Y') }}</td>
                    <td>
                        @if ($service->status == 0)
                            <span class="badge badge-pending">Pending</span>
                        @elseif($service->status == 1)
                            <span class="badge badge-proses">Proses</span>
                        @elseif($service->status == 2)
                            <span class="badge badge-selesai">Selesai</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Bagian TTD -->
    <div class="ttd-section">
        <div class="ttd-box">
            <div class="ttd-space"></div>
            <strong>PIC</strong><br><br><br><br>
            <p>............................</p>
        </div>
        <div class="ttd-box" style="float: right;">
            <div class="ttd-space"></div>
            <strong>Teknisi</strong><br><br><br><br>
            <p>............................</p>
        </div>
    </div>

</body>

</html>
