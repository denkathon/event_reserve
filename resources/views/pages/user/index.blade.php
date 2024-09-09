@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h2>メニュー</h2>
            <ul class="nav flex-column">
                @foreach($menuItems as $key => $value)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reservations.show', $key) }}">{{ $value }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9">
            @yield('page-content')
        </div>
    </div>
</div>
@endsection