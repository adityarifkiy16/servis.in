@extends('layouts.admin')

@section('title', 'Product Management')

@section('content')
    <div class="container">
        <h2 class="mb-4">Update Usage Produk</h2>

        <form action="{{ route('products.updateUsage') }}" method="POST">
            @csrf
            @method('PUT')

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Jenis</th>
                        <th>Usage</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\Product::with('jenis')->get() as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name ?? '-' }}</td>
                            <td>{{ $product->jenis->name ?? '-' }}</td>
                            <td>
                                <input type="text" name="usage[{{ $product->id }}]" value="{{ $product->usage }}"
                                    class="form-control">
                            </td>
                            <td>{{ $product->jenis->unit->name ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
        </form>
    </div>
@endsection
