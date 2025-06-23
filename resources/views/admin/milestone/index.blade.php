@extends('layouts.admin')

@section('title', 'Target')

@section('content')
    <h2 style="color: #14532D; margin-bottom: 1.5rem;">Data Target</h2>

    <div style="margin-bottom: 1.5rem; text-align: right;">
        <a href="{{ route('admin.milestone.create') }}"
           style="background-color: #A8FF3E; color: #111111; padding: 0.6rem 1.2rem; border-radius: 6px; text-decoration: none; font-weight: bold;">
            + Tambah Target
        </a>
    </div>

    @if(session('success'))
        <div style="background-color: #DCFCE7; color: #14532D; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="overflow-x:auto;">
        <table style="width: 100%; border-collapse: collapse; background-color: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden;">
            <thead style="background-color: #14532D; color: white;">
                <tr>
                    <th style="padding: 1rem; text-align: left;">Nama</th>
                    <th style="padding: 1rem; text-align: left;">Periode</th>
                    <th style="padding: 1rem; text-align: left;">Target (kg)</th>
                    <th style="padding: 1rem; text-align: left;">Status</th>
                    <th style="padding: 1rem; text-align: left;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($milestones as $milestone)
                    <tr style="border-bottom: 1px solid #E0E0E0;">
                        <td style="padding: 1rem;">{{ $milestone->nama }}</td>
                        <td style="padding: 1rem;">{{ $milestone->tanggal_mulai }} s/d {{ $milestone->tanggal_selesai }}</td>
                        <td style="padding: 1rem;">{{ $milestone->target }} kg</td>
                        <td style="padding: 1rem;">
                            @if($milestone->status === 'sudah')
                                <span style="color: #2E7D32; font-weight: bold;">Sudah</span>
                            @else
                                <span style="color: #C62828; font-weight: bold;">Belum</span>
                            @endif
                        </td>
                        <td style="padding: 1rem;">
    <a href="{{ route('admin.milestone.show', $milestone->id) }}"
       style="color: #1565C0; font-weight: bold; margin-right: 1rem; text-decoration: none;">
        Lihat
    </a>

    <a href="{{ route('admin.milestone.edit', $milestone->id) }}"
       style="color: #F9A825; font-weight: bold; margin-right: 1rem; text-decoration: none;">
        Edit
    </a>

    <form method="POST" action="{{ route('admin.milestone.destroy', $milestone->id) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Yakin ingin menghapus data ini?')" 
                style="color: #D32F2F; background: none; border: none; cursor: pointer; font-weight: bold;">
            Hapus
        </button>
    </form>
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 1.5rem; text-align: center; color: #757575;">
                            Tidak ada data milestone.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
