@extends('layouts.admin')
@section('title', 'التقارير')

@section('content')
    <h1 class="text-2xl font-bold mb-6">لوحة تقارير المبيعات</h1>
    <p class="mb-8 text-gray-600 dark:text-gray-300">رسم بياني توضيحي لإجمالي المبيعات خلال آخر 7 أيام</p>

    <div class=" bg-white dark:bg-gray-900 p-8">
        <canvas id="salesChart" height="90"></canvas>
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
                    label: 'إجمالي المبيعات ($)',
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
                responsive: true,
                plugins: {
                    legend: { display: true },
                    title: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#444',
                            stepSize: 50
                        }
                    },
                    x: {
                        ticks: { color: '#444' }
                    }
                }
            }
        });
    </script>
@endpush
