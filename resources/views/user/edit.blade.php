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
                    User Management
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

                    Edit User
                </span>
            </li>
        </ul>
    </div>
    <div class="w-full max-w-7xl px-6 py-4">
        <h2 class="text-2xl font-bold mb-6">Edit User</h2>
        <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">Please fill in the form below to edit user</p>
        <form action="{{ route('user.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="input input-bordered w-full" required />
                @error('name')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="input input-bordered w-full" required />
                @error('email')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Role -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Role</span>
                </label>
                <select name="roles_id" class="select select-bordered w-full">
                    <option disabled>Pilih role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
                @error('roles_id')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>


            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('user.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
