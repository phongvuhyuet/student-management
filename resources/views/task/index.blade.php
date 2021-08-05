@extends(Auth::user()->role_id == 2 ? 'layouts.student' : 'layouts.admin')
@section('main')
    <style>
        table {
            width: 100%;
        }

        #mydata_filter {
            float: right;
        }

        #mydata_paginate {
            float: right;
        }



        label {
            display: inline-flex;
            margin-bottom: 0.5rem;
            margin-top: 0.5rem;
        }

        .table_detail {
            font-size: 24px;
            margin: 0;
            padding: 11px;
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
            cursor: pointer;
        }

        .icon_style {
            font-size: 19px;
            margin: 0;
            padding: 16px;
            display: flex;
            justify-content: start;
            align-content: center;
            align-items: center;
            cursor: pointer
        }

    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">

                                {{-- selector --}}
                                <select class="btn btn-outline  dropdown-toggle" aria-label="Default select example"
                                    id='myFilter' onchange="filter()">
                                    <option class="dropdown-item" selected value="All">Tất cả</option>
                                    <option class="dropdown-item" value="Mới">Mới</option>
                                    <option class="dropdown-item" value="Đang hoàn thành">Đang hoàn thành</option>
                                    <option class="dropdown-item" value="Đã xong">Đã xong</option>
                                    <option class="dropdown-item" value="Quá hạn">Quá hạn</option>
                                </select>
                                @can('manage-tasks')
                                    <a href="/task/create" class=" text-reset flex align-self-center text-decoration-none">
                                        <div
                                            class="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    d-flex
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    flex-row
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    align-items-center align-self-center
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                            <p class="p-0 m-0 pr-1">
                                                Thêm công việc
                                            </p>
                                            <ion-icon
                                                style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        font-size: 30px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        cursor: pointer;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "
                                                name="add-circle-outline">
                                            </ion-icon>
                                        </div>
                                    </a>
                                @endcan
                                {{-- search bar --}}
                                <div class=" rounded col-4 ">
                                    <input onkeyup="search()" id='myInput' type="text" class="form-control rounded"
                                        placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                    <span style="cursor:pointer ;position: absolute;font-size: 23px; top: 7px;right: 29px;"
                                        class="input-group-text border-0 p-0 bg-transparent fw-bolder fs-2"
                                        id="search-addon">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="hover"
                                            colors="primary:#121331,secondary:#08a88a" style="width:32px;height:32px">
                                        </lord-icon>
                                    </span>
                                </div>

                            </div>
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
                                                            role="progressbar" style="width: {{ $task->progress }}%"
                                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                            <button type="submit" class="bg-transparent border-0 align-middle">
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
                                                        style="background-color: beige" id="demo{{ $task->id }}">

                                                        <div class="card card-body w-100">
                                                            <strong class="pb-2 fw-bold">Ghi chú:</strong>
                                                            <p class="fs-2 fst-italic fw-bold">
                                                                {{ $task->detail }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example" class="mt-3">
                                    <ul class="pagination d-flex justify-content-end">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(
                /Đ/g, "D").trim();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(
                            /Đ/g, "D").indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function filter() {
            var input, filter, table, tr, td, i, textValue;
            input = document.getElementById("myFilter");
            filter = input.value;
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            if (filter != "All") {
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[5];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            } else {
                for (i = 0; i < tr.length; i++) {
                    tr[i].style.display = "";
                }
            }
        }
    </script>
@endsection
