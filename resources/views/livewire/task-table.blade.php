<div>
    <style>
        .select {
            padding: 0px 5px 0px 0px;
        }

    </style>
    <div>
        <p class="card-title">Công việc</p>
        <div class='row'>
            <div class='col-md-1 d-flex justify-content-center align-item-center' name='label'
                style='padding-right: 0px; height: 54px;'>
                <div class='' style='margin: 0;
                    position: absolute;
                    top: 50%;
                    -ms-transform: translateY(-50%);
                    transform: translateY(-50%);
                    '>
                    <label class="p-1 m-0 pr-1 text-center" style=''>Xếp theo</label>
                </div>
            </div>
            <div class="col-md-2 select" name='select1'>
                <select wire:model="orderBy"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option value="id">ID</option>
                    <option value="name">Tên</option>
                    <option value="status">Trạng thái</option>
                    <option value="progress">Tiến độ</option>
                    @can('manage-tasks')
                        <option value="receiver_id">Giao cho</option>
                    @endcan
                    @cannot('manage-tasks')
                        <option value="creator_id">Được giao bởi</option>
                    @endcan
                </select>
                {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div> --}}
            </div>
            <div class="col-md-2 select" name='select2'>
                <select wire:model="orderAsc"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option value="1">Tăng dần</option>
                    <option value="0">Giảm dần</option>
                </select>
                {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div> --}}
            </div>
            <div class="col-md-1 select" name='select3'>
                <select wire:model="perPage"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div> --}}
            </div>

            <div class='col-md-3' name='add'>
                @can('manage-tasks')
                    <div class='d-flex justify-content-center align-item-center' style='padding-right: 0px; height: 54px;'>
                        <a href="/task/create" class="text-reset text-decoration-none d-flex " style='margin: 0;
                                position: absolute;
                                top: 50%;
                                -ms-transform: translateY(-50%);
                                transform: translateY(-50%);
                                '>
                            <label class="p-1 m-0 pr-1">Thêm công việc</label>
                            <ion-icon style="font-size: 32px; cursor: pointer;" name="add-circle-outline" role="img"
                                class="md hydrated" aria-label="add circle outline">
                            </ion-icon>
                        </a>
                    </div>
                @endcan
            </div>


            <div class="col-md-3" name='search' style='padding: 0px 30px 0px 0px;'>
                <input wire:model.debounce.300ms="search" type="text"
                    class="appearance-none block w-full  text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    placeholder="ID, tên công việc, người liên quan" style="overflow: hidden;text-overflow: ellipsis">
                <span style="cursor:pointer ;position: absolute;font-size: 23px; top: 11px;right: 29px;"
                    class="input-group-text border-0 p-0 bg-transparent fw-bolder fs-2" id="search-addon">
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="hover"
                        colors="primary:#121331,secondary:#08a88a" style="width:32px;height:32px">
                    </lord-icon>
                </span>
            </div>
        </div>
        <br>
    </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-hover">
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

                    <tr data-toggle="collapse" data-target="#demo{{ $task->id }}" class="accordion-toggle">
                        <td class="align-middle">
                            {{ $task->id }}
                        </td>
                        <td class="align-middle">
                            {{ $task->name }}
                        </td>
                        <td class="align-middle">
                            {{ $task->deadline }}
                        </td>
                        <td class="align-middle">
                            @php
                                $progress_type;
                                if ($task->progress < 33) {
                                    $progress_type = 'bg-danger';
                                } elseif ($task->progress < 100) {
                                    $progress_type = 'bg-warning';
                                } else {
                                    $progress_type = 'bg-success';
                                }
                                
                            @endphp
                            <div class="progress">
                                <div class="progress-bar align-middle {{ $progress_type }}" role="progressbar"
                                    style="width: {{ $task->progress }}%" aria-valuenow="75" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </td>
                        @can('manage-tasks')
                            <td class="align-middle">
                                {{ $task->receiver->name . ' MSV: ' . $task->receiver->msv }}
                            </td>
                        @endcan
                        @cannot('manage-tasks')
                            <td class="align-middle">
                                {{ $task->creator->name . ' MCV: ' . $task->creator->msv }}
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
                        <td class="align-middle"><label class="badge p-2 mt-0 align-middle {{ $status_type }}"
                                style="min-width: 70px">{{ $status }}</label>
                        </td>
                        <td>
                            <div class="icon_style d-flex justify-content-between" style="  font-size: 19px;
                                                        margin: 0;
                                                        padding: 16px;
                                                        display: flex;
                                                        justify-content: start;
                                                        align-content: center;
                                                        align-items: center;
                                                        cursor: pointer; padding: 8px">


                                <a href="/task/{{ $task->id }}/edit"
                                    class="mr-3 text-reset flex align-self-center align-middle text-decoration-none">
                                    <ion-icon name="create-outline" role="img" class="md hydrated"
                                        aria-label="create outline"></ion-icon>
                                </a>

                                @can('manage-tasks')
                                    <form action='/task/{{ $task->id }}' method='POST'>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="bg-transparent border-0 align-middle">
                                            <ion-icon name="trash-outline" role="img" class="md hydrated"
                                                aria-label="trash outline"></ion-icon>
                                        </button>
                                    </form>
                                @endcan

                                <div></div>
                                {{-- <a href="">
                                <ion-icon name="create-outline"></ion-icon>
                            </a> --}}
                            </div>
                        </td>

                    </tr>
                    <tr class="expanded-row">
                        <td colspan="12" class="row-bg" style="padding: 0 !important">
                            <div class="accordian-body p-2 collapse bg-light.bg-gradient"
                                style="background-color: beige" id="demo{{ $task->id }}">

                                <div class="card card-body w-100">
                                    <strong class="pb-2 fw-bold">Ghi chú:</strong>
                                    <p class="fs-2 fst-italic fw-bold">
                                        {{ $task->detail }}
                                    </p>
                                </div>

                            </div>
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>

    </div>
    <span class="d-flex justify-content-end">{!! $tasks->links('livewire::bootstrap') !!}</span>
</div>
