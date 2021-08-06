@extends('layouts.admin') @section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
    <div class="main-panel">
        <div class="content-wrapper">

            {{-- Chart --}}
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Thong ke</p>
                            <div class="col-md-12 ">
                                <div class="chart-header d-flex justify-content-between">

                                    {{-- select chart type --}}
                                    <div class="form-group ">
                                        <p class="text-center " style="width: 200px">---Chọn loại biểu đồ---</p>
                                        <select id="select-chart-type" onchange="changeChartType()"
                                            class="js-example-basic-single btn-outline  dropdown-toggle "
                                            style="width: 200px">
                                            <option value="bar">Biểu đồ dạng cột</option>
                                            <option value="line">Biểu đồ dạng đường</option>
                                            <option value="polarArea">Biểu đồ vùng cực</option>
                                            <option value="doughnut">Biểu đồ tròn</option>
                                            <option value="radar">Biểu đồ Radar</option>
                                        </select>
                                    </div>
                                    {{-- select class --}}
                                    <div class="form-group ">
                                        <p class="text-center " style="width: 200px">---Chọn lớp học---</p>
                                        <select id="select-class" onchange="changeClass()"
                                            class="js-example-basic-single btn-outline  dropdown-toggle "
                                            style="width: 200px">

                                            @foreach ($classes as $task)
                                                <option value="{{ $task->name }}">{{ $task->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <canvas id="myChart"></canvas>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- bang classes thieu hoc phi --}}
            {{-- <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              <p class="card-title ">Tình trạng nộp học phí</p>
                              <div class="table-responsive">
                                  <table class="table table-striped table-borderless">
                                      <thead>
                                          <tr>
                                              <th>Tên lớp học</th>
                                              <th>Tổng học phí</th>
                                              <th>Hạn chót nộp học phí</th>
                                              <th>Trạng thái</th>
                                          </tr>
                                      </thead>
                                      <tbody>

                                          @foreach ($classes as $class)
                                              <tr>

                                                  <td>{{ $class->name }}</td>
                                                  <td class="font-weight-bold">{{ $totalMoney }}VND</td>
                                                  <td>12/08/2021</td>
                                                  <td class="font-weight-medium">
                                                      @if ($totalMoney - $paidMoney == 0)
                                                          <div class="badge badge-success">Hoàn thành</div>
                                                      @else
                                                          <div class="badge badge-warning">Chưa hoàn thành</div>
                                                      @endif
                                                  </td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>


              </div> --}}
            {{-- bang sinh vien thieu hoc phi --}}
            {{-- <div class="row">
                  <div class="col-md-8">
                      <div class="card overflow-auto " style="max-height: 479px">
                          <div class="card-body">
                              <div class="d-flex justify-content-between align-middle ">
                                  <h4 class="card-title">Các sinh viên muộn học phí</h4>
                                  <div class="btn badge badge-danger font-weight-bold d-flex align-items-center p-1 ">Nhắc
                                      nhở
                                      tất cả</div>
                              </div>
                              <div class="table-responsive">
                                  <table class="table" id="classInfo">
                                      <thead>
                                          <tr>
                                              <th>Họ và tên</th>
                                              <th>Mã số sinh viên</th>
                                              <th>Lớp</th>
                                              <th>Tổng học phí</th>
                                              <th>Đã nộp</th>
                                              <th>Còn thiếu</th>
                                              <th>Nhắc nhở</th>

                                          </tr>
                                      </thead>
                                      <tbody>
                                       
                                          @php
                                              foreach ($classes as $class) {
                                                  foreach ($class->member->where('role_id', 2) as $student) {
                                                      $tongHocPhi = 0;
                                                      $daNop = 0;
                                                      foreach ($student->courses as $course) {
                                                          $tongHocPhi += $course->so_TC * 300000;
                                                          if ($course->pivot->is_dong_hoc) {
                                                              $daNop += $course->so_TC * 300000;
                                                          }
                                                      }
                                                      if ($tongHocPhi - $daNop != 0) {
                                                          @endphp
                                                          <tr>

                                                            <td class="font-weight-bold">{{ $student->name }}</td>
                                                            <td>{{ $student->msv }}</td>
                                                            <td>{{ $class->name }}</td>
                                                            <td class="font-weight-bold">{{ $tongHocPhi }}</td>
                                                            <td class="font-weight-bold">{{ $daNop }}</td>
                                                            <td class="font-weight-bold">{{ $tongHocPhi - $daNop }}</td>

                                                            <td class="font-weight-medium">
                                                                <div class=" btn badge badge-danger font-weight-bold"> Nhắc nhở</div>
                                                            </td>
                                                            </tr>
                                                          @php


                                                      }
                                                  }
                                              }

                                          @endphp
                                      </tbody>
                                  </table>
                              </div>

                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 rounded-3 stretch-card grid-margin ">
                      <div class="card overflow-auto " style="max-height: 479px">
                          <div class="card-body">
                              <p class="card-title">Một số sinh viên thuộc diện khó khăn</p>
                              <ul class="icon-data-list">
                                  @php
                                      $studentss = [];
                                      foreach ($classes as $class) {
                                          array_push($studentss, $class->member->where('role_id', 2)->where('hoan_canh', '<>', null));
                                      }
                                      $studentss = collect($studentss);
                                  @endphp

                                  @foreach ($studentss as $students)
                                      @foreach ($students as $student)
                                          <li>
                                              <div class="d-flex">
                                                  <img src="images/faces/face1.jpg" alt="user">
                                                  <div>
                                                      <p class="text-info mb-1"> {{ $student->name }}</p>
                                                      <p class="mb-0"> {{ $student->hoan_canh }}</p>

                                                  </div>
                                              </div>
                                          </li>
                                      @endforeach
                                  @endforeach





                              </ul>
                          </div>
                      </div>
                  </div>
              </div> --}}

        </div>
    </div>
    <script>
        let classInfo = []
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
        $(document).on('ready', function() {
            $count = $(this).val()
            $.ajax({
                type: 'get',
                url: 'classChart',
                data: {},
                success: function(data) {

                    classInfo = Object.assign({}, data);

                },
            })
        })
        let defaultChartConfig = {
            type: 'line',
            data: {
                //Giỏi Khá Trung bình Yếu Xuất sắc

                labels: ['Yếu', 'Trung bình', 'Khá', 'Giỏi', 'Xuất sắc'],
                datasets: [{
                    label: 'Học tập',
                    data: [0, 0, 0, 0, 0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
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
                        text: `Bảng thống kê học lực sinh viên của lớp `,
                        font: {
                            size: 23
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
        const ctx = document.getElementById('myChart');


        let myChart = new Chart(ctx, defaultChartConfig);
        let className = document.getElementById('select-class').value;
        // console.log(className)
        const setChartByClassName = (className) => {
            // console.log(className)
            if (className) {

                let chartDataset = myChart.data.datasets;
                let chartData = chartDataset[0].data;
                let classData = Object.values(classInfo[className]);

                if (classData.length == chartData.length) {
                    console.log(myChart.data.datasets[0].data)
                    for (let i = 0; i < classData.length; i++) {
                        myChart.data.datasets[0].data[i] = classData[i];
                    }

                    myChart.update()
                }
            }
        }
        setTimeout(() => {
            setChartByClassName(className)
        }, 500)

        const changeChartType = () => {
            // clear data and destroy chart
            myChart.clear();
            myChart.destroy();
            // creat new chart config 
            const newConfig = Object.assign({}, defaultChartConfig)
            //handle on change chart type
            let chartType = document.getElementById('select-chart-type').value;
            //set chart type to new chart type
            if (chartType) {
                newConfig.type = chartType;
                //creat a new chart with new config and data
                myChart = new Chart(ctx, newConfig)
            }

        }

        const changeClass = () => {
            let className = document.getElementById('select-class').value;
            setChartByClassName(className)
        }
    </script>

@endsection
