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
                text: 'Las 5 Acciones Más Realizadas'
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
                text: 'Usuarios y Módulos Visitados'
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
    <div id="userAccessColumnChartContainer"></div>
    <script>
        Highcharts.chart('userAccessColumnChartContainer', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Accesos de Usuario Exitosos'
            },
            xAxis: {
                categories: <?php echo json_encode(array_column($chartData3, 'name')); ?>
            },
            yAxis: {
                title: {
                    text: 'Número de Accesos Exitosos'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            series: [{
                name: 'Accesos Exitosos',
                data: <?php echo $chartDataJson3; ?>
            }]
        });
    </script>
    <div id="basicLineChartContainer"></div>
    <script>
        // ... existing code ...

        Highcharts.chart('basicLineChartContainer', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Módulos más visitados'
            },
            xAxis: {
                title: {
                    text: 'Módulos'
                },
                categories: <?php echo json_encode(array_column($allChartData, 'name')); ?>
            },
            yAxis: {
                title: {
                    text: 'Cantidad de  Visitas'
                }
            },
            series: [{
                name: 'Cantidad',
                data: <?php echo $allChartDataJson; ?> // Sin las llaves de Blade
            }]
        });
    </script>

    <div id="userAccessColumnChartContainer2"></div>
    <script>
        Highcharts.chart('userAccessColumnChartContainer2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Accesos Exitosos a Módulos'
            },
            xAxis: {
                categories: <?php echo json_encode(array_column($chartData4, 'name')); ?>
            },
            yAxis: {
                title: {
                    text: 'Número de Accesos Exitosos'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            series: [{
                name: 'Acceso Exitoso',
                data: <?php echo $chartDataJson4; ?>
            }]
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
