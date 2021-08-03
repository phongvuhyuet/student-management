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
                        <p class="card-title">Môn học</p>

                        <a href="/course/create"
                            class=" text-reset flex flex-row-reverse align-self-center text-decoration-none">
                            <div class="d-flex flex-row align-items-center align-self-center ">
                                <p class="p-0 m-0 pr-1">
                                    Thêm môn học
                                </p>
                                <ion-icon style="font-size: 30px;cursor: pointer;" name="add-circle-outline">
                                </ion-icon>
                            </div>
                        </a>

                        <table id="mydata" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style='Width: 25px'>
                                        STT
                                    </th>
                                    <th>Mã môn học</th>
                                    <th>Giảng viên</th>
                                    <th>Kì</th>
                                    <th>Năm</th>
                                    <th>Số tín chỉ</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            {{-- insert data here --}}
                            <tbody class="data_entry">
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $course->maMH }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->term }}</td>
                                        <td>{{ $course->year }}</td>
                                        <td>{{ $course->so_TC }}</td>
                                        <td>
                                            <div class='d-flex justify-content-start' style="font-size: 20px;">
                                                <a href="course/{{ $course->id }}/edit"
                                                    class="mr-3 text-reset flex align-self-center text-decoration-none">
                                                    <ion-icon name="create-outline"></ion-icon>
                                                </a>
                                                <div></div>
                                                <form action='/course/{{ $course->id }}' method='POST' class="pl-3">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="bg-transparent border-0">
                                                        <ion-icon name="trash-outline"></ion-icon>
                                                    </button>
                                                </form>
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
