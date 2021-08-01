@extends('layouts.admin')
@section('main')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">

                                {{-- selector --}}
                                <select class="btn btn-outline  dropdown-toggle" aria-label="Default select example">
                                    <option class="dropdown-item" selected>30</option>
                                    <option class="dropdown-item" value="1">50</option>
                                    <option class="dropdown-item" value="2">100</option>
                                    <option class="dropdown-item" value="3">Tất cả</option>
                                </select>
                                @can('manage-tasks')
                                    <a href="/task/create">
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
                                    <input type="text" class="form-control rounded" placeholder="Search" aria-label="Search"
                                        aria-describedby="search-addon" />
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
                                <table class="table table-hover">
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
                                                <td>
                                                    {{ $task->name }}
                                                </td>
                                                <td>
                                                    {{ $task->deadline }}
                                                </td>
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
                                                    <td>
                                                        {{ $task->receiver->name }}
                                                    </td>
                                                @endcan
                                                @cannot('manage-tasks')
                                                    <td>
                                                        {{ $task->creator->name }}
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
                                                <td><label class="badge {{ $status_type }}">{{ $status }}</label>
                                                </td>

                                                <td
                                                    style="
                                                                                                                                font-size: 24px;
                                                                                                                                margin: 0;
                                                                                                                                padding: 11px;
                                                                                                                                display: flex;
                                                                                                                                justify-content: start;
                                                                                                                                align-content: center;
                                                                                                                                align-items: center;
                                                                                                                                cursor:pointer
                                                                                                                            ">


                                                    <a href="/task/{{ $task->id }}/edit" class="mr-3">
                                                        <ion-icon name="create-outline"></ion-icon>
                                                    </a>
                                                    @can('manage-tasks')
                                                        <form action='/task/{{ $task->id }}' method='POST'>
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit">


                                                                <ion-icon name="trash-outline"></ion-icon>

                                                            </button>
                                                        </form>
                                                    @endcan
                                                    {{-- <a href="">
                                                        <ion-icon name="create-outline"></ion-icon>
                                                    </a> --}}

                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="12" style="padding: 0 !important">
                                                    <div class="accordian-body collapse" id="demo{{ $task->id }}">

                                                        {{ $task->detail }}

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
    <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
@endsection
