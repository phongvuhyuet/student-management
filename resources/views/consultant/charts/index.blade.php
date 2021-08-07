@extends('layouts.admin') @section('main')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Thong ke</p>
                            <div class="col-md-12 ">
                                <div class="form-group ">
                                    <p class="text-center " style="width: 200px">---Chon loai bieu do---</p>
                                    <select id="select-chart-type" onchange="changeChartType()"
                                        class="js-example-basic-single btn-outline  dropdown-toggle " style="width: 200px">
                                        <option value="bar">Biểu đồ dạng cột</option>
                                        <option value="line">Biểu đồ dạng đường</option>
                                        <option value="polarArea">Biểu đồ vùng cực</option>
                                        <option value="doughnut">Biểu đồ tròn</option>
                                        <option value="radar">Biểu đồ Radar</option>
                                    </select>
                                </div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Chart.defaults.global.defaultFontFamily = "monospace";
        // select element for display char
        const ctx = document.getElementById('myChart');

        let configChart = {
            type: 'line',
            data: {

                labels: ['Sinh viên giỏi', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Sinh viên giỏi',
                        font: {
                            size: 30
                        }
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                legend: {
                    position: 'right'
                }
            }
        }
        let myChart = new Chart(ctx, configChart);

        const changeChartType = () => {
            myChart.clear();
            myChart.destroy();

            let chartType = document.getElementById('select-chart-type').value;
            console.log(configChart)
            configChart.type = chartType;
            myChart = new Chart(ctx, {
                type: chartType,
                data: {

                    labels: ['Sinh viên giỏi', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Sinh viên giỏi',
                            font: {
                                size: 30
                            }
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    legend: {
                        position: 'right'
                    }
                }
            })

        }
    </script>

@endsection
