@extends('layouts.admin')

@section('title', 'Detail Target')

@section('content')
<h2 style="margin-bottom: 1.5rem; color: #14532D;">Detail Target</h2>

<div style="background-color: #FAF9F6; padding: 2rem; border-radius: 12px; max-width: 800px;">
    <div style="margin-bottom: 1rem;">
        <p><strong>Nama:</strong> {{ $milestone->nama }}</p>
        <p><strong>Periode:</strong> {{ $milestone->tanggal_mulai }} s/d {{ $milestone->tanggal_selesai }}</p>
        <p><strong>Target Produksi:</strong> {{ $milestone->target }} kg</p>
        <p><strong>Total Produksi Saat Ini:</strong> <span id="total-produksi">{{ $total_produksi }}</span> kg</p>
        <p><strong>Progress:</strong> <span id="persen-progress">{{ $persentase }}</span>%</p>
    </div>

    <div style="background-color: #E5E7EB; height: 16px; border-radius: 9999px; overflow: hidden; margin-bottom: 1.5rem;">
        <div id="progress-bar"
             style="height: 100%; background-color: #F97316; width: {{ $persentase }}%; transition: width 0.5s;"></div>
    </div>

    @if($milestone->status === 'belum')
        <form action="{{ route('admin.milestone.konfirmasi', $milestone->id) }}" method="POST" 
              onsubmit="return confirm('Konfirmasi bahwa target telah tercapai?')" style="margin-bottom: 1rem;">
            @csrf
            <button type="submit"
                    style="background-color: #16A34A; color: #ffffff; padding: 0.6rem 1.2rem; border-radius: 6px; font-weight: bold;">
                Konfirmasi Selesai
            </button>
        </form>
    @else
        <div style="color: #15803D; font-weight: bold; margin-bottom: 1rem;">
            ✅ Target Telah Dikonfirmasi
        </div>
    @endif

    <a href="{{ route('admin.milestone.index') }}"
       style="display: inline-block; margin-top: 0.5rem; color: #2563EB; text-decoration: underline;">
        ← Kembali ke Daftar Target
    </a>

    <div style="margin-top: 2rem;">
        <canvas id="milestoneChart" height="100"></canvas>
    </div>
</div>

{{-- Chart.js + Realtime Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('milestoneChart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($produksi->keys()) !!},
            datasets: [{
                label: 'Produksi Harian (kg)',
                data: {!! json_encode($produksi->values()) !!},
                backgroundColor: 'rgba(255, 165, 0, 0.7)',
                borderColor: 'orange',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Kg' }
                },
                x: {
                    title: { display: true, text: 'Tanggal' }
                }
            }
        }
    });

    function updateChart() {
        fetch(`{{ url('/admin/milestone/' . $milestone->id . '/data') }}`)
            .then(response => response.json())
            .then(data => {
                chart.data.labels = data.labels;
                chart.data.datasets[0].data = data.data;
                chart.update();

                const total = data.data.reduce((acc, val) => acc + val, 0);
                const target = {{ $milestone->target }};
                const percent = Math.min(100, ((total / target) * 100).toFixed(2));

                document.getElementById('total-produksi').textContent = total;
                document.getElementById('persen-progress').textContent = percent;
                document.getElementById('progress-bar').style.width = percent + '%';
            });
    }

    setInterval(updateChart, 10000); // update setiap 10 detik
</script>
@endsection
