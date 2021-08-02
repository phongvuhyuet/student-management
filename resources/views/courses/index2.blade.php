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

                                <!-- {{-- selector --}} -->
                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label text-center">Hiển thị</label>
                                        <div class="rounded col-sm-3">
                                            <select class="form-control rounded" id='viewSelect' onchange="changeView()">
                                                <option value=3>3</option>
                                                <option value=5>5</option>
                                                <option value=100>100</option>
                                                <option value='all'>Tất cả</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex flex-row align-items-center align-self-center">
                                    <p class="p-0 m-0 pr-1">Thêm công việc</p>
                                    <ion-icon style=" font-size: 30px;cursor: pointer;" name="add-circle-outline">
                                    </ion-icon>
                                </div>
                                <!-- {{-- search bar --}} -->
                                <div class=" rounded col-4 " style="padding-right: 0px">
                                    <input type="text" class="form-control rounded" placeholder="Tìm kiếm"
                                        aria-label="Tìm kiếm" aria-describedby="search-addon" onkeyup="Search()" id='myInput' />
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
                                            <th class="sort" onclick="sortTable(0)" style="cursor: pointer">Mã môn học
                                                {{-- <i class="mdi mdi-arrow-up"></i> --}}
                                            </th>
                                            <th onclick="sortTable(1)" onclick="changeIcon()" style="cursor: pointer">Tên
                                                môn học</th>
                                            <th onclick="sortTable(2)" style="cursor: pointer">Giảng viên</th>
                                            <th onclick="sortTable(3)" style="cursor: pointer">Học kì</th>
                                            <th>Số tín chỉ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id='tableData'>
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
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a
                        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                    BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                        class="ti-heart text-danger ml-1"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->

    <!-- partial -->
@endsection


@section('script')
    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("myTable");
            switching = true;
            //Set the sorting direction to ascending:
            dir = "asc";
            /*Make a loop that will continue until
            no switching has been done:*/
            while (switching) {
                //start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /*Loop through all table rows (except the
                first, which contains table headers):*/
                for (i = 1; i < (rows.length - 1); i++) {
                    //start by saying there should be no switching:
                    shouldSwitch = false;
                    /*Get the two elements you want to compare,
                    one from current row and one from the next:*/
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /*check if the two rows should switch place,
                    based on the direction, asc or desc:*/
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /*If a switch has been marked, make the switch
                    and mark that a switch has been done:*/
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    //Each time a switch is done, increase this count by 1:
                    switchcount++;
                } else {
                    /*If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again.*/
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
   

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

        <?php
            $subjectData = array (
                array('id'=>'0001', 'name'=>'CNTT', 'gv'=>'Nguyễn Văn A', 'term'=>'II_20-21', 'tc'=>'4'),
                array('id'=>'0002', 'name'=>'Nhập môn lập trình', 'gv'=>'Phạm Văn B', 'term'=>'II_20-21', 'tc'=>'4'),
                array('id'=>'0002', 'name'=>'Giải tích 1', 'gv'=>'Trần Thị C', 'term'=>'II_20-21', 'tc'=>'4'),
                array('id'=>'0002', 'name'=>'VLĐC 1', 'gv'=>'Lê Văn D', 'term'=>'II_20-21', 'tc'=>'4'),
                array('id'=>'0002', 'name'=>'NL Marx-Lenin', 'gv'=>'Đinh thị G', 'term'=>'II_20-21', 'tc'=>'2'),
            )
        ?>

        let subjectData = <?php echo json_encode($subjectData); ?>;

        window.onload = () => { 
            let index = document.getElementById('viewSelect').value;
            loadTableData(subjectData, index);
        }

        function changeView() {
            let index = document.getElementById('viewSelect').value;
            loadTableData(subjectData, index);
        }

        function loadTableData(subjectData, index) {
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
                                <td>${subject.id}</td>
                                <td>${subject.name}</td>
                                <td>${subject.gv}</td>
                                <td>${subject.term}</td>
                                <td>${subject.tc}</td>
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
