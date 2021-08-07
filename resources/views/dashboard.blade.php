  @extends(Auth::user()->role_id == 2 ? 'layouts.student' : 'layouts.admin')
  @section('main')
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
      @php
          include 'utils.php';
      @endphp
      <style>
          .class_management {
              cursor: pointer;
          }

          .fade-loading:before {
              content: "";
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              border-radius: inherit;
              background-color: inherit;
              animation: fade 1s forwards infinite linear;
          }

          @keyframes fade {
              to {
                  transform: scale(2);
                  opacity: 0;
              }
          }

      </style>
      <!-- partial -->
      <div class="main-panel">
          <div class="content-wrapper">
              <div class="row">
                  <div class="col-md-12 grid-margin">
                      <div class="row">
                          <div class="col-12 col-xl-8 ">
                              <h3 class="font-weight-bold text-xl">Hệ thống quản lý sinh viên</h3>
                          </div>
                      </div>
                  </div>
              </div>
              {{-- banner + class --}}
              <div class="row">
                  {{-- banner --}}
                  <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              <h3 class="card-title">Các sự kiện của trường đang diễn ra</h3>
                              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                  <!-- Indicators -->
                                  <ol class="carousel-indicators">
                                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                  </ol>
                                  <!-- Wrapper for slides -->
                                  <div class="carousel-inner">
                                      <div class="carousel-item  active" style="height: 780px; object-fit: cover">
                                          <img class="d-block w-100 h-100 "
                                                src="https://scontent.xx.fbcdn.net/v/t39.30808-6/225630979_1410488209319636_6679905556770882115_n.jpg?_nc_cat=107&ccb=1-4&_nc_sid=340051&_nc_ohc=SI-syih0aKMAX_PzOjh&_nc_ht=scontent.fhan3-2.fna&oh=b6a2d17e8931aa0022a536b7345bcaa8&oe=6112FB8C&_nc_fr=fhan3c02"
                                                data-color="lightblue" alt="First Image">
                                          <div class="carousel-caption d-md-block">
                                              {{-- <h5>First Image</h5> --}}
                                          </div>
                                      </div>
                                      <div class="carousel-item " style="height: 780px; object-fit: cover">
                                          <img class="d-block w-100 h-100"
                                                src="https://scontent.xx.fbcdn.net/v/t1.6435-9/217392445_4349567068429413_2177439834542793195_n.jpg?_nc_cat=109&ccb=1-4&_nc_sid=340051&_nc_ohc=dQX3lqZgn0kAX8wLnIN&_nc_ht=scontent.fhan3-5.fna&oh=85afd7ed3c0955d7d99ba6e6d66ade8c&oe=6134DE8B&_nc_fr=fhan3c05"
                                                data-color="firebrick" alt="Second Image">
                                          <div class="carousel-caption d-md-block">
                                              {{-- <h5>Second Image</h5> --}}
                                          </div>
                                      </div>
                                      <div class="carousel-item" style="height: 780px; object-fit: cover">
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


                  @can('manage-tasks')
                      {{-- class --}}
                  <div class="col-md-12">
                    <h3 class="font-weight-bold mb-4">Các lớp học đang quản lý</h3>
                </div>
                <div class="col-md-12 grid-margin transparent">

                    <div class="row">
                        @foreach ($classes as $class)


                            <div class="col-md-6 mb-4 stretch-card transparent"
                                onclick="location.href='class/{{ $class->id }}/students'">
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

                        @endforeach


                    </div>
                </div>
                  @endcan
              </div>
              {{-- bao cao tong quan --}}
              @can('manage-tasks')
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card position-relative">
                        <div class="card-body">
                            <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                                data-ride="carousel">
                                <div class="carousel-inner">

                                    @foreach ($classes as $class)


                                        <div class="carousel-item @if ($loop->index == '1') {{ 'active' }} @endif">
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
                                                                            // check hoc phi
                                                                            $students = $class->member->where('role_id', 2);
                                                                            $totalMoney = 0;
                                                                            $paidMoney = 0;
                                                                            $so_sinh_vien_no_hp = 0;
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
                                                                                    $so_sinh_vien_no_hp++;
                                                                                }
                                                                            }
                                                                            //get variables
                                                                            $all_students = $class->member->where('role_id', 2)->count();
                                                                            $great_attitude = $class->member
                                                                                ->where('role_id', 2)
                                                                                ->where('diem_chuyen_can', '>=', 80)
                                                                                ->count();
                                                                            $remind_count = $class->member
                                                                                ->where('role_id', 2)
                                                                                ->where('so_lan_nhac_nho', '>', 0)
                                                                                ->count();
                                                                            $warn_count = $class->member
                                                                                ->where('role_id', 2)
                                                                                ->where('so_lan_nhac_nho', '>=', 2)
                                                                                ->count();
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
                                                                                    role="progressbar"
                                                                                    style="width: {{ ($countXs / $all_students) * 100 . '%' }}"
                                                                                    aria-valuenow="70" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">

                                                                                {{ $countXs }}/{{ $all_students }}
                                                                            </h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted"> Số lượng sinh viên giỏi
                                                                        </td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-primary"
                                                                                    role="progressbar"
                                                                                    style="width: {{ ($countXs / $all_students) * 100 . '%' }}"
                                                                                    aria-valuenow="30" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">
                                                                                {{ $countG }}/{{ $all_students }}
                                                                            </h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Số lượng sinh viên khá</td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-primary"
                                                                                    role="progressbar"
                                                                                    style="width:{{ ($countK / $all_students) * 100 . '%' }}"
                                                                                    aria-valuenow="30" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">
                                                                                {{ $countK }}/{{ $all_students }}
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
                                                                                    role="progressbar"
                                                                                    style="width: {{ ($great_attitude / $all_students) * 100 . '%' }}"
                                                                                    aria-valuenow="60" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">

                                                                                {{ $great_attitude }}/{{ $all_students }}
                                                                            </h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Sinh viên bị nhắc nhở
                                                                        </td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-primary"
                                                                                    role="progressbar"
                                                                                    style="width:  {{ ($remind_count / $all_students) * 100 . '%' }}"
                                                                                    aria-valuenow="40" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">
                                                                                {{ $remind_count }}/{{ $all_students }}
                                                                            </h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Sinh viên bị cảnh báo </td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-danger"
                                                                                    role="progressbar"
                                                                                    style="width: {{ ($warn_count / $all_students) * 100 . '%' }}"
                                                                                    aria-valuenow="75" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">
                                                                                {{ $warn_count }}/{{ $all_students }}
                                                                            </h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Sinh viên nợ học phí</td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-danger"
                                                                                    role="progressbar"
                                                                                    style="width: {{ ($so_sinh_vien_no_hp / $all_students) * 100 . '%' }}"
                                                                                    aria-valuenow="75" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">
                                                                                {{-- @php
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
                                                                                    echo $count . '/' . $all_students;
                                                                                @endphp --}}
                                                                                {{ $so_sinh_vien_no_hp }}/{{ $all_students }}
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
              @endcan
              {{-- bang classes thieu hoc phi --}}

              @can('manage-tasks')
              <div class="row">
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


            </div>
              @endcan
              {{-- bang sinh vien thieu hoc phi --}}
              @can('manage-tasks')
              <div class="row">
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
                                <table class="table" id="mydata">
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
                                        {{-- <tr>

                                            <td class="font-weight-bold">Grace Burke</td>
                                            <td>1902000</td>
                                            <td>QH-2019-I/CQ-J</td>
                                            <td class="font-weight-bold">10.000.000</td>
                                            <td class="font-weight-bold">4.000.000</td>
                                            <td class="font-weight-bold">6.000.000</td>

                                            <td class="font-weight-medium">
                                                <div class=" btn badge badge-danger font-weight-bold"> Nhắc nhở</div>
                                            </td>
                                        </tr> --}}
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
            </div>
              @endcan

              {{-- <div class="row">
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

              </div> --}}
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
              {{-- todo list --}}
              @can('manage-tasks')
              <div class="row mt-4 mb-8">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Các nhiệm vụ gần hết hạn</h4>
                            <div class="list-wrapper pt-2 overflow-hidden">
                                {{-- <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                    <li class="btn" onclick="location.href='/task'">
                                        <box-icon name='error-alt' style="fill:rgb(194, 5, 5)" type='solid'
                                            animation='tada' rotate='180'>
                                        </box-icon>
                                        <div class="form-check form-check-flat">
                                            <label class=" btn form-check-label text-danger text"
                                                style="font-size: larger">
                                                Nhiệm vụ của: Level up for Antony
                                            </label>
                                        </div>

                                    </li>

                                </ul> --}}
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-justify">ID</th>
                                                <th class="text-justify">Tên</th>
                                                <th class="text-justify">Kì hạn</th>
                                                <th class="text-justify">Tiến độ</th>
                                                @can('manage-tasks')
                                                    <th class="text-justify">Giao cho</th>
                                                @endcan
                                                @cannot('manage-tasks')
                                                    <th class="text-justify">Được giao bởi</th>
                                                @endcannot
                                                <th class="text-justify">Trạng thái</th>
                                                <th class="text-justify">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $task)

                                                @php
                                                    $date2 = date_create($task->deadline);
                                                    $date1 = date_create(date('Y-m-d'));
                                                    $diff = date_diff($date1, $date2);
                                                @endphp
                                                @if ($diff->format('%R') == '+' && (int) $diff->format('%a') <= 7)
                                                    <tr data-toggle="collapse" data-target="#demo{{ $task->id }}"
                                                        class="accordion-toggle">
                                                        <td>
                                                            {{ $task->id }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $task->name }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $task->deadline }}
                                                        </td>
                                                        <td class="align-middle">
                                                            @php
                                                                $progress_type;
                                                                if ($task->progress < 33) {
                                                                    $progress_type = 'bg-danger';
                                                                } elseif ($task->progress < 66) {
                                                                    $progress_type = 'bg-warning';
                                                                } else {
                                                                    $progress_type = 'bg-success';
                                                                }

                                                            @endphp
                                                            <div class="progress">
                                                                <div class="progress-bar align-middle {{ $progress_type }}"
                                                                    role="progressbar"
                                                                    style="width: {{ $task->progress }}%"
                                                                    aria-valuenow="75" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @can('manage-tasks')
                                                            <td class="align-middle">
                                                                {{ $task->receiver->name . ' MSV: ' . $task->receiver->msv }}
                                                            </td>
                                                        @endcan
                                                        @cannot('manage-tasks')
                                                            <td class="align-middle">
                                                                {{ $task->creator->name . ' MCV: ' . $task->creator->msv }}
                                                            </td>
                                                        @endcannot
                                                        @php
                                                            $status_type;
                                                            $status;
                                                            if ($task->status == 'new') {
                                                                $status_type = 'badge-danger';
                                                                $status = 'Mới';
                                                            } elseif ($task->status == 'doing') {
                                                                $status_type = 'badge-warning';
                                                                $status = 'Đang hoàn thành';
                                                            } else {
                                                                $status_type = 'badge-success';
                                                                $status = 'Đã xong';
                                                            }
                                                        @endphp
                                                        <td class="align-middle"><label
                                                                class="badge p-2 mt-0 align-middle {{ $status_type }}"
                                                                style="min-width: 70px">{{ $status }}</label>
                                                        </td>

                                                        <td class="icon_style"
                                                            style="  font-size: 19px;
                                                                                                                                                                margin: 0;
                                                                                                                                                                padding: 16px;
                                                                                                                                                                display: flex;
                                                                                                                                                                justify-content: start;
                                                                                                                                                                align-content: center;
                                                                                                                                                                align-items: center;
                                                                                                                                                                cursor: pointer">


                                                            <a href="/task/{{ $task->id }}/edit"
                                                                class="mr-3 text-reset flex align-self-center align-middle text-decoration-none">
                                                                <ion-icon name="create-outline"></ion-icon>
                                                            </a>
                                                            @can('manage-tasks')
                                                                <form action='/task/{{ $task->id }}' method='POST'>
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="bg-transparent border-0 align-middle">
                                                                        <ion-icon name="trash-outline"></ion-icon>
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                            {{-- <a href="">
                                                        <ion-icon name="create-outline"></ion-icon>
                                                    </a> --}}

                                                        </td>

                                                    </tr>
                                                    <tr class="expanded-row">
                                                        <td colspan="12" class="row-bg" style="padding: 0 !important">
                                                            <div class="accordian-body p-2 collapse bg-light.bg-gradient"
                                                                style="background-color: beige"
                                                                id="demo{{ $task->id }}">

                                                                <div class="card card-body w-100">
                                                                    <strong class="pb-2 fw-bold">Ghi chú:</strong>
                                                                    <p class="fs-2 fst-italic fw-bold">
                                                                        {{ $task->detail }}
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            {{-- <div class="add-items d-flex mb-0 mt-2">
                                <input type="text" class="form-control todo-list-input" placeholder="Add new task">
                                <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i
                                        class="icon-circle-plus"></i></button>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
              @endcan
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
          $(document).ready(function() {
                  $("#mydata").DataTable({
                      // bServerSide: true,
                      // sPaginationType": "full_numbers"
                      language: {
                          search: "Tìm kiếm:",
                          processing: "Đang tải dữ liệu...",
                          paginate: {
                              first: "First",
                              previous: "<<",
                              next: ">>",
                              last: "Last"
                          },
                          sZeroRecords: "Không tìm thấy dữ liệu",
                          lengthMenu: "Hiển thị _MENU_ sinh viên",
                          info: "Hiển thị _START_ - _END_ / _TOTAL_ sinh viên",
                      },

                      aLengthMenu: [
                          [5, 10, 25, -1],
                          [5, 10, 25, "All"],
                      ],

                      iDisplayLength: 5,
                  });
              }

          );
      </script>
      <!-- main-panel ends -->
  @endsection
