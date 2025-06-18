@extends('layouts.admin')

@section('title', 'Produksi')

@section('content')
    <h2>Data Produksi</h2>
    <a href="{{ route('admin.produksi.create') }}">+ Tambah Produksi</a>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Tanggal Produksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produksi as $item)
                <tr>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->satuan}}</td>
                    <td>{{ $item->tanggal_produksi }}</td>
                    <td>
                        <a href="{{ route('admin.produksi.edit', $item->id) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.produksi.destroy', $item->id) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
