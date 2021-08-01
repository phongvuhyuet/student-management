@extends('layouts.admin')
@section('main')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class='row'>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Môn học</p>
                            <div class="d-flex justify-content-between">

                                {{-- selector --}}
                                <select class="btn btn-outline  dropdown-toggle" aria-label="Default select example">
                                    <option class="dropdown-item" selected>30</option>
                                    <option class="dropdown-item" value="1">50</option>
                                    <option class="dropdown-item" value="2">100</option>
                                    <option class="dropdown-item" value="3">Tất cả</option>
                                </select>

                                <a href="/course/create">
                                    <div class="
                                                                d-flex
                                                                flex-row
                                                                align-items-center align-self-center
                                                            ">
                                        <p class="p-0 m-0 pr-1">
                                            Thêm môn học
                                        </p>
                                        <ion-icon style="
                                                                    font-size: 30px;
                                                                    cursor: pointer;
                                                                " name="add-circle-outline">
                                        </ion-icon>
                                    </div>
                                </a>

                                {{-- search bar --}}
                                <div class=" rounded col-4 ">
                                    <input type="text" class="form-control rounded" placeholder="Mã môn học"
                                        aria-label="Search" aria-describedby="search-addon" onkeyup="Search()"
                                        id='myInput' />
                                    <span style="cursor:pointer ;position: absolute;font-size: 23px; top: 7px;right: 29px;"
                                        class="input-group-text border-0 p-0 bg-transparent fw-bolder fs-2"
                                        id="search-addon">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="hover"
                                            colors="primary:#121331,secondary:#08a88a" style="width:32px;height:32px">
                                        </lord-icon>
                                    </span>
                                </div>

                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-hover" id='myTable'>
                                    <thead>
                                        <tr>
                                            <th>Mã môn học</th>
                                            <th>Tên môn học</th>
                                            <th>Học kì</th>
                                            <th>Năm học</th>
                                            <th>Số tín chỉ</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $course->maMH }}</td>
                                                <td>{{ $course->name }}</td>
                                                <td>{{ $course->term }}</td>
                                                <td>{{ $course->year }}</td>
                                                <td>{{ $course->so_TC }}</td>
                                                <td>
                                                    <div class='d-flex justify-content-start' style="font-size: 20px;">
                                                        <a href="course/{{ $course->id }}/edit">
                                                            <ion-icon name="create-outline"></ion-icon>
                                                        </a>
                                                        <div></div>
                                                        <form action='/course/{{ $course->id }}' method='POST'
                                                            class="pl-3">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit">


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
                            <br>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination d-flex justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            << </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">>></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function Search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(
                /Đ/g, "D").trim();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(
                            /Đ/g, "D").indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
