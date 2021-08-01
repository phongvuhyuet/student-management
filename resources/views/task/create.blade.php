@extends('layouts.admin')
@section('main')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <form class="forms-sample" action="/task" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên Task</label>
                                    <input type="text" class="form-control" id="name" placeholder="Tên Task" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="deadline">Thời hạn</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline">
                                </div>

                                <div class="form-group">
                                    <label for="assignee">Giao cho </label>
                                    <select class="js-example-basic-single w-100" multiple="multiple" id="assignees[]"
                                        name="assignees[]">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name . ' MSV:' . $user->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="detail">Chi tiết</label>
                                    <textarea class="form-control" id="detail" rows="4" name="detail"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                                <button class="btn btn-light">Hủy</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
