@extends('layouts.admin') @section('main')

    <div class="container">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Nhập thông tin sinh viên</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Họ và tên </label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Họ và tên " />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã sinh viên </label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Mã sinh viên" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <label for="">Ngày sinh</label>
                            <input type="date" class="form-control" id="exampleInputEmail2" placeholder="Ngày sinh" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1"> Lớp </label>
                            <input type="text" class="form-control" id="exampleInputConfirmPassword1" placeholder="Lớp" />
                        </div>

                        <button type="submit" class="btn btn-primary " style="border-radius: 2px;padding: 10px 37px;">Thêm
                        </button>
                        <a href="/" class="btn btn-light mr-2"
                            style="border-radius: 2px;padding: 10px 37px; background-color: #bec1c3;">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
