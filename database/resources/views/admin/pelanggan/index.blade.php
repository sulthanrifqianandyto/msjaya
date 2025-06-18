@extends('layouts.admin')

@section('title', 'Pelanggan')

@section('content')
    <h2>Data Pelanggan</h2>
    <a href="{{ route('admin.pelanggan.create') }}">+ Tambah Pelanggan</a>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggan as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->alamat}}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>
                        <a href="{{ route('admin.pelanggan.edit', $item->id) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.pelanggan.destroy', $item->id) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
