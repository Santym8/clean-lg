@extends('app')

@section('content')
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <!-- Crear el contenedor para la gráfica -->
    <div id="pieChartContainer"></div>
    <!-- Crear el contenedor para el gráfico de barras -->
    <div id="barChartContainer"></div>
    <script>
        Highcharts.chart('pieChartContainer', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Las 5 primeros acciones más realizadas'
            },
            series: [{
                name: 'Cantidad',
                data: <?php echo $chartDataJson; ?> // Sin las llaves de Blade
            }]
        });
    </script>
    <script>
        Highcharts.chart('barChartContainer', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Usuarios y módulos visitados'
            },
            xAxis: {
                categories: <?php echo json_encode(array_column($chartData2, 'name')); ?>
            },
            yAxis: {
                title: {
                    text: 'Cantidad de visitas'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            series: <?php echo $chartDataJson2; ?> // Sin las llaves de Blade
        });
    </script>
@endsection

@push('styles')
@endpush

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endpush
