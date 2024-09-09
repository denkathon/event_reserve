@extends('layouts.app')

@section('content')
<div class="venue-details-container">
    <h1>{{ $venue->name }}</h1>
    <p>{{ $venue->address }}</p>
    <!-- 他の詳細情報をここに追加 -->
</div>
@endsection
