@extends('layouts.admin')
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
                                                                <th>Mã SV</th>
                                                                <th>Tên SV</th>
                                                                <th>Lớp</th>
                                                                <th>Số TC tích lũy</th>
                                                                <th>GPA</th>
                                                                <th>Số TC đang nợ</th>
                                                                <th>Số lần nhắc nhở</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($students as $student)

                                                                <tr>
                                                                    <td>{{ $student->msv }}</td>
                                                                    <td>{{ $student->name }}</td>
                                                                    <td>{{ $student->class->name }}</td>
                                                                    <td>{{ getAccumulatedCredits($student) }}</td>
                                                                    <td>{{ calculateGPA($student) }}</td>
                                                                    <td>11</td>
                                                                    <td>{{ $student->so_lan_nhac_nho }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
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
