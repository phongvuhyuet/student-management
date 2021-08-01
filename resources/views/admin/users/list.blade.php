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
                        <p class="card-title">Danh sách sinh viên</p>

                        <table id="mydata" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" onclick="checkAll(this)" />
                                    </th>
                                    <th>Họ và Tên</th>
                                    <th>Email</th>
                                    <th>Mã số sinh viên</th>
                                    <th>Ngày sinh</th>
                                    <th>Lớp</th>
                                    <th>Khoa</th>
                                </tr>
                            </thead>

                            {{-- insert data here --}}
                            <tbody class="data_entry">
                                <tr>
                                    <td><input type="checkbox" name="" /></td>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="" /></td>
                                    <td>Mã số sinh viên</td>
                                    <td>System Architect</td>
                                    <td>1234534567</td>

                                    <td>2011/04/25</td>
                                    <td>61</td>
                                    <td>CNTT</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="" /></td>
                                    <td>Họ và Tên</td>
                                    <td>System Architect</td>
                                    <td>1234534567</td>

                                    <td>2011/04/25</td>
                                    <td>61</td>
                                    <td>CNTT</td>
                                </tr>
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
