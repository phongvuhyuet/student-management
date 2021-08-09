<div>
    <style>
        .select {
            padding: 0px 5px 0px 0px;
        }
    </style>

    <div>
        <p class="card-title">Môn học</p>
        <div class='row'>
            <div class='col-md-1 d-flex justify-content-center align-item-center' name='label' style='padding-right: 0px; height: 54px;'>
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
                    <option value="maMH">Mã môn học</option>
                    <option value="name">Tên môn học</option>
                    <option value="term">Kì</option>
                    <option value="year">Năm</option>
                    <option value="so_TC">Số tín chỉ</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    </svg>
                </div>
            </div>

            <div class="col-md-2 select" name='select2'>
                <select wire:model="orderAsc"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option value="1">Tăng dần</option>
                    <option value="0">Giảm dần</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    </svg>
                </div>
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
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    </svg>
                </div>
            </div>

            <div class="col-md-3" name='add' style='padding-right: 0px; height: 54px;'>
                <div class='d-flex justify-content-center align-item-center' style=' padding: 11px 0px 11px 0px;'>
                    <a href="/course/create" class="text-reset text-decoration-none d-flex " style='margin: 0;
                    position: absolute;
                    top: 50%;
                    -ms-transform: translateY(-50%);
                    transform: translateY(-50%);
                    '>
                        <label class="p-1 m-0 pr-1">Thêm môn học</label>
                        <ion-icon style="font-size: 32px; cursor: pointer;" name="add-circle-outline" role="img"
                            class="md hydrated" aria-label="add circle outline">
                        </ion-icon>
                    </a>
                </div>
            </div>

            <div class="col-md-3" name='search' style='padding: 0px 30px 0px 0px;'>
                <input wire:model.debounce.300ms="search" type="text"
                    class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    placeholder="Tìm kiếm tên, mã môn, năm học" style="overflow: hidden;text-overflow: ellipsis">
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
        <br>
        <table class="table table-hover">

            <thead>
                <tr>
                    <th>
                        STT
                    </th>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Kì</th>
                    <th>Năm</th>
                    <th>Số tín chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            {{-- insert data here --}}
            <tbody>
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
                                    <ion-icon name="create-outline" role="img" class="md hydrated"
                                        aria-label="create outline"></ion-icon>
                                </a>
                                <div></div>
                                <form action='/course/{{ $course->id }}' method='POST' class="pl-3">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-transparent border-0">
                                        <ion-icon name="trash-outline" role="img" class="md hydrated"
                                            aria-label="trash outline"></ion-icon>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <span class="d-flex justify-content-end">{!! $courses->links('livewire::bootstrap') !!}</span>
</div>
