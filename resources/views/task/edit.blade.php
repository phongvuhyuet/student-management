@extends(Auth::user()->role_id == 2 ? 'layouts.student' : 'layouts.admin')
@section('main')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row h-100">

                <div class="col-lg-12 grid-margin stretch-card h-100">
                    <div class="card">
                        <div class="card-body">
                            <form action="/task/{{ $task->id }}" method="POST" class="form-example">
                                @csrf
                                @method("PUT")
                                @can('manage-tasks')
                                    <h2>Giao cho {{ $task->receiver->name . ' MSV: ' . $task->receiver->msv }}</h2>
                                    <div class="form-group mt-4">
                                        <label for="name">Tên Task</label>
                                        <input type="text" class="form-control" id="name" placeholder="Tên Task" name="name"
                                            value="{{ $task->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="deadline">Thời hạn</label>
                                        <input type="date" class="form-control" id="deadline" name="deadline"
                                            value="{{ $task->deadline }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Chi tiết</label>
                                        <textarea class="form-control" id="detail" rows="4"
                                            name="detail">{{ $task->detail }}</textarea>
                                    </div>
                                @endcan
                                @cannot('manage-tasks')
                                    <h2>Được giao bởi {{ $task->creator->name . ' MCV: ' . $task->creator->msv }}</h2>
                                    <div class="form-group mt-4">
                                        @php
                                            $selected = [
                                                'new' => '',
                                                'doing' => '',
                                                'done' => '',
                                            ];
                                            $selected[$task->status] = 'selected';

                                        @endphp
                                        <label for="status">Trạng thái</label>
                                        <select class="form-control form-control-lg" id="assignee" name="status">
                                            <option value="new" @php
                                                echo $selected['new'];
                                            @endphp>Mới</option>
                                            <option value="doing" @php
                                                echo $selected['doing'];
                                            @endphp>Đang hoàn thành</option>
                                            <option value="done" @php
                                                echo $selected['done'];
                                            @endphp>Đã hoàn thành</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="progress">Tiến độ</label>
                                        <input type="number" max='100' min='0' class="form-control" id="progress"
                                            value="{{ $task->progress }}" name="progress">
                                    </div>
                                @endcannot
                                <a href="/task" class="btn btn-light mr-2"
                                    style="border-radius: 2px;padding: 10px 37px background-color: #bec1c3;;">Hủy</a>
                                <button type="submit" class="btn btn-primary "
                                    style="border-radius: 2px;padding: 10px 37px;">Sửa</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
