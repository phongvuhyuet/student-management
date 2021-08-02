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
                                <select class="btn btn-outline   dropdown-toggle" id="viewSelect"
                                    onchange="changeView({{ $courses }} , this.value)"
                                    onload="customWindowOnload({{ $courses }})" aria-label="Default select example">
                                    <option class="dropdown-item" selected value="2">20</option>
                                    <option class="dropdown-item" value="3">30</option>
                                    <option class="dropdown-item" value="5">50</option>
                                    <option class="dropdown-item" value="all">Tất cả</option>
                                </select>

                                <a href="/course/create" class=" text-reset flex align-self-center text-decoration-none">
                                    <div
                                        class="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    d-flex
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    flex-row
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    align-items-center align-self-center
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                        <p class="p-0 m-0 pr-1">
                                            Thêm môn học
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
                                            <th>STT</th>
                                            <th>Mã môn học</th>
                                            <th>Giảng viên</th>

                                            <th>Học kì</th>
                                            <th>Năm học</th>
                                            <th>Số tín chỉ</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableData">


                                        
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

                                    <li class="page-item">
                                        <a class="page-link" href="#">>></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const course = '<?php echo $courses; ?>';
        console.log(JSON.parse(course));
        // var complex = <?php echo json_encode($courses); ?>;
        // console.log(complex);

        function Search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");   
            filter = input.value.toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(/Đ/g, "D").trim();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(/Đ/g, "D").indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        
        const subjectData = <?php echo json_encode($courses); ?>;
        
    
        window.onload = () => {
            loadTableData(subjectData, 2);

        }


        function changeView(subjectData) {
            let index = document.getElementById('viewSelect').value;
            loadTableData(subjectData, index);
        }

        function loadTableData(subjectData, index) {
            // alert($courses)
            const tableBody = document.getElementById('tableData');
            let dataHTML = '';
            if (index != 'all') {
                if (subjectData.length < index) index = subjectData.length;
            } else {
                index = subjectData.length;
            }
            for (let i = 0; i < index; i++) {
                let subject = subjectData[i];
                dataHTML += `<tr>
                                <td>${i+1}</td>
                                <td>${subject.maMH}</td>
                                <td>${subject.name}</td>
                                <td>${subject.term}</td>
                                <td>${subject.year}</td>
                                <td>${subject.so_TC}</td>
                                <td>
                                    <div class="d-flex justify-content-around" style="font-size: 20px;">
                                        <a href=""><ion-icon name="create-outline"></ion-icon></a>
                                            <div></div>
                                        <a href=""><ion-icon name="trash-outline"></ion-icon></a>
                                    </div>
                                </td>
                            </tr>`;
            }
            console.log(dataHTML);

            tableBody.innerHTML = dataHTML;
        }

        
    </script>
@endsection
