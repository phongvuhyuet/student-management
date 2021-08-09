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
                <a class="nav-link" href="/marks/{{ auth()->user()->id }}">
                    <i class="ti-bookmark-alt menu-icon"></i>
                    <span class="menu-title">Kết quả học tập</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/task">
                    <i class="ti-menu-alt menu-icon"></i>
                    <span class="menu-title">Nhiệm vụ</span>
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
