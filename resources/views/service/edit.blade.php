@extends('layouts.admin')

@section('content')
    <div class="breadcrumbs text-sm">
        <ul>
            <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z"
                            clip-rule="evenodd" />
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z"
                            clip-rule="evenodd" />
                    </svg>
                    Service Management
                </a>
            </li>
            <li>
                <span class="inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path
                            d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                        <path
                            d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                    </svg>

                    Edit Service
                </span>
            </li>
        </ul>
    </div>
    <div class="w-full max-w-7xl px-6 py-4">
        <h2 class="text-2xl font-bold mb-6">Edit Service</h2>
        <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">Please fill in the form below to edit</p>
        <form action="{{ route('service.update', $service->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Layanan Servis</span>
                </label>
                <select id="service_type_id" name="service_type_id" class="select select-bordered w-full">
                    <option disabled {{ $service->service_type_id ? '' : 'selected' }}>Pilih Tipe Servis</option>
                    @foreach ($servicetypes as $data)
                        <option value="{{ $data->id }}" data-jenis="{{ $data->jenis_id }}"
                            {{ $service->service_type_id == $data->id ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>

                @error('service_type_id')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Product -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Barang</span>
                </label>
                <select id="product_id" name="product_id" class="select select-bordered w-full">
                    <option disabled {{ $service->product_id ? '' : 'selected' }}>Pilih Barang</option>
                    @foreach ($products as $data)
                        <option value="{{ $data->id }}" data-jenis="{{ $data->jenis_id }}"
                            {{ $service->product_id == $data->id ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>

                @error('product_id')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Interval Month -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Tanggal Servis</span>
                </label>
                <input type="date" name="date"
                    value="{{ old('date', \Carbon\Carbon::parse($service->date)->format('Y-m-d')) }}"
                    class="input input-bordered w-full" />
                @error('date')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Catatan User</span>
                </label>
                <textarea name="description" class="textarea textarea-bordered w-full" rows="4">{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            @if (auth()->user()->hasPermission('update_status'))
                <!-- Description -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Catatan Teknisi</span>
                    </label>
                    <textarea name="desc_tech" class="textarea textarea-bordered w-full" rows="4">{{ old('desc_tech', $service->desc_tech) }}</textarea>
                    @error('description')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Status</span>
                    </label>
                    <select name="status" class="select select-bordered w-full">
                        <option value="0" {{ $service->status == '0' ? 'selected' : '' }}>Pending</option>
                        <option value="1" {{ $service->status == '1' ? 'selected' : '' }}>In Progress</option>
                        <option value="2" {{ $service->status == '2' ? 'selected' : '' }}>Done</option>
                    </select>
                    @error('status')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('service.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const serviceSelect = $("#service_type_id");
            const productSelect = $("#product_id");

            function filterProducts(firstload = false) {
                const selectedJenis = serviceSelect.find("option:selected").data("jenis");
                productSelect.find("option").each(function() {
                    const jenis = $(this).data("jenis");

                    if (!jenis) {
                        // placeholder "Pilih Barang" selalu tampil
                        $(this).show();
                    } else if (jenis === selectedJenis) {

                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                if (firstload) {
                    const currentProductId = "{{ $service->product_id }}";
                    if (currentProductId) {
                        productSelect.val(currentProductId);
                    }
                } else {
                    productSelect.prop('selectedIndex', 0);
                }
            }

            // Jalankan filter pertama kali saat load
            filterProducts(true);
            serviceSelect.change(() => filterProducts(false));
        });
    </script>
@endpush
