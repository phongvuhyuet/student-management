@extends('layouts.admin') @section('main')
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

    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    {{-- table_database --}}
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Công việc</p>

                        <table id="mydata" class="table table-striped table-bordered" style="width: 100%">
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

                            {{-- insert data here --}}
                            <tbody class="data_entry">
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->deadline }}</td>
                                        <td>
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
                                                <div class="progress-bar {{ $progress_type }}" role="progressbar"
                                                    style="width: {{ $task->progress }}%" aria-valuenow="75"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        @can('manage-tasks')
                                            <td>{{ $task->receiver->name . ' MSV: ' . $task->receiver->msv }}</td>
                                        @endcan
                                        @cannot('manage-tasks')
                                            <td>{{ $task->creator->name . ' MCV: ' . $task->creator->msv }}</td>
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
                                        <td><label class="badge p-2 {{ $status_type }}"
                                                style="min-width: 70px">{{ $status }}</label>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-around" style="font-size: 20px;">
                                                <a href="">
                                                    <ion-icon name="create-outline"></ion-icon>
                                                </a>
                                                <div></div>
                                                <a href="">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                </a>
                                            </div>
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

    <script>
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



        function fnClickAddRow() {
            $('#example').dataTable().fnAddData([
                giCount + ".1",
                giCount + ".2",
                giCount + ".3",
                giCount + ".4"
            ]);

            giCount++;
        }

        function checkAll(bx) {
            var cbs = document.getElementsByTagName("input");
            for (var i = 0; i < cbs.length; i++) {
                if (cbs[i].type == "checkbox") {
                    cbs[i].checked = bx.checked;
                }
            }
        }
    </script>
@endsection
