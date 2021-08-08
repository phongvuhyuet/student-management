@extends('layouts.master')
@section('layout')
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="ti-home menu-icon"></i>
                    <span class="menu-title">Trang chủ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/classes">
                    <i class="ti-user menu-icon"></i>
                    <span class="menu-title">Sinh viên</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/course">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">Môn học</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/view-grade">
                    <i class="ti-bookmark-alt menu-icon"></i>
                    <span class="menu-title">Kết quả học tập</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/task">
                    <i class="ti-menu-alt menu-icon"></i>
                    <span class="menu-title">Công việc</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/statistical">
                    <i class="ti-bar-chart menu-icon"></i>
                    <span class="menu-title">Thống kê</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/chat">
                    <i class="ti-comments menu-icon"></i>
                    <span class="menu-title">Tin nhắn</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- main -->
    @yield('main')
@endsection
