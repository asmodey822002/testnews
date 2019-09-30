@extends('index')
@section('content')
	<div class="row justify-content-center align-items-center">
		<div class="col-12 my-auto">
			<h3 class="text-center">News</h3>
		</div>
	</div>
    @foreach($posts as $post)
        <div class="row">
            <div class="media" style="padding: 10px; margin: 10px;">
                <a href="{{url('/news/'.$post->id)}}">
    	            <img src="{{asset(isset($post->imagePath)?$post->imagePath:'images/NonIzo.png')}}" alt="Generic placeholder image" class="mr-3 mt-3" style="max-width: 200px;">
                </a>
                <div class="media-body">
                    <h5 class="mt-0"><a href="{{url('/news/'.$post->id)}}" style="text-decoration: none; color: #000;">{!!$post->title!!}</a></h5>
                    <p style="text-align: left; color: black;">{{$post->created_at}}</p>
                    <span style="text-align: justify;">{!!str_limit(htmlspecialchars_decode($post->content), 200)!!}</span>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row justify-content-center align-items-center">
        @if(isset($checkedSort)!=null)
            <p class="my-auto">{{$posts->appends(['checkedSort'=>$checkedSort])->links()}}</p>
        @else
			<p class="my-auto">{{$posts->links()}}</p>
        @endif
	</div>
    
</div>
@endsection