@extends('layouts.admin')
@section('main')
    @php
    include 'utils.php';
    @endphp
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <p class="card-title">Kết quả học tập</p>
                                            <div class="card-body">
                                                @livewireStyles
                                                <livewire:view-grade-table>
                                                    @livewireScripts

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
