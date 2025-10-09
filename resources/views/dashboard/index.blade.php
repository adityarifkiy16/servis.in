@extends('layouts.admin')

@section('title', 'Jenis Management')

@section('content')
    <div class="px-6 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
                <p class="text-gray-500">Kelola pengguna, peran, dan izin dengan mudah dari sini.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($count as $key => $value)
                <div
                    class="bg-white shadow-md hover:shadow-xl transition-all duration-300 rounded-2xl p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-gray-600 font-semibold">
                            @if ($key == 'services_schedules')
                                Pending Services
                            @else
                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                            @endif
                        </div>
                        <div class="p-2 rounded-full bg-indigo-100 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-800">{{ $value }}</p>
                    <div class="mt-2 text-sm text-gray-400">Total data terdaftar</div>
                </div>
            @endforeach
        </div>

        <div class="bg-white shadow-md rounded-2xl border border-gray-100 mt-5">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800">Riwayat Service Terbaru</h2>
                <a href="{{ route('service.index') }}" class="text-indigo-600 text-sm hover:underline">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Produk</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Jenis
                                Service</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($recentServices as $index => $service)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3 text-gray-700 text-sm">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 text-gray-800 font-medium">{{ $service->product->name }}</td>
                                <td class="px-6 py-3 text-gray-600">{{ $service->serviceType->name }}</td>
                                <td class="px-6 py-3 text-gray-600">
                                    {{ \Carbon\Carbon::parse($service->date)->format('d M y') }}</td>
                                <td class="px-6 py-3">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold 
                                    @if ($service->status == '0') bg-yellow-100 text-yellow-700 
                                    @elseif($service->status == '1') bg-green-100 text-green-700 
                                    @elseif($service->status == '2') bg-green-100 text-green-700 
                                    @else bg-gray-100 text-gray-700 @endif">
                                        {{ $service->status == '0' ? 'Pending' : ($service->status == '1' ? 'In Progress' : ($service->status == '2' ? 'Completed' : 'Unknown')) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-400 text-sm">Belum ada riwayat
                                    service terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
