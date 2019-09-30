@extends('dashboard')
@section('header')
	@include('header')
@endsection
@section('sidebar')
	<ul class="list-group">
		@foreach($categoriesOnSidebar as $category)
			<li class="list-group-item"><a href="{{url('/category/'.$category->id)}}">{{$category->name}}</a></li>
		@endforeach
		@guest
		@else
			<li class="list-group-item"><a href="{{url('/favorites/'.Auth::user()->id)}}">Favorites</a></li>
		@endguest
	</ul>
@endsection
