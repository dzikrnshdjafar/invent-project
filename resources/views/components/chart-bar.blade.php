<!-- resources/views/components/chart-bar.blade.php -->
@props([
    'chartID',
    'series',
    'categories',
    'colors',
])

<div id="{{ $chartID }}" style="height: 400px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            series: @json($series),
            chart: {
                type: 'bar',
                height: 400
            },
            xaxis: {
                categories: @json($categories),
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            fill: {
                opacity: 1
            },
            colors: @json($colors), // Apply colors here
        };

        var chart = new ApexCharts(document.querySelector('#{{ $chartID }}'), options);
        chart.render();
    });
</script>
