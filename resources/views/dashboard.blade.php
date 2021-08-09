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
                                              src="{{ asset('images/dashboard/doan-thanh-nien.jpg') }}"
                                              data-color="lightblue" alt="First Image">
                                          <div class="carousel-caption d-md-block">
                                              {{-- <h5>First Image</h5> --}}
                                          </div>
                                      </div>
                                      <div class="carousel-item " style="height: 780px; object-fit: cover">
                                          <img class="d-block w-100 h-100"
                                              src="{{ asset('images/dashboard/404-not-found.jpg') }}"
                                              data-color="firebrick" alt="Second Image">
                                          <div class="carousel-caption d-md-block">
                                              {{-- <h5>Second Image</h5> --}}
                                          </div>
                                      </div>
                                      <div class="carousel-item" style="height: 780px; object-fit: cover">
                                          <img class="d-block w-100 h-100 "
                                              src="{{ asset('images/dashboard/213078697_2275741949234879_8088690668086271971_n.jpg') }}"
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
                                                                                      ->where('so_lan_nhac_nho', '>', 2)
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
                                                                              <td class="text-muted">Sinh viên có điểm rèn luyện
                                                                                  tốt</td>
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




              {{-- todo list --}}
              @can('manage-tasks')
                  <div class="row mt-4 mb-8">
                      <div class="col-md-12 ">
                          <div class="card">
                              <div class="card-body">
                                  <h4 class="card-title">Các nhiệm vụ gần hết hạn</h4>
                                  <div class="list-wrapper pt-2 overflow-hidden">

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
