<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Data</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myLineChart" width="400" height="200"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myLineChart').getContext('2d');

            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! $clients->pluck('month') !!}, // Assuming 'month' is the property containing month values
                    datasets: [{
                        label: 'Monthly Added Clients',
                        data: {!! $clients->pluck('count') !!},
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 2,
                        pointRadius: 5,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'category',
                            labels: {!! $clients->pluck('month') !!},
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
