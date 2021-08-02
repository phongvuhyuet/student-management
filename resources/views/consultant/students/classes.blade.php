@extends('layouts.admin')
@section('main')
    {{-- <style>
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

    </style> --}}
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
                        <div class="col-md-12">
                            <h3 class="font-weight-bold">Các lớp học đang quản lý</h3>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap transparent">
                            @foreach ($classes as $class)
                                <a href="class/{{ $class->id }}/students"
                                    class="class_management card-body card-table col-md-6 mb-4 mt-5 mb-lg-0 stretch-card transparent text-decoration-none">
                                    <div class="col-md-12 mb-4 mb-lg-0 stretch-card transparent">
                                        <div class="card  card-table card-light-blue">
                                            <div class="class_management card-body">
                                                <p class=" fs-30 mb-4">{{ $class->name }}</p>
                                                <p class=" mb-2">Số lượng sinh viên:
                                                    {{ $class->member->where('role_id', 2)->count() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
