@extends('users.index')

@section('mainContent')
	<div class="box box-solid box-success">
        <div class="box-header with-border">
            <h1 class="box-title">News add</h1>
        </div>
        <div class="box-body">
            @include('parts.error')
            {!! Form::model($posts, ['route'=>'addnews.store']) !!}
                <div class="form-group {!! !empty($errors->first('categories'))?'has-error':'' !!}" id="org">
                    {!! Form::label('categories', 'Categories')!!}
                    {!! Form::select('categories', $categories, null, ['class'=>'form-control', 'placeholder' => 'Please select'])!!}
                </div>
                <div class="form-group {!! !empty($errors->first('title'))?'has-error':'' !!}">
                    {!! Form::label('title', 'Title')!!}
                    {!! Form::text('title', null, ['class'=>'form-control'])!!}
                </div>
                <div class="form-group {!! !empty($errors->first('content'))?'has-error':'' !!}">
                    {!! Form::label('content', 'Content')!!}
                    {!! Form::textarea('content', null, ['class'=>'form-control'])!!}
                </div>
                <div class="input-group">
                   <span class="input-group-btn">
                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                   <input id="thumbnail" class="form-control" type="text" name="image" value="{{$posts->imagePath}}">
                 </div>
                 <div id="holder">
                   <img src="{{$posts->imagePath}}">
                 </div>
                {!!Form::submit('Save', ['class'=>'btn btn-success btn-lg', 'style'=>'margin-left: 50%'])!!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection
@section('js')

<script>
    $("select").select2();
</script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
  CKEDITOR.replace('content', options);
  $('#lfm').filemanager('image');
</script>

@endsection