<div>
    <style>
        .select {
            padding: 0px 5px 0px 0px;
        }
    </style>
    <div>
        <p class="card-title">Kết quả học tập</p>
        <div class="row">
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
                    <option value="msv">MSV</option>
                    <option value="name">Tên</option>
                    <option value="AccumulatedCredits">Số TC</option>
                    <option value="GPA">GPA</option>
                    <option value="SoTinNo">Số TC đang nợ</option>
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

            <div class="col-md-2 select" name='select4'>
                <select wire:model="class"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option value="all">Tất cả các lớp</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    </svg>
                </div>
            </div>

            <div class='col-md-1'></div>

            <div class="col-md-3" name='search' style='padding: 0px 30px 0px 0px;'>
                <input wire:model.debounce.300ms="search" type="text"
                    class="appearance-none block w-full  text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    placeholder="Tìm kiếm tên hoặc mã sinh viên" style="overflow: hidden;text-overflow: ellipsis">
                <span style="cursor:pointer ;position: absolute;font-size: 23px; top: 11px;right: 29px;"
                    class="input-group-text border-0 p-0 bg-transparent fw-bolder fs-2" id="search-addon">
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="hover"
                        colors="primary:#121331,secondary:#08a88a" style="width:32px;height:32px">
                    </lord-icon>
            </div>
        </div>
        <br>
    </div>
    <div class="table-responsive">
        <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Tên SV</th>
                    <th>Lớp</th>
                    <th>Số TC tích lũy</th>
                    <th>GPA</th>
                    <th>Số TC đang nợ</th>
                    <th>Số lần nhắc nhở</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $studentss;
                    if ($orderBy !== 'msv' && $orderBy !== 'name') {
                        if ($orderAsc) {
                            $studentss = $students->sortBy($orderBy);
                        } else {
                            $studentss = $students->sortByDesc($orderBy);
                        }
                    } else {
                        $studentss = $students;
                    }
                @endphp

                @foreach ($studentss as $student)

                    <tr onclick="location.href='/marks/{{ $student->id }}'" style="cursor: pointer">
                        <td>{{ $student->msv }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->class->name }}</td>
                        <td>{{ $student->AccumulatedCredits }}</td>
                        <td>{{ number_format((float) $student->GPA, 2, '.', '') }}</td>
                        <td>{{ $student->SoTinNo }}</td>
                        <td>{{ $student->so_lan_nhac_nho ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <span class="d-flex justify-content-end">{!! $students->links('livewire::bootstrap') !!}</span>
</div>
