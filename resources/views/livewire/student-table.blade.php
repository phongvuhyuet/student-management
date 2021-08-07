<div>

    <a href="/class/{{ $id }}/create"
        class=" text-reset flex flex-row-reverse align-self-center text-decoration-none">
        <div class="d-flex flex-row align-items-center align-self-center ">
            <p class="p-0 m-0 pr-1">
                Thêm học sinh
            </p>
            <ion-icon style="font-size: 30px;cursor: pointer;" name="add-circle-outline">
            </ion-icon>
        </div>
    </a>

    <div class="w-3/6 mx-1">
        <input wire:model.debounce.300ms="search" type="text"
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            placeholder="Tìm kiếm tên, email, mã sinh viên">
    </div>
    <div class="w-1/6 relative mx-1">
        <select wire:model="orderBy"
            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-state">
            <option value="name">Họ và Tên</option>
            <option value="email">Email</option>
            <option value="msv">Mã số sinh viên</option>
            <option value="dat_of_birth">Ngày sinh</option>
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
    <div class="table-responsive">
        <br>
        <table class="table table-hover">

            <thead>
                <tr>
                    <th>
                        STT
                    </th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Mã số sinh viên</th>
                    <th>Ngày sinh</th>
                    <th>Lớp</th>
                    <th>Khoa</th>
                </tr>
            </thead>

            {{-- insert data here --}}
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->msv }}</td>
                        <td>{{ $student->date_of_birth }}</td>
                        <td>{{ $student->class->name }}</td>
                        <td>{{ $student->class->faculty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <span class="d-flex justify-content-end">{!! $students->links('livewire::bootstrap') !!}</span>
</div>
