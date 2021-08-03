  @extends(Auth::user()->role_id == 2 ? 'layouts.student' : 'layouts.admin')
  @section('main')
      @php
          include 'utils.php';
      @endphp
      <style>
          .class_management {
              cursor: pointer;
          }

      </style>
      <!-- partial -->
      <div class="main-panel">
          <div class="content-wrapper">
              <div class="row">
                  <div class="col-md-12 grid-margin">
                      <div class="row">
                          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                              <h3 class="font-weight-bold">Hệ thống quản lý sinh viên</h3>

                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  {{-- banner --}}
                  <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                  <!-- Indicators -->
                                  <ol class="carousel-indicators">
                                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                  </ol>
                                  <!-- Wrapper for slides -->
                                  <div class="carousel-inner">
                                      <div class="carousel-item  active" style="height: 600px; object-fit: cover">
                                          <img class="d-block w-100 h-100 "
                                              src="https://scontent.fhan3-1.fna.fbcdn.net/v/t39.30808-6/217827665_2268955103246897_4197327919822402208_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=0debeb&_nc_ohc=j9mzHHdCeFoAX9DnsmE&_nc_ht=scontent.fhan3-1.fna&oh=2e3c171c3f1f52a5d687d364c205442f&oe=610B8ED0"
                                              data-color="lightblue" alt="First Image">
                                          <div class="carousel-caption d-md-block">
                                              {{-- <h5>First Image</h5> --}}
                                          </div>
                                      </div>
                                      <div class="carousel-item " style="height: 600px; object-fit: cover">
                                          <img class="d-block w-100 h-100"
                                              src="https://scontent.fhan3-3.fna.fbcdn.net/v/t39.30808-6/228096912_2273250222817385_2977296643895585271_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=0debeb&_nc_ohc=-RseN9n_L9YAX-gtO0t&_nc_ht=scontent.fhan3-3.fna&oh=79910d9e18692093f02f5d279db2ebf6&oe=610AB466"
                                              data-color="firebrick" alt="Second Image">
                                          <div class="carousel-caption d-md-block">
                                              {{-- <h5>Second Image</h5> --}}
                                          </div>
                                      </div>
                                      <div class="carousel-item" style="height: 600px; object-fit: cover">
                                          <img class="d-block w-100 h-100 "
                                              src="https://scontent.fhan3-2.fna.fbcdn.net/v/t1.6435-9/221941083_814117452635939_8239861762149026769_n.jpg?_nc_cat=111&ccb=1-3&_nc_sid=8bfeb9&_nc_ohc=ich9H9kBeqoAX-zvUWN&tn=VbHeUG1J2EAzs6Ob&_nc_ht=scontent.fhan3-2.fna&oh=356d2dc2022ea80c5cb867756b194d64&oe=612A7E45"
                                              data-color="violet" alt="Third Image">
                                          <div class="carousel-caption d-md-block">
                                              {{-- <h5>Third Image</h5> --}}
                                          </div>
                                      </div>
                                  </div>
                                  <!-- Controls -->
                                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                      data-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                      data-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>


                  {{-- class --}}
                  <div class="col-md-12">
                      <h3 class="font-weight-bold mb-4">Các lớp học đang quản lý</h3>
                  </div>
                  <div class="col-md-12 grid-margin transparent">

                      <div class="row">
                          @foreach ($classes as $class)
                              <a href="class/{{ $class->id }}/students">
                                  <div class="col-md-6 mb-4 stretch-card transparent">
                                      <div class="card card-tale">
                                          <div class="class_management card-body">
                                              <p class=" fs-30 mb-4">{{ $class->name }}</p>
                                              <p class=" mb-2">Số lượng sinh viên:
                                                  {{ $class->member->where('role_id', 2)->count() }}</p>
                                              <p>Số lượng công việc:
                                                  {{ $tasks->whereIn('receiver_id', $class->member->where('role_id', 2)->pluck('id'))->count() }}
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                              </a>
                          @endforeach


                      </div>
                  </div>
              </div>
              {{-- <div class="row">
                  <div class="col-md-6 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              <p class="card-title">Order Details</p>
                              <p class="font-weight-500">The total number of sessions within the date range. It is
                                  the period time a user is actively engaged with your website, page or app, etc
                              </p>
                              <div class="d-flex flex-wrap mb-5">
                                  <div class="mr-5 mt-3">
                                      <p class="text-muted">Order value</p>
                                      <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                                  </div>
                                  <div class="mr-5 mt-3">
                                      <p class="text-muted">Orders</p>
                                      <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                                  </div>
                                  <div class="mr-5 mt-3">
                                      <p class="text-muted">Users</p>
                                      <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                                  </div>
                                  <div class="mt-3">
                                      <p class="text-muted">Downloads</p>
                                      <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                                  </div>
                              </div>
                              <canvas id="order-chart"></canvas>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              <div class="d-flex justify-content-between">
                                  <p class="card-title">Sales Report</p>
                                  <a href="#" class="text-info">View all</a>
                              </div>
                              <p class="font-weight-500">The total number of sessions within the date range. It is
                                  the period time a user is actively engaged with your website, page or app, etc
                              </p>
                              <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                              <canvas id="sales-chart"></canvas>
                          </div>
                      </div>
                  </div>
              </div> --}}
              <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                      <div class="card position-relative">
                          <div class="card-body">
                              <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                                  data-ride="carousel">
                                  <div class="carousel-inner">

                                      @foreach ($classes as $class)
                                          <div class="carousel-item active">
                                              <div class="row">
                                                  <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                                      <div class="ml-xl-4 mt-3">
                                                          <p class="card-title">Báo cáo tổng quan</p>
                                                          <h3 class="text-primary">{{ $class->name }}</h1>

                                                              <p class="mb-2 mb-xl-0">
                                                                  Tổng kết thành tích học tập ,hoạt động của chi đoàn
                                                                  {{ $class->name }} trong thời gian vừa qua</p>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-12 col-xl-9">
                                                      <div class="row">
                                                          <div class="col-md-10 ">
                                                              <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                                  <table class="table table-borderless report-table">
                                                                      <tr>
                                                                          @php
                                                                              $countXs = 0;
                                                                              $countG = 0;
                                                                              $countK = 0;
                                                                              foreach ($class->member->where('role_id', 2) as $student) {
                                                                                  $gpa = calculateGPA($student);
                                                                                  if ($gpa >= 3.6) {
                                                                                      $countXs++;
                                                                                  } elseif ($gpa >= 3.2) {
                                                                                      $countG++;
                                                                                  } elseif ($gpa >= 2.5) {
                                                                                      $countK++;
                                                                                  }
                                                                              }
                                                                          @endphp
                                                                          <td class="text-muted">Số lượng sinh viên suất sắc
                                                                          </td>
                                                                          <td class="w-100 px-0">
                                                                              <div class="progress progress-md mx-4">
                                                                                  <div class="progress-bar bg-primary"
                                                                                      role="progressbar" style="width: 30%"
                                                                                      aria-valuenow="70" aria-valuemin="0"
                                                                                      aria-valuemax="100"></div>
                                                                              </div>
                                                                          </td>
                                                                          <td>
                                                                              <h5 class="font-weight-bold mb-0">

                                                                                  {{ $countXs }}
                                                                              </h5>
                                                                          </td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td class="text-muted"> Số lượng sinh viên giỏi
                                                                          </td>
                                                                          <td class="w-100 px-0">
                                                                              <div class="progress progress-md mx-4">
                                                                                  <div class="progress-bar bg-primary"
                                                                                      role="progressbar" style="width: 60%"
                                                                                      aria-valuenow="30" aria-valuemin="0"
                                                                                      aria-valuemax="100"></div>
                                                                              </div>
                                                                          </td>
                                                                          <td>
                                                                              <h5 class="font-weight-bold mb-0">
                                                                                  {{ $countG }}
                                                                              </h5>
                                                                          </td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td class="text-muted">Số lượng sinh viên khá</td>
                                                                          <td class="w-100 px-0">
                                                                              <div class="progress progress-md mx-4">
                                                                                  <div class="progress-bar bg-primary"
                                                                                      role="progressbar" style="width: 10%"
                                                                                      aria-valuenow="30" aria-valuemin="0"
                                                                                      aria-valuemax="100"></div>
                                                                              </div>
                                                                          </td>
                                                                          <td>
                                                                              <h5 class="font-weight-bold mb-0">
                                                                                  {{ $countK }}
                                                                              </h5>
                                                                          </td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td class="text-muted">Sinh viên chuyên cần loại
                                                                              tốt
                                                                          </td>
                                                                          <td class="w-100 px-0">
                                                                              <div class="progress progress-md mx-4">
                                                                                  <div class="progress-bar bg-info"
                                                                                      role="progressbar" style="width: 99%"
                                                                                      aria-valuenow="60" aria-valuemin="0"
                                                                                      aria-valuemax="100"></div>
                                                                              </div>
                                                                          </td>
                                                                          <td>
                                                                              <h5 class="font-weight-bold mb-0">
                                                                                  {{ $class->member->where('role_id', 2)->where('diem_chuyen_can', '>=', 80)->count() }}
                                                                              </h5>
                                                                          </td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td class="text-muted">Sinh viên bị nhắc nhở
                                                                          </td>
                                                                          <td class="w-100 px-0">
                                                                              <div class="progress progress-md mx-4">
                                                                                  <div class="progress-bar bg-primary"
                                                                                      role="progressbar" style="width: 0%"
                                                                                      aria-valuenow="40" aria-valuemin="0"
                                                                                      aria-valuemax="100"></div>
                                                                              </div>
                                                                          </td>
                                                                          <td>
                                                                              <h5 class="font-weight-bold mb-0">
                                                                                  {{ $class->member->where('role_id', 2)->where('so_lan_nhac_nho', '>', 0)->count() }}
                                                                              </h5>
                                                                          </td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td class="text-muted">Sinh viên bị cảnh báo </td>
                                                                          <td class="w-100 px-0">
                                                                              <div class="progress progress-md mx-4">
                                                                                  <div class="progress-bar bg-danger"
                                                                                      role="progressbar" style="width: 0%"
                                                                                      aria-valuenow="75" aria-valuemin="0"
                                                                                      aria-valuemax="100"></div>
                                                                              </div>
                                                                          </td>
                                                                          <td>
                                                                              <h5 class="font-weight-bold mb-0">
                                                                                  {{ $class->member->where('role_id', 2)->where('so_lan_nhac_nho', '>=', 2)->count() }}
                                                                              </h5>
                                                                          </td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td class="text-muted">Sinh viên nợ học phí</td>
                                                                          <td class="w-100 px-0">
                                                                              <div class="progress progress-md mx-4">
                                                                                  <div class="progress-bar bg-danger"
                                                                                      role="progressbar" style="width: 0%"
                                                                                      aria-valuenow="75" aria-valuemin="0"
                                                                                      aria-valuemax="100"></div>
                                                                              </div>
                                                                          </td>
                                                                          <td>
                                                                              <h5 class="font-weight-bold mb-0">
                                                                                  @php
                                                                                      $students = $class->member->where('role_id', 2);
                                                                                      $totalMoney = 0;
                                                                                      $paidMoney = 0;
                                                                                      $count = 0;
                                                                                      foreach ($students as $student) {
                                                                                          $checkNoHocPhi = false;
                                                                                          foreach ($student->courses as $course) {
                                                                                              $totalMoney += $course->so_TC * 300000;
                                                                                              if ($course->pivot->is_dong_hoc) {
                                                                                                  $paidMoney += $course->so_TC * 300000;
                                                                                              } else {
                                                                                                  $checkNoHocPhi = true;
                                                                                              }
                                                                                          }
                                                                                          if ($checkNoHocPhi) {
                                                                                              $count++;
                                                                                          }
                                                                                      }
                                                                                      echo $count;
                                                                                  @endphp
                                                                              </h5>
                                                                          </td>
                                                                      </tr>
                                                                  </table>
                                                              </div>
                                                          </div>
                                                          <div class="col-md-2 ">

                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      @endforeach





                                  </div>


                                  <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-7 grid-margin stretch-card">
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
                  <div class="col-md-4 stretch-card grid-margin">
                      <div class="card">
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

              </div>
              <div class="row">
                  <div class="col-md-4 stretch-card grid-margin">
                      <div class="card">
                          <div class="card-body">
                              <p class="card-title mb-0">Projects</p>
                              <div class="table-responsive">
                                  <table class="table table-borderless">
                                      <thead>
                                          <tr>
                                              <th class="pl-0  pb-2 border-bottom">Places</th>
                                              <th class="border-bottom pb-2">Orders</th>
                                              <th class="border-bottom pb-2">Users</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td class="pl-0">Kentucky</td>
                                              <td>
                                                  <p class="mb-0"><span class="font-weight-bold mr-2">65</span>(2.15%)
                                                  </p>
                                              </td>
                                              <td class="text-muted">65</td>
                                          </tr>
                                          <tr>
                                              <td class="pl-0">Ohio</td>
                                              <td>
                                                  <p class="mb-0"><span class="font-weight-bold mr-2">54</span>(3.25%)
                                                  </p>
                                              </td>
                                              <td class="text-muted">51</td>
                                          </tr>
                                          <tr>
                                              <td class="pl-0">Nevada</td>
                                              <td>
                                                  <p class="mb-0"><span class="font-weight-bold mr-2">22</span>(2.22%)
                                                  </p>
                                              </td>
                                              <td class="text-muted">32</td>
                                          </tr>
                                          <tr>
                                              <td class="pl-0">North Carolina</td>
                                              <td>
                                                  <p class="mb-0"><span class="font-weight-bold mr-2">46</span>(3.27%)
                                                  </p>
                                              </td>
                                              <td class="text-muted">15</td>
                                          </tr>
                                          <tr>
                                              <td class="pl-0">Montana</td>
                                              <td>
                                                  <p class="mb-0"><span class="font-weight-bold mr-2">17</span>(1.25%)
                                                  </p>
                                              </td>
                                              <td class="text-muted">25</td>
                                          </tr>
                                          <tr>
                                              <td class="pl-0">Nevada</td>
                                              <td>
                                                  <p class="mb-0"><span class="font-weight-bold mr-2">52</span>(3.11%)
                                                  </p>
                                              </td>
                                              <td class="text-muted">71</td>
                                          </tr>
                                          <tr>
                                              <td class="pl-0 pb-0">Louisiana</td>
                                              <td class="pb-0">
                                                  <p class="mb-0"><span class="font-weight-bold mr-2">25</span>(1.32%)
                                                  </p>
                                              </td>
                                              <td class="pb-0">14</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 stretch-card grid-margin">
                      <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                              <div class="card">
                                  <div class="card-body">
                                      <p class="card-title">Charts</p>
                                      <div class="charts-data">
                                          <div class="mt-3">
                                              <p class="mb-0">Data 1</p>
                                              <div class="d-flex justify-content-between align-items-center">
                                                  <div class="progress progress-md flex-grow-1 mr-4">
                                                      <div class="progress-bar bg-inf0" role="progressbar"
                                                          style="width: 95%" aria-valuenow="95" aria-valuemin="0"
                                                          aria-valuemax="100"></div>
                                                  </div>
                                                  <p class="mb-0">5k</p>
                                              </div>
                                          </div>
                                          <div class="mt-3">
                                              <p class="mb-0">Data 2</p>
                                              <div class="d-flex justify-content-between align-items-center">
                                                  <div class="progress progress-md flex-grow-1 mr-4">
                                                      <div class="progress-bar bg-info" role="progressbar"
                                                          style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                                          aria-valuemax="100"></div>
                                                  </div>
                                                  <p class="mb-0">1k</p>
                                              </div>
                                          </div>
                                          <div class="mt-3">
                                              <p class="mb-0">Data 3</p>
                                              <div class="d-flex justify-content-between align-items-center">
                                                  <div class="progress progress-md flex-grow-1 mr-4">
                                                      <div class="progress-bar bg-info" role="progressbar"
                                                          style="width: 48%" aria-valuenow="48" aria-valuemin="0"
                                                          aria-valuemax="100"></div>
                                                  </div>
                                                  <p class="mb-0">992</p>
                                              </div>
                                          </div>
                                          <div class="mt-3">
                                              <p class="mb-0">Data 4</p>
                                              <div class="d-flex justify-content-between align-items-center">
                                                  <div class="progress progress-md flex-grow-1 mr-4">
                                                      <div class="progress-bar bg-info" role="progressbar"
                                                          style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                          aria-valuemax="100"></div>
                                                  </div>
                                                  <p class="mb-0">687</p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                              <div class="card data-icon-card-primary">
                                  <div class="card-body">
                                      <p class="card-title text-white">Number of Meetings</p>
                                      <div class="row">
                                          <div class="col-8 text-white">
                                              <h3>34040</h3>
                                              <p class="text-white font-weight-500 mb-0">The total number of
                                                  sessions within the date range.It is calculated as the sum .
                                              </p>
                                          </div>
                                          <div class="col-4 background-icon">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 stretch-card grid-margin">
                      <div class="card">
                          <div class="card-body">
                              <p class="card-title">Notifications</p>
                              <ul class="icon-data-list">
                                  <li>
                                      <div class="d-flex">
                                          <img src="images/faces/face1.jpg" alt="user">
                                          <div>
                                              <p class="text-info mb-1">Isabella Becker</p>
                                              <p class="mb-0">Sales dashboard have been created</p>
                                              <small>9:30 am</small>
                                          </div>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="d-flex">
                                          <img src="images/faces/face2.jpg" alt="user">
                                          <div>
                                              <p class="text-info mb-1">Adam Warren</p>
                                              <p class="mb-0">You have done a great job #TW111</p>
                                              <small>10:30 am</small>
                                          </div>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="d-flex">
                                          <img src="images/faces/face3.jpg" alt="user">
                                          <div>
                                              <p class="text-info mb-1">Leonard Thornton</p>
                                              <p class="mb-0">Sales dashboard have been created</p>
                                              <small>11:30 am</small>
                                          </div>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="d-flex">
                                          <img src="images/faces/face4.jpg" alt="user">
                                          <div>
                                              <p class="text-info mb-1">George Morrison</p>
                                              <p class="mb-0">Sales dashboard have been created</p>
                                              <small>8:50 am</small>
                                          </div>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="d-flex">
                                          <img src="images/faces/face5.jpg" alt="user">
                                          <div>
                                              <p class="text-info mb-1">Ryan Cortez</p>
                                              <p class="mb-0">Herbs are fun and easy to grow.</p>
                                              <small>9:00 am</small>
                                          </div>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-5 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">To Do Lists</h4>
                              <div class="list-wrapper pt-2">
                                  <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                      <li>
                                          <div class="form-check form-check-flat">
                                              <label class="form-check-label">
                                                  <input class="checkbox" type="checkbox">
                                                  Meeting with Urban Team
                                              </label>
                                          </div>
                                          <i class="remove ti-close"></i>
                                      </li>
                                      <li class="completed">
                                          <div class="form-check form-check-flat">
                                              <label class="form-check-label">
                                                  <input class="checkbox" type="checkbox" checked>
                                                  Duplicate a project for new customer
                                              </label>
                                          </div>
                                          <i class="remove ti-close"></i>
                                      </li>
                                      <li>
                                          <div class="form-check form-check-flat">
                                              <label class="form-check-label">
                                                  <input class="checkbox" type="checkbox">
                                                  Project meeting with CEO
                                              </label>
                                          </div>
                                          <i class="remove ti-close"></i>
                                      </li>
                                      <li class="completed">
                                          <div class="form-check form-check-flat">
                                              <label class="form-check-label">
                                                  <input class="checkbox" type="checkbox" checked>
                                                  Follow up of team zilla
                                              </label>
                                          </div>
                                          <i class="remove ti-close"></i>
                                      </li>
                                      <li>
                                          <div class="form-check form-check-flat">
                                              <label class="form-check-label">
                                                  <input class="checkbox" type="checkbox">
                                                  Level up for Antony
                                              </label>
                                          </div>
                                          <i class="remove ti-close"></i>
                                      </li>
                                  </ul>
                              </div>
                              <div class="add-items d-flex mb-0 mt-2">
                                  <input type="text" class="form-control todo-list-input" placeholder="Add new task">
                                  <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i
                                          class="icon-circle-plus"></i></button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              {{-- <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              <p class="card-title">Advanced Table</p>
                              <div class="row">
                                  <div class="col-12">
                                      <div class="table-responsive">
                                          <table id="example" class="display expandable-table" style="width:100%">
                                              <thead>
                                                  <tr>
                                                      <th>Quote#</th>
                                                      <th>Product</th>
                                                      <th>Business type</th>
                                                      <th>Policy holder</th>
                                                      <th>Premium</th>
                                                      <th>Status</th>
                                                      <th>Updated at</th>
                                                      <th></th>
                                                  </tr>
                                              </thead>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div> --}}
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->

          <!-- partial -->
          <script>
              $('.carousel').carousel({
                  interval: 6000,
                  pause: "false",

                  responsive: {
                      0: {
                          items: 1,
                          nav: true
                      },
                      600: {
                          items: 1,
                          nav: false
                      },
                      1000: {
                          items: 1,
                          nav: true,
                          loop: false
                      }
                  }
              });
          </script>
      </div>

      <script>
          $('.carousel').carousel({
              interval: 6000,
              pause: "false",

              responsive: {
                  0: {
                      items: 1,
                      nav: true
                  },
                  600: {
                      items: 1,
                      nav: false
                  },
                  1000: {
                      items: 1,
                      nav: true,
                      loop: false
                  }
              }
          });
      </script>
      <!-- main-panel ends -->
  @endsection
