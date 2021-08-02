@extends('layouts.admin')
@section('main')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row flex justify-content-center">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold text-center">Tạo nhiệm vụ</h3>

                </div>
                <div class="col-lg-10 w-70 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <form class="forms-sample" action="/task" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold card-title">Tên Task</label>
                                    <input type="text" class="form-control" id="name" placeholder="Tên Task" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="deadline" class="font-weight-bold card-title">Thời hạn</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline">
                                </div>

                                <div class="form-group">
                                    <label for="assignee" class="font-weight-bold card-title">Giao cho </label>
                                    <select class="js-example-basic-single w-100" multiple="multiple" id="assignees[]"
                                        name="assignees[]">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name . ' MSV:' . $user->msv }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="detail" class="font-weight-bold card-title">Chi tiết</label>
                                    <textarea class="form-control" id="detail" rows="4" name="detail"></textarea>
                                </div>
                                <div class="row flex justify-content-center">
                                    <a href="/task" class="btn btn-light mr-2"
                                        style="border-radius: 2px;padding: 10px 37px; background-color: #bec1c3;">Hủy</a>
                                    <button type="submit" class="btn btn-primary "
                                        style="border-radius: 2px;padding: 10px 37px;">Thêm</button>


                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

     {{-- chi duoc de script nay o day thoi nhe --}}
    {{-- multiple select --}}
    {{-- <script src="../../vendors/js/vendor.bundle.base.js"></script> --}}

    <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="../../vendors/select2/select2.min.js"></script>
    <script src="../../js/select2.js"></script>
    {{-- multiple select end --}}

@endsection
