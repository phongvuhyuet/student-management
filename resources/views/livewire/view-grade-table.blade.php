<div>
    <div class="w-full flex pb-10">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                placeholder="Tìm kiếm tên hoặc mã sinh viên">
        </div>
        <div class="w-1/6 relative mx-1">
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
        <div class="w-1/6 relative mx-1">
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
        <div class="w-1/6 relative mx-1">
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
        <div class="w-1/6 relative mx-1">
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

                    <tr>
                        <td>{{ $student->msv }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->class->name }}</td>
                        <td>{{ $student->AccumulatedCredits }}</td>
                        <td>{{ $student->GPA }}</td>
                        <td>{{ $student->SoTinNo }}</td>
                        <td>{{ $student->so_lan_nhac_nho }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <span class="d-flex justify-content-end">{!! $students->links('livewire::bootstrap') !!}</span>
</div>
