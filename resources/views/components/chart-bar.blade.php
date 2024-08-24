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
            series: [{
                data: @json($series) // Mengubah format series menjadi objek dengan data array
            }],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        // Fungsi klik dapat Anda sesuaikan sesuai kebutuhan
                        // console.log(chart, w, e);
                    }
                }
            },
            colors: @json($colors), // Tetapkan warna yang sama dari props
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: false // Data labels diatur ke false untuk model bar ini
            },
            legend: {
                show: false // Legenda disembunyikan
            },
            xaxis: {
                categories: @json($labels), // Menggunakan labels untuk kategori x-axis
                labels: {
                    style: {
                        colors: @json($colors), // Warna label menyesuaikan warna bar
                        fontSize: '12px'
                    }
                }
            },
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
