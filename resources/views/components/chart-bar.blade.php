<!-- resources/views/components/chart-bar.blade.php -->
@props([
    'chartID',
    'series',
    'labels',
    'colors',
])

<div id="{{ $chartID }}" style="height: 400px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            series: @json($series),
            chart: {
                height: 400,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    startAngle: 0,
                    endAngle: 270,
                    hollow: {
                        margin: 5,
                        size: '10%',
                        background: 'transparent',
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            show: true,
                        }
                    },
                    barLabels: {
                        enabled: true,
                        useSeriesColors: true,
                        offsetX: -8,
                        fontSize: '16px',
                        formatter: function(seriesName, opts) {
                            return seriesName + ": " + opts.w.globals.series[opts.seriesIndex]
                        },
                    },
                }
            },
            colors: @json($colors),
            labels: @json($labels),
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: false
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector('#{{ $chartID }}'), options);
        chart.render();
    });
</script>
