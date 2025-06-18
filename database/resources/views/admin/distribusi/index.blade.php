@extends('layouts.admin')

@section('title', 'Distribusi')

@section('content')
    <h2>Data Distribusi</h2>
    <a href="{{ route('admin.distribusi.create') }}">+ Tambah Distribusi</a>

    <table>
        <thead>
            <tr>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal Distribusi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distribusi as $item)
                <tr>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->tanggal_distribusi}}</td>
                    <td>
                        <a href="{{ route('admin.distribusi.edit', $item->id) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.distribusi.destroy', $item->id) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
