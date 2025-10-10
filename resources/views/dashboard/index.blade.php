@extends('layouts.admin')

@section('title', 'Jenis Management')

@section('content')
    <div class="px-6 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-base-content">Admin Dashboard</h1>
                <p class="text-base-500">Kelola pengguna, peran, dan izin dengan mudah dari sini.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($count as $key => $value)
                <div
                    class="card shadow-md hover:shadow-xl transition-all duration-300 rounded-2xl p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="font-semibold">
                            @if ($key == 'services_schedules')
                                Pending Services
                            @else
                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                            @endif
                        </div>
                        <div class="p-2 rounded-full bg-gray-100 text-gray-600">
                            @if ($key == 'services_schedules')
                                {{-- Icon Warning / Schedule --}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71
                                                                                                                            c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378
                                                                                                                            c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12
                                                                                                                            15.75h.007v.008H12v-.008Z" />
                                </svg>
                            @elseif ($key == 'users')
                                {{-- Icon User --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="size-6">
                                    <path
                                        d="M8.5 4.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10.9 12.006c.11.542-.348.994-.9.994H2c-.553 0-1.01-.452-.902-.994a5.002 5.002 0 0 1 9.803 0ZM14.002 12h-1.59a2.556 2.556 0 0 0-.04-.29 6.476 6.476 0 0 0-1.167-2.603 3.002 3.002 0 0 1 3.633 1.911c.18.522-.283.982-.836.982ZM12 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                </svg>
                            @else
                                {{-- Icon Document (Default) --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h8m-9 8h10a2 2 0
                                                                                                                            002-2V6a2 2 0 00-2-2H9l-2 2H5a2
                                                                                                                            2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            @endif
                        </div>

                    </div>
                    <p class="text-4xl font-bold">{{ $value }}</p>
                    <div class="mt-2 text-sm text-gray-500">Total data terdaftar</div>
                </div>
            @endforeach
        </div>

        <div class="card bg-base-100 shadow-md rounded-2xl border border-base-200 my-6">
            <div class="card-body p-6">
                <div class="flex items-center justify-between border-b border-base-200 pb-4 mb-4">
                    <h2 class="card-title text-lg font-semibold text-base-content">Riwayat Service Terbaru</h2>
                    <a href="{{ route('service.index') }}" class="btn btn-link text-primary no-underline text-sm">Lihat
                        semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead class="bg-base-200 text-base-content/70 text-sm uppercase">
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Jenis Service</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentServices as $index => $service)
                                <tr class="hover">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="font-medium">{{ $service->product->name }}</td>
                                    <td>{{ $service->serviceType->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($service->date)->format('d M y') }}</td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                '0' => 'badge-secondary',
                                                '1' => 'badge-info',
                                                '2' => 'badge-success',
                                            ];
                                            $statusText = [
                                                '0' => 'Pending',
                                                '1' => 'In Progress',
                                                '2' => 'Completed',
                                            ];
                                        @endphp
                                        <div
                                            class="badge badge-soft {{ $statusClasses[$service->status] ?? 'badge-ghost' }} text-xs px-3 py-2">
                                            {{ $statusText[$service->status] ?? 'Unknown' }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-base-content/60 py-4 text-sm">
                                        Belum ada riwayat service terbaru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
