@extends('layouts.admin')

@section('title', 'Akses Ditolak')

@section('content')
    <div
        class="glass flex flex-row justify-center items-center card shadow-xl w-full max-w-md mx-auto p-8 relative bg-base-100">

        {{-- Gambar ilustrasi --}}
        <img src="{{ asset('img/error.svg') }}" alt="Akses Ditolak" class="w-1/2 h-auto mb-4">

        <div class="text-center flex flex-col items-center">
            {{-- Pesan error --}}
            <h2 class="text-4xl uppercase font-bold text-warning">{{ $exception->getMessage() }}</h2>
            <h1 class="font-bold text-error  uppercase" style="font-size: 12rem">403</h1>
            <p class="text-gray-500 mb-6 text-wrap mx-auto">
                We are sorry, but you do not have permission to access
                <br>
                this page or resource
            </p>

            {{-- Tombol kembali --}}
            <a href="{{ route('home') }}" class="btn btn-primary rounded-full uppercase flex items-center gap-1">
                dashboard
            </a>
        </div>

    </div>
@endsection
