@extends('layouts.admin') @section('main')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Danh sách sinh viên</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    {{-- selector --}}
                                    <select class="btn btn-outline dropdown-toggle" aria-label="Default select example">
                                        <option class="dropdown-item" selected>
                                            30
                                        </option>
                                        <option class="dropdown-item" value="1">
                                            50
                                        </option>
                                        <option class="dropdown-item" value="2">
                                            100
                                        </option>
                                        <option class="dropdown-item" value="3">
                                            Tất cả
                                        </option>
                                    </select>

                                    {{-- search bar --}}
                                    <div class="rounded col-4">
                                        <input type="text" class="form-control rounded" placeholder="Search"
                                            aria-label="Search" aria-describedby="search-addon" />
                                        <span style="
                                                                                                cursor: pointer;
                                                                                                position: absolute;
                                                                                                font-size: 23px;
                                                                                                top: 7px;
                                                                                                right: 29px;
                                                                                            " class="
                                                                                                input-group-text
                                                                                                border-0
                                                                                                p-0
                                                                                                bg-transparent
                                                                                                fw-bolder
                                                                                                fs-2
                                                                                            " id="search-addon">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="hover"
                                                colors="primary:#121331,secondary:#08a88a"
                                                style="width: 32px; height: 32px">
                                            </lord-icon>
                                        </span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover" style="width: 100%">
                                        <thead>
                                            <tr>

                                                <th>Họ và Tên</th>
                                                <th>Mã số sinh viên</th>
                                                <th>Ngày sinh</th>
                                                <th>Lớp</th>
                                                <th>Khoa</th>
                                                <th>Email</th>
                                                <th>Chi tiết</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">$user ->name</th>
                                                <td>19020001</td>
                                                <td>$user->date_of_birth</td>
                                                <td>$user->class</td>
                                                <td>$user->faculty</td>
                                                <td>$user->email</td>
                                                <td style="
                                                                            font-size: 24px;
                                                                            margin: 0;
                                                                            padding: 11px;
                                                                            display: flex;
                                                                            justify-content: center;
                                                                            align-content: center;
                                                                            align-items: center;
                                                                            cursor: pointer;
                                                                        ">
                                                    <a href="">
                                                        <ion-icon name="ellipsis-horizontal-circle-outline">
                                                        </ion-icon>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <nav aria-label="Page navigation example mt-1 " style="margin-top: 27px">
                                    <ul class="
                                                                                            pagination
                                                                                            d-flex
                                                                                            justify-content-end
                                                                                        ">
                                        <li class="page-item">
                                            <a class="page-link" href="#">Trước </a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">
                                                Tiếp theo</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->

    <!-- partial -->

@endsection
