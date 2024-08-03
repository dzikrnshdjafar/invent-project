<!-- resources/views/components/bar-chart.blade.php -->
<div>
    <div class="card">
        <div class="card-header">
            <h4>{{ $chartTitle }}</h4>
        </div>
        <div class="card-body">
            <div id="{{ $chartID }}"></div>
        </div>
    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartID = "#{{ $chartID }}";
        const categories = @json($categories);  // Room names
        const series = @json($series);          // Total quantities for each room

        // Generate a unique color for each bar
        function generateRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Use generated colors for each series item
        const colors = series.map(() => generateRandomColor());

        let options = {
            chart: {
                height: 350,
                type: "bar",
            },
            plotOptions: {
                bar: {
                    distributed: true,
                }
            },
            series: [
                {
                    name: 'Total Quantity of Items',
                    data: series,
                },
            ],
            colors: colors,  // Apply generated colors
            xaxis: {
                categories: categories,
            },
            yaxis: {
                labels: {
                    formatter: function(val) {
                        return val.toFixed(0);
                    }
                }
            }
        };

        new ApexCharts(document.querySelector(chartID), options).render();
    });
</script>
@endpush
