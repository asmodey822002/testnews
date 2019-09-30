@if(session('success'))
<div class="col-12 alert alert-success">
	{{session('success')}}
</div>
@elseif(session('error'))
<div class="col-12 alert alert-warning">
	{{session('error')}}
</div>
@endif
