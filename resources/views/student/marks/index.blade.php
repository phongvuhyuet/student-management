{{-- <?php
?> --}}
@extends('layouts.student')
@section('main')
    @php
    include 'utils.php';
    @endphp
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <p class="card-title">Kết quả học tập</p>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">

                                                    {{-- selector --}}
                                                    <select class="js-example-basic-single"
                                                        aria-label="Default select example" style="padding: 0 10px">
                                                        <option class="dropdown-item" selected>---------Chọn học kỳ---------
                                                        </option>
                                                        <option class="dropdown-item" value="1">191 - Học kỳ 1 năm 2019-2020
                                                        </option>
                                                        <option class="dropdown-item" value="2">192 - Học kỳ 2 năm 2019-2020
                                                        </option>
                                                        <option class="dropdown-item" value="3">201 - Học kỳ 1 năm 2020-2021
                                                        </option>
                                                        <option class="dropdown-item" value="3">202 - Học kỳ 2 năm 2020-2021
                                                        </option>
                                                        <option class="dropdown-item" value="3">211 - Học kỳ 1 năm 2021-2022
                                                        </option>
                                                    </select>
                                                    {{-- search bar --}}
                                                    <div class=" rounded col-4 ">
                                                        <input type="text" class="form-control rounded"
                                                            placeholder="Nhập tên hoặc mã môn học" aria-label="Search"
                                                            aria-describedby="search-addon" />
                                                        <span
                                                            style="cursor:pointer ;position: absolute;font-size: 23px; top: 7px;right: 29px;"
                                                            class="input-group-text border-0 p-0 bg-transparent fw-bolder fs-2"
                                                            id="search-addon">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                                                trigger="hover" colors="primary:#121331,secondary:#08a88a"
                                                                style="width:32px;height:32px">
                                                            </lord-icon>
                                                        </span>
                                                    </div>

                                                </div>
                                                <div class="table-responsive">
                                                    <br>
                                                    <table class="table table-hover">
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
                                                            @endphp
                                                            @foreach ($courses as $course)
                                                                <tr>
                                                                    <td>{{ $loop->index + 1 }}</td>
                                                                    <td>{{ $course->maMH }}</td>
                                                                    <td>{{ $course->name }}</td>
                                                                    <td>{{ $course->so_TC }}</td>
                                                                    <td>{{ averageMark($course) }}</td>
                                                                    <td>{{ toCharMark(averageMark($course)) }}</td>
                                                                    <td>{{ toFourMark(averageMark($course)) }}</td>
                                                                    <td>
                                                                        <lord-icon {{-- data-course-id="{{ $course->id }}" --}} id="test"
                                                                            src="https://cdn.lordicon.com/nocovwne.json"
                                                                            trigger="hover" data-toggle="modal"
                                                                            data-target="#markDetails"
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
                                                                            <td colspan="3" align="center">Tổng điểm
                                                                            </td>
                                                                            <td>${mark.gk * 0.4 + mark.ck * 0.6}</td>
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
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body" id="mbody">
                                                                {{-- <table class="table table-striped table-bordered">
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
                                                                            <td>10</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2</td>
                                                                            <td>Cuối kỳ</td>
                                                                            <td>0.6</td>
                                                                            <td>8.3</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3" align="center">Tổng điểm
                                                                            </td>
                                                                            <td>9.1</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table> --}}
                                                            </div>
                                                            <div class="modal-footer">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
