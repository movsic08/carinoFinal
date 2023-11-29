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
    </style>

<div class="card">
    <div class="card-body">
        <div class="analysis-box">
            <h4 class="mb-3 text-center">Most Used Contraceptives Analysis</h4>
            <div style="width: 85%; margin: auto; border: 1px solid #ccc; padding: 10px; mt-3">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Parse the chart data passed from the controller
            var chartData = @json($topMethods);

            if (chartData.length > 0) {
                // Extract labels and data from the chartData
                var labels = chartData.map(function (item) {
                    return item.method_accepted;
                });

                var data = chartData.map(function (item) {
                    // Use the count property for chart data
                    return Math.round(item.count);
                });

                // Get the canvas element and create a 2D context
                var ctx = document.getElementById('myChart').getContext('2d');

                // Define an array of colors for each bar
                var colors = ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 205, 86, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)'];

                // Create an array to store different colors for each bar
                var backgroundColors = [];
                var borderColors = [];

                // Loop through the data and assign colors
                for (var i = 0; i < data.length; i++) {
                    backgroundColors.push(colors[i % colors.length]);
                    borderColors.push(colors[i % colors.length]);
                }

                // Create a bar chart using Chart.js with a custom plugin
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Count',
                            data: data,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: false, // Disable responsiveness
                        maintainAspectRatio: false, // Disable aspect ratio
                        scales: {
                            y: {
                                beginAtZero: true,
                                autoSkip: true,
                                maxTicksLimit: 10, // Adjust as needed
                                precision: 0 // Ensure whole numbers
                            }
                        },
                        plugins: {
                            datalabels: {
                                anchor: 'end',
                                align: 'end',
                                font: {
                                    weight: 'bold'
                                },
                                formatter: function (value, context) {
                                    return value;
                                }
                            }
                        }
                    }
                });
            } else {
                // Display a message or handle empty data scenario
                console.error('No data available for chart.');
            }
        });
    </script>
@endsection
