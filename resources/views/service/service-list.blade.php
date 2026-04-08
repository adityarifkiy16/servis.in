@extends('layouts.admin')

@section('title', 'List Service for ' . $product->name)

@section('content')
    {{-- Flash Message - Improved Version --}}
    @if (session('success'))
        <div class="alert alert-success mb-4 transition-opacity duration-500 ease-in-out" id="flash-message">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
            {{-- Close Button --}}
            <button type="button" class="btn btn-sm btn-ghost ml-auto" onclick="closeFlashMessage()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    {{-- Error Flash Message --}}
    @if (session('error'))
        <div class="alert alert-error mb-4 transition-opacity duration-500 ease-in-out" id="flash-message-error">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn btn-sm btn-ghost ml-auto" onclick="closeFlashMessage('error')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="w-full max-w-7xl mx-auto card bg-base-100 shadow-md rounded-2xl border border-base-200 my-6 p-6">
        <h1 class="text-2xl font-bold mb-4">List Service - {{ $product->name }}</h1>
        <div class="mb-4 flex justify-between items-center">
            <label class="input input-bordered flex items-center gap-2 w-1/3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.2-5.2m0 0A7.5 7.5 0 1 0 5.2 5.2a7.5 7.5 0 0 0 10.6 10.6z" />
                </svg>
                <input type="text" placeholder="Kolom pencarian" class="grow bg-transparent focus:outline-none"
                    id="search" />
            </label>

            <div>
                <a href="{{ route('products.listByDepartment', $product->departement) }}"
                    class="btn btn-outline btn-secondary">
                    Kembali
                </a>
                <a href="{{ route('services.create.byProduct', $product) }}" class="btn btn-outline btn-primary"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg> Tambah Service</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Layanan Service</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($services->isNotEmpty())
                        @foreach ($services as $item)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="font-bold">{{ $loop->iteration }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="font-bold">{{ $item->servicetype?->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-bold">
                                        {{ \Carbon\Carbon::parse($item->date)->locale('id')->translatedFormat('d F Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        @switch($item->status)
                                            @case(0)
                                                <div
                                                    class="flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold text-sm">
                                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                                    Pending
                                                </div>
                                            @break

                                            @case(1)
                                                <div
                                                    class="flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold text-sm">
                                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                                    In Progress
                                                </div>
                                            @break

                                            @case(2)
                                                <div
                                                    class="flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-sm">
                                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                                    Selesai
                                                </div>
                                            @break
                                        @endswitch
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('service.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                        <p class="uppercase">edit</p>
                                    </a>
                                    <button onclick="confirmDelete({{ $item->id }})"
                                        class="btn btn-error btn-sm text-white">
                                        <p class="uppercase">hapus</p>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Tidak ada data.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-4">
                {{ $services->links() }}
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <dialog id="delete_modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
            <p class="py-4">Apakah anda yakin ingin menghapus? aksi ini tidak dapat di undo.</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Cancel</button>
                </form>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">Delete</button>
                </form>
            </div>
        </div>
    </dialog>
@endsection

@push('scripts')
    <script>
        const search = document.getElementById('search');

        search.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault(); // mencegah form auto submit (kalau di dalam <form>)
                const query = search.value.trim();
                if (query !== '') {
                    window.location.href = `/products?search=${encodeURIComponent(query)}`;
                } else {
                    window.location.href = '/products';
                }
            }
        })
        // Flash Message Auto Hide dengan Improved Error Handling
        function autoHideFlashMessage() {
            const flashMessages = document.querySelectorAll('[id^="flash-message"]');

            flashMessages.forEach(flash => {
                if (flash) {
                    // Auto hide after 5 seconds
                    setTimeout(() => {
                        hideFlashMessage(flash);
                    }, 2000);
                }
            });
        }

        // Manual Close Flash Message
        function closeFlashMessage(type = '') {
            const messageId = type ? `flash-message-${type}` : 'flash-message';
            const flash = document.getElementById(messageId);
            if (flash) {
                hideFlashMessage(flash);
            }
        }

        // Hide Flash Message with Animation
        function hideFlashMessage(element) {
            element.classList.add('opacity-0');
            // Remove from DOM after animation completes
            setTimeout(() => {
                element.remove();
            }, 500); // Match with CSS transition duration
        }

        // Delete Confirmation
        function confirmDelete(userId) {
            const modal = document.getElementById('delete_modal');
            const form = document.getElementById('delete-form');
            form.action = "{{ route('service.destroy', ':id') }}".replace(':id', userId);
            modal.showModal();
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            autoHideFlashMessage();
            const params = new URLSearchParams(window.location.search);
            const savedSearch = params.get('search');
            if (savedSearch) {
                search.value = decodeURIComponent(savedSearch);
            }
        });

        // Optional: Pause auto-hide on hover
        document.querySelectorAll('[id^="flash-message"]').forEach(flash => {
            let timeoutId;

            flash.addEventListener('mouseenter', () => {
                clearTimeout(timeoutId);
            });

            flash.addEventListener('mouseleave', () => {
                timeoutId = setTimeout(() => hideFlashMessage(flash), 2000);
            });
        });
    </script>
@endpush
