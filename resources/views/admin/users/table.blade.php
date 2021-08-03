@extends('layouts.admin') @section('main')
    <style>
        .carousel-item {
            height: 600px;
            object-fit: cover
        }

        .carousel-item img {
            height: 100%;
        }

    </style>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 h-100  "
                                        src="https://scontent.fhan3-1.fna.fbcdn.net/v/t39.30808-6/217827665_2268955103246897_4197327919822402208_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=0debeb&_nc_ohc=j9mzHHdCeFoAX9DnsmE&_nc_ht=scontent.fhan3-1.fna&oh=2e3c171c3f1f52a5d687d364c205442f&oe=610B8ED0"
                                        data-color="lightblue" alt="First Image">
                                    <div class="carousel-caption d-md-block">
                                        <h5>First Image</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 h-100"
                                        src="https://scontent.fhan3-3.fna.fbcdn.net/v/t39.30808-6/228096912_2273250222817385_2977296643895585271_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=0debeb&_nc_ohc=-RseN9n_L9YAX-gtO0t&_nc_ht=scontent.fhan3-3.fna&oh=79910d9e18692093f02f5d279db2ebf6&oe=610AB466"
                                        data-color="firebrick" alt="Second Image">
                                    <div class="carousel-caption d-md-block">
                                        <h5>Second Image</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 h-100"
                                        src="https://scontent.fhan3-2.fna.fbcdn.net/v/t1.6435-9/221941083_814117452635939_8239861762149026769_n.jpg?_nc_cat=111&ccb=1-3&_nc_sid=8bfeb9&_nc_ohc=ich9H9kBeqoAX-zvUWN&tn=VbHeUG1J2EAzs6Ob&_nc_ht=scontent.fhan3-2.fna&oh=356d2dc2022ea80c5cb867756b194d64&oe=612A7E45"
                                        data-color="violet" alt="Third Image">
                                    <div class="carousel-caption d-md-block">
                                        <h5>Third Image</h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Controls -->
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.carousel').carousel({
            interval: 6000,
            pause: "false",

            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: false
                }
            }
        });


        let subjectData = [{
                id: '0001',
                name: 'CNTT',
                gv: 'Nguyễn Văn A',
                term: 'II_20-21',
                tc: 4
            },
            {
                id: '0002',
                name: 'Nhập môn lập trình',
                gv: 'Phạm Văn B',
                term: 'II_20-21',
                tc: 4
            },
            {
                id: '0003',
                name: 'Giải tích 1',
                gv: 'Trần Thị C',
                term: 'II_20-21',
                tc: 4
            },
            {
                id: '0001',
                name: 'VLĐC 1',
                gv: 'Lê Văn D',
                term: 'II_20-21',
                tc: 4
            },
            {
                id: '0001',
                name: 'NL Marx-Lenin',
                gv: 'Đinh thị G',
                term: 'II_20-21',
                tc: 2
            }
        ]

        window.onload = () => {
            loadTableData(subjectData, 3);
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
                for (let i = 0; i < index; i++) {
                    let subject = subjectData[i];
                    dataHTML +=
                        `<tr><td>${subject.id}</td><td>${subject.name}</td><td>${subject.gv}</td><td>${subject.term}</td><td>${subject.tc}</td><td><div class="d-flex justify-content-around" style="font-size: 20px;"><a href=""><ion-icon name="create-outline"></ion-icon></a><div></div><a href=""><ion-icon name="trash-outline"></ion-icon></a></div></td></tr>`;
                }
            } else {
                for (let subject of subjectData) {
                    dataHTML +=
                        `<tr><td>${subject.id}</td><td>${subject.name}</td><td>${subject.gv}</td><td>${subject.term}</td><td>${subject.tc}</td><td><div class="d-flex justify-content-around" style="font-size: 20px;"><a href=""><ion-icon name="create-outline"></ion-icon></a><div></div><a href=""><ion-icon name="trash-outline"></ion-icon></a></div></td></tr>`;
                }
            }
            console.log(dataHTML);

            tableBody.innerHTML = dataHTML;
        }
    </script>
@endsection
