<nav class="col-12 navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="{{ url('/') }}">NEWS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @if (Route::has('login'))
        @auth
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/home') }}">Home</a>
          </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @endif
        @endauth
      @endif
      @guest
      @else
        @if(Auth::user()->subscribe!=1)
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/subscribe/'.Auth::user()->id) }}">Subscribe to news</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/nosubscribe/'.Auth::user()->id) }}">Refuse to subscribe</a>
          </li>
        @endif
      @endguest
    </ul>

    <form class="form-inline my-2 my-lg-0" style="margin-right: 10px;" id="appl" method="get">
      <div class="form-check" style="margin-right: 10px;">
        @if(isset($checkedSort))
          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="checkedSort" value="1" checked>
        @else
          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="checkedSort" value="1">
        @endif
        <label class="form-check-label text-light" for="exampleCheck1">Sort by popularity</label>
      </div>
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">appl</button>
    </form>

    <form action="/search" class="form-inline my-2 my-lg-0">
      <input name="s" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

@section('script')
<script>
$(function() {
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#exampleCheck1').change(function(){
      if(this.checked) {
        var urlAppl = document.location.pathname;
        $("#appl").attr("action", urlAppl);
      }
      else {
        var urlAppl = document.location.pathname;
        $("#appl").attr("action", urlAppl);
      }
       
    });
});
</script>
@endsection