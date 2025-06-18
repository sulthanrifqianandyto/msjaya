@extends('layouts.admin')

@section('content')
    <h1>Data Bahan Baku</h1>

    <a href="{{ route('admin.bahanbaku.create') }}">Tambah</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bahanbaku as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>
                        <a href="{{ route('admin.bahanbaku.edit', $item->id_bahan) }}">Edit</a>
                        <form action="{{ route('admin.bahanbaku.destroy', $item->id_bahan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin?')" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
