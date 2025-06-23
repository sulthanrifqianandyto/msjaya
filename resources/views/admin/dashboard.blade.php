@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .dashboard-container {
        max-width: 1200px;
        margin: auto;
        padding: 2rem 1rem;
    }

    .card {
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-4px);
    }

    .chart-container {
        max-width: 500px;
        margin: 2rem auto;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
    }

    .form-filter {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-filter input[type="date"],
    .form-filter button {
        padding: 0.5rem 0.8rem;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    .form-filter button {
        background-color: #14532D;
        color: white;
        border: none;
        margin-left: 0.5rem;
    }

    h2 {
        text-align: center;
        margin-bottom: 1rem;
    }

    p.subtitle {
        text-align: center;
        color: #555;
        margin-bottom: 2rem;
    }
</style>

<div class="dashboard-container">
    <h2>Dashboard Admin</h2>
    <p class="subtitle">Selamat datang kembali di sistem pengelolaan!</p>

    <div class="form-filter" style="text-align: center; margin-bottom: 1.5rem;">
    <form method="GET" action="{{ route('admin.admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.5rem;">
        <label for="tanggal" style="font-weight: bold; color: #14532D;">Filter Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="{{ $selectedDate }}"
               style="padding: 0.5rem 0.7rem; border-radius: 6px; border: 1px solid #ccc; background-color: #FAF9F6; color: #14532D;">
        <button type="submit"
                style="padding: 0.5rem 1rem; background-color: #14532D; color: #FAF9F6; border: none; border-radius: 6px; cursor: pointer;">
            Terapkan
        </button>
    </form>
</div>


    <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; align-items: flex-start; margin-top: 2rem;">
    
    <!-- Pie Chart -->
    <div style="flex: 1 1 400px; max-width: 500px;">
        <canvas id="combinedPieChart"></canvas>
    </div>

    <!-- Statistik -->
    <div style="flex: 1 1 400px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.2rem;">
        <div class="card" style="background-color: #14532D; color: #FAF9F6;">
            <h3>Bahan Baku</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $bahanBakuCount }}</p>
            <small>Tercatat</small>
        </div>

        <div class="card" style="background-color: #A8FF3E; color: #FAF9F6;">
            <h3>Produksi</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $produksiCount }}</p>
            <small>Tercatat</small>
        </div>

        <div class="card" style="background-color: #4D7C0F; color: #FAF9F6;">
            <h3>Distribusi</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $distribusiCount }}</p>
            <small>Pengiriman</small>
        </div>

        <div class="card" style="background-color: #FAF9F6; color: #111;">
            <h3>Pelanggan</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $pelangganCount }}</p>
            <small> 📌 Terdaftar Semua Waktu</small>
        </div>
    </div>
</div>


<script>
let pieChart;

function renderPieChart(labels, data) {
    const ctx = document.getElementById('combinedPieChart').getContext('2d');
    if (pieChart) pieChart.destroy();

    pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#14532D', '#A8FF3E'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}

// Data awal dari controller
const chartData = {
    labels: @json($labels),
    values: @json($values)
};

// Render awal
renderPieChart(chartData.labels, chartData.values);
</script>

@endsection
