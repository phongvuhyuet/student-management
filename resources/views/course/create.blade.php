@extends('layouts.admin')
@section('main')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <form class="forms-sample" action="/course" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="maMH">Mã môn học</label>
                                    <input type="text" class="form-control" id="maMH" name="maMH">
                                </div>
                                <div class="form-group">
                                    <label for="name">Tên môn học</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="term">Học kì</label>
                                    <input type="number" class="form-control" id="term" name="term" max="3" min="1">
                                </div>

                                <div class="form-group">
                                    <label for="year">Năm học</label>
                                    <input type="number" class="form-control" id="year" name="year" max="2025" min="2016">
                                </div>
                                <div class="form-group">
                                    <label for="so_TC">Số tín chỉ</label>
                                    <input type="number" class="form-control" id="so_TC" name="so_TC" max="5" min="1">
                                </div>
                                <a href="/course" class="btn btn-light mr-2"
                                    style="border-radius: 2px;padding: 10px 37px; background-color: #bec1c3;">Hủy</a>
                                <button type="submit" class="btn btn-primary "
                                    style="border-radius: 2px;padding: 10px 37px;">Thêm</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
