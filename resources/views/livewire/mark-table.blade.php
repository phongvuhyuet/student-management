<div>
    @php
        include 'utils.php';
    @endphp

    <style>
        .select {
            padding: 0px 5px 0px 0px;
        }

    </style>

    <div>
        <p class="card-title">Kết quả học tập của {{ $user->name . ' ' . $user->msv }}</p>
        <div class="row">
            <div class='col-md-1 d-flex justify-content-center align-item-center' name='label'
                style='padding-right: 0px; height: 54px;'>
                <div class='' style='margin: 0;
                    position: absolute;
                    top: 50%;
                    -ms-transform: translateY(-50%);
                    transform: translateY(-50%);
                    '>
                    <label class="p-1 m-0 pr-1 text-center" style=''>Xếp theo</label>
                </div>
            </div>


            <div class="col-md-2 select" name='select1'>
                <select wire:model="orderBy"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option value="maMH">Mã MH</option>
                    <option value="name">Tên</option>
                    <option value="so_tc">Số TC</option>
                    <option value="mark">Điểm</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    </svg>
                </div>
            </div>
            <div class="col-md-2 select" name='select2'>
                <select wire:model="orderAsc"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option value="1">Tăng dần</option>
                    <option value="0">Giảm dần</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    </svg>
                </div>
            </div>
            <div class="col-md-1 select" name='select3'>
                <select wire:model="perPage"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    </svg>
                </div>
            </div>

            <div class="col-md-3 select" name='select4' style='padding-right: 100px;'>
                <select wire:model="term"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option class="dropdown-item" value="all" selected>Tất cả kì học
                    </option>

                    <option class="dropdown-item" value="22020">202 - Học kỳ 2 năm 2020-2021
                    </option>
                    <option class="dropdown-item" value="12020">201 - Học kỳ 1 năm 2020-2021
                    </option>
                    <option class="dropdown-item" value="22019">192 - Học kỳ 2 năm 2019-2020
                    </option>
                    <option class="dropdown-item" value="12019">191 - Học kỳ 1 năm 2019-2020
                    </option>
                    <option class="dropdown-item" value="22018">182 - Học kỳ 1 năm 2018-2019
                    </option>
                    <option class="dropdown-item" value="12018">181 - Học kỳ 1 năm 2018-2019
                    </option>
                    <option class="dropdown-item" value="22017">172 - Học kỳ 2 năm 2017-2018
                    </option>
                    <option class="dropdown-item" value="12017">171 - Học kỳ 1 năm 2017-2018
                    </option>
                    <option class="dropdown-item" value="22016">162 - Học kỳ 2 năm 2016-2017
                    </option>
                    <option class="dropdown-item" value="12016">161 - Học kỳ 1 năm 2016-2017
                    </option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    </svg>
                </div>
            </div>


            <div class="col-md-3" name='search' style='padding: 0px 30px 0px 0px;'>
                <input wire:model.debounce.300ms="search" type="text"
                    class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    placeholder="Tìm kiếm tên hoặc mã môn học" style="overflow: hidden;text-overflow: ellipsis">
                <span style="cursor:pointer ;position: absolute;font-size: 23px; top: 11px;right: 29px;"
                    class="input-group-text border-0 p-0 bg-transparent fw-bolder fs-2" id="search-addon">
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="hover"
                        colors="primary:#121331,secondary:#08a88a" style="width:32px;height:32px">
                    </lord-icon>
                </span>
            </div>
        </div>
        <br>
    </div>
    <div class="table-responsive">
        <br>
        <table id="myTable" class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã MH</th>
                    <th>Tên môn học</th>
                    <th>Số TC</th>
                    <th>Điểm hệ 10</th>
                    <th>Điểm chữ</th>
                    <th>Điểm hệ 4</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentId = null;
                    $coursess;
                    if ($orderBy === 'mark') {
                        if ($orderAsc) {
                            $coursess = $courses->sortBy('AverageMark');
                        } else {
                            $coursess = $courses->sortByDesc('AverageMark');
                        }
                    } else {
                        $coursess = $courses;
                    }
                @endphp
                @foreach ($coursess as $course)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $course->maMH }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->so_TC }}</td>
                        <td>{{ averageMark($course) }}</td>
                        <td>{{ toCharMark(averageMark($course)) }}</td>
                        <td>{{ toFourMark(averageMark($course)) }}</td>
                        <td>
                            <lord-icon {{-- data-course-id="{{ $course->id }}" --}} id="test" src="https://cdn.lordicon.com/nocovwne.json"
                                trigger="hover" data-toggle="modal" data-target="#markDetails"
                                onclick="showMarkDetail({{ $course->pivot }})"
                                colors="primary:#121331,secondary:#08a88a"
                                style="width:32px;height:32px;cursor:pointer">
                            </lord-icon>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            function showMarkDetail(mark) {
                // $('#markDetails').show()
                // alert(mark)
                let gpa = mark.gk * 0.4 + mark.ck * 0.6
                let html = `
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Loại điểm</td>
                                <td>Trọng số</td>
                                <td>Điểm hệ 10</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Thành phần</td>
                                <td>0.4</td>
                                <td>${mark.gk}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Cuối kỳ</td>
                                <td>0.6</td>
                                <td>${mark.ck}</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center"><b>Tổng điểm</b>
                                </td>
                                <td><b>${gpa.toPrecision(3)}</b></td>
                            </tr>
                        </tbody>
                    </table>
                `

                $('#mbody').html(html)
            }
        </script>
    </div>
    <div class="modal" id="markDetails">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Điểm chi tiết môn học
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="mbody">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <span class="d-flex justify-content-end">{!! $courses->links('livewire::bootstrap') !!}</span>
    @if (auth()->user()->role_id == 1)
        <button class="btn btn-primary" onclick="location.href = '/view-grade'"
            style="    border-radius: 4px; background-color: rgb(78 79 172)">Trở
            về</button>
    @endif
</div>
