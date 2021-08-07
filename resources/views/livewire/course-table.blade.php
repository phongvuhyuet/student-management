<div>



    <a href="/course/create" class=" text-reset flex flex-row-reverse align-self-center text-decoration-none">
        <div class="d-flex flex-row align-items-center align-self-center ">
            <p class="p-0 m-0 pr-1">
                Thêm môn học
            </p>
            <ion-icon style="font-size: 30px;cursor: pointer;" name="add-circle-outline">
            </ion-icon>
        </div>
    </a>

    <div class="w-3/6 mx-1">
        <input wire:model.debounce.300ms="search" type="text"
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            placeholder="Tìm kiếm tên, mã môn, năm học">
    </div>
    <div class="w-1/6 relative mx-1">
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
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>
                                <div></div>
                                <form action='/course/{{ $course->id }}' method='POST' class="pl-3">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-transparent border-0">
                                        <ion-icon name="trash-outline"></ion-icon>
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
