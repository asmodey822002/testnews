@extends('index')
@section('title')
    {{$posts->title}}
@endsection
@section('description')
    Test site News: {{$posts->title}}
@endsection
@section('keywords')
    {{$posts->title}}
@endsection
@section('content')
<div class="col-xl-10 col-md-9">
        <div class="row">
            <div class="col-12 text-center mx-auto">
                <img src="{{isset($posts->imagePath)?asset($posts->imagePath):asset('images/NonIzo.png')}}" alt="Generic placeholder image" style="max-width: 300px;">
            </div>
        </div>
        <div class="row">
            <div class="col-12"><strong>{{$posts->created_at}}</strong></div>
            <div class="col-12 text-center mx-auto">
                <strong>{!!isset($posts->title)?html_entity_decode($posts->title):'Lorem ipsulum dolorem'!!}</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-justify">
                {!!isset($posts->content)?html_entity_decode($posts->content):'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi tempora nobis ut rerum cupiditate eum, necessitatibus repellendus illo reprehenderit doloribus facere architecto quasi ipsum cumque molestiae, cum laudantium amet pariatur! Architecto nobis, iusto officia odit, alias aperiam necessitatibus suscipit facilis rem vero nihil placeat qui, tempora omnis animi quasi minus!'!!}
            </div>
        </div>
        @guest
        @else
            <div class="row">
                <div class="col-12 text-center mx-auto">
                    <form action="/addfavorite" method="get">
                        <input type="hidden" name="user" value="{{Auth::user()->id}}">
                        <input type="hidden" name="news" value="{{$posts->id}}">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Add favorite</button>
                    </form>
                </div>
            </div>
        @endguest
</div>
@endsection