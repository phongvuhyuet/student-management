@extends(Auth::user()->role_id == 2 ? 'layouts.student' : 'layouts.admin')
@section('main')
    @livewireStyles
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <livewire:messages>
        @livewireScripts
    @endsection
