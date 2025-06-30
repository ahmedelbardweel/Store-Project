@extends('layouts.admin')
@section('title', 'Reports')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Sales Reports Dashboard</h1>
    <p class="mb-8 text-gray-600 dark:text-gray-300">A line chart showing total sales for the last 7 days</p>

    <div class="bg-white dark:bg-gray-900 p-8 rounded-none border shadow">
        <div class="w-full" style="min-height: 300px;">
            <canvas id="salesChart" height="120"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($labels);
        const salesData = @json($salesData);

        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Sales ($)',
                    data: salesData,
                    fill: true,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16,185,129,0.08)',
                    tension: 0.3,
                    pointBackgroundColor: '#10b981',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: { color: "#222" } // نص غامق دائمًا
                    },
                    title: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#222', // نص غامق دائمًا
                            stepSize: 50
                        },
                        grid: {
                            color: 'rgba(34,34,34,0.05)' // خطوط فاتحة خفيفة
                        }
                    },
                    x: {
                        ticks: { color: '#222' }, // نص غامق دائمًا
                        grid: {
                            color: 'rgba(34,34,34,0.05)'
                        }
                    }
                }
            }
        });
    </script>
@endpush
