@extends('layouts.app')

@section('title', 'Login')

@section('content')
    {{-- Latar belakang utama yang memenuhi seluruh layar --}}
    <div class="flex min-h-screen items-center justify-center bg-base-200 p-4 lg:p-8">
        <div class="card lg:card-side w-full max-w-5xl bg-base-100 shadow-xl">

            <figure class="w-1/2 p-8 hidden lg:block">
                <img src="{{ asset('img/login-light.png') }}" alt="Login Illustration"
                    class="hidden lg:block h-auto w-full object-contain" id="login-illustration">
            </figure>

            <div class="card-body w-full lg:w-1/2">
                <div class="flex flex-row items-center justify-center gap-2">
                    <img src="{{ asset('img/logo-light.svg') }}" id="main-logo" alt="logo" class="w-8">
                    <!-- Theme Switch -->
                    <label class="swap swap-rotate">
                        <input type="checkbox" class="theme-controller opacity-0" />
                        <!-- sun icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 swap-on">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>


                        <!-- moon icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 swap-off">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>

                    </label>
                </div>

                <div class="space-y-3">
                    <h1 class="text-center text-2xl font-bold mb-1">Selamat Datang!</h1>
                    <p class="mb-2 text-center text-sm text-base-content/70">Silakan masuk untuk melanjutkan.</p>

                    @if ($errors->any())
                        <div role="alert"
                            class="alert alert-error text-sm transition-opacity duration-500 ease-in-out mb-3"
                            id="flash-message">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-bold">Terjadi Kesalahan!</h3>
                                <ul class="list-inside list-disc">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="label">
                            <span class="label-text">Alamat Email</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full"
                            required autofocus placeholder="nama@email.com">
                    </div>

                    <div>
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="password" class="input input-bordered w-full" required
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex cursor-pointer items-center gap-2">
                            <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm">
                            <span class="label-text">Ingat Saya</span>
                        </label>
                        <a href="#" class="link-hover link link-primary">Lupa password?</a>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary w-full">
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const flashMessages = document.querySelectorAll('.alert');

            flashMessages.forEach(flash => {
                setTimeout(() => {
                    flash.classList.add('opacity-0'); // animasi fade out
                    setTimeout(() => {
                        flash.remove(); // benar-benar hilang
                    }, 500);
                }, 5000); // 5 detik
            });


        });
    </script>
@endpush
