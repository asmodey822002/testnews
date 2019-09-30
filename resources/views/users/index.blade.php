@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{url('/addnews/create')}}">Add News</a></li>
                <li class="list-group-item"><a href="{{url('/favorites/'.Auth::user()->id)}}">Favorites</a></li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="row">
                @include('parts.successe')
            </div>
            <div class="row">
                @yield('mainContent')
            </div>
        </div>
    </div>
</div>
@endsection