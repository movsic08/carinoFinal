@extends('admin.admin-layout')

@section('admin')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Ensure the canvas takes up the entire width of its container */
        canvas {
            display: block;
            width: 100%;
            height: 400px; /* Set the desired height for the canvas */
            margin: auto;
        }

        /* Style for the analysis box */
        .analysis-box {
            width: 80%;
            margin: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px; /* Add some margin at the bottom for separation */
        }
    </style>

    <!-- Chart for Top City/Municipality -->
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3 text-center">Top City/Municipality</h4>
            <div class="analysis-box">
                <div style="width: 100%; margin: auto; ">
                    <canvas id="cityMunicipalityChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Pass PHP data to JavaScript
            var cityMunicipalityData = @json($cityMunicipalityData);

            if (cityMunicipalityData && cityMunicipalityData.length > 0) {
                createChart('cityMunicipalityChart', cityMunicipalityData, 'City/Municipality');
            } else {
                console.error('No valid data available for the chart.');
            }

            function createChart(chartId, data, label) {
                var labels = data.map(item => item.city_municipality);
                var chartData = data.map(item => Math.round(item.count));

                console.log('Labels:', labels);
                console.log('ChartData:', chartData);

                var gradients = chartData.map(() => getRandomColor());

                var ctx = document.getElementById(chartId).getContext('2d');

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Count',
                            data: chartData,
                            backgroundColor: gradients,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                autoSkip: true,
                                maxTicksLimit: 10,
                                precision: 0
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        return context.dataset.label + ': ' + context.parsed.y;
                                    }
                                }
                            }
                        }
                    }
                });

                // Display total count on top of each bar
                var datasets = myChart.data.datasets;
                var labels = myChart.data.labels;
                var meta = myChart.getDatasetMeta(0);
                var ctx = myChart.ctx;

                meta.data.forEach(function (bar, index) {
                    var data = datasets[0].data[index];
                    var xPos = bar._model.x;
                    var yPos = bar._model.y - 5;

                    ctx.fillStyle = 'black'; // Adjust text color
                    ctx.fillText(data, xPos, yPos);
                });

                // Function to generate a random color
                function getRandomColor() {
                    return '#' + Math.floor(Math.random()*16777215).toString(16);
                }
            }
        });
    </script>
@endsection
