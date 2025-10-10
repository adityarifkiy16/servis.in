@extends('layouts.admin')

@section('title', 'Service Management')

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
        <h1 class="text-2xl font-bold mb-4">Service Management</h1>
        <div class="mb-4 flex justify-between items-center w-full gap-2">
            <label class="input input-bordered flex items-center gap-2 w-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.2-5.2m0 0A7.5 7.5 0 1 0 5.2 5.2a7.5 7.5 0 0 0 10.6 10.6z" />
                </svg>
                <input type="text" placeholder="Search products..." class="bg-transparent focus:outline-none"
                    id="search" />
            </label>

            <div class="flex gap-2 w-full">
                <a href="{{ route('service.create') }}" class="btn btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    Add New Service</a>
                <form action="{{ route('service.index') }}" method="GET" class="flex items-center gap-2">
                    <!-- Filter Departemen -->
                    <select name="department_id" class="select select-bordered">
                        <option value="">Departemen</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}"
                                {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter Status -->
                    <select name="status" class="select select-bordered">
                        <option value=""> Status </option>
                        <option value="0" {{ request('status') !== null ? 'selected' : '' }}>Pending</option>
                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Proses</option>
                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Selesai</option>
                    </select>

                    <!-- Filter Layanan Servis -->
                    <select name="service_type_id" class="select select-bordered">
                        <option value="">Layanan</option>
                        @foreach ($servicetypes as $type)
                            <option value="{{ $type->id }}"
                                {{ request('service_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter Tanggal -->
                    <input type="date" name="date" class="input input-bordered" value="{{ request('date') }}">

                    <button type="submit" class="btn btn-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                    </button>
                </form>

            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Layanan Servis</th>
                        <th>Tanggal Servis</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($services->isNotEmpty())
                        @foreach ($services as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="font-bold">{{ $data->product->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="font-bold">{{ $data->servicetype->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="font-bold">
                                            {{ \Carbon\Carbon::parse($data->date)->locale('id')->translatedFormat('d F Y') }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        @switch($data->status)
                                            @case(0)
                                                <div class="font-bold text-warning">Pending</div>
                                            @break

                                            @case(1)
                                                <div class="font-bold text-info">In Progress</div>
                                            @break

                                            @case(2)
                                                <div class="font-bold text-success">Selesai</div>
                                            @break
                                        @endswitch
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('service.edit', $data->id) }}" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-5">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path
                                                d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete({{ $data->id }})" class="btn btn-error btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-5">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No Service found.</td>
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
            <h3 class="font-bold text-lg">Confirm Delete</h3>
            <p class="py-4">Are you sure you want to delete this user? This action cannot be undone.</p>
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
                    window.location.href = `/services?search=${encodeURIComponent(query)}`;
                } else {
                    window.location.href = '/services';
                }
            }
        });

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
            form.action = "{{ route('service.delete', ':id') }}".replace(':id', userId);
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
