<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <style>
  .top-right {
    position: absolute;
    right: 10px;
    top: 18px;
  }
  body,.links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
  }
  .content{
    margin-top:50px;
  }
  .video{
    position: relative;
    margin:15px 0;
  }
  iframe {
    opacity: 1;
    display: block;
    width: 100%;
    height: 315px;
  }

  .overlay {
    transition: .5s ease;
    opacity: 0;
    position:absolute;
    height:100%;
    width:100%;
    text-align: center;
    top:0;
    left:0;
    /*margin:0 auto;*/
  }
  .overlay .btn{
    margin-top:30%;
    padding:10px 60px;
  }

  .video:hover iframe {
    opacity: 0.3;
  }

  .video:hover .overlay{
    opacity: 1;
  }
  .videoActive:hover iframe {
    opacity:1;
  } 
  .videoActive .overlay{
    opacity:1;
    height:10%;
    text-align: left !important;
  }
  .videoActive .overlay .btn{
    margin:0;
  }
  .videoActive .overlay .playBtn{
    display:none;
  }
</style>
</head>
<body>
  @if (Route::has('login'))
  <div class="top-right links">
    @guest
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
    @else
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
      {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
      {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>
  @endguest
</div>
@endif

<div class="container-fluid content">
  <div class="row">
    @foreach($videos as $item)
    <div class="col-md-6 video">
      <div class="row">
        <div class="col-md-8">
          <iframe src="http://www.youtube.com/embed/{{$item->id}}" data-src="http://www.youtube.com/embed/{{$item->id}}?autoplay=1&modestbranding=1&rel=0&hl=ru&showinfo=0" frameborder="0" showinfo="0" controls="0" autohide=1></iframe>

          <div class="overlay">
            @auth 
                <button class="btn btn-primary playBtn">Play</button>
            @else 
                  @if($item->statistics->viewCount <= 100000)
                      <a href="{{route('login')}}" class="btn btn-primary">Login & Play</a>
                  @else
                      <button class="btn btn-primary playBtn">Play</button>
                  @endif
            @endauth

          </div>
        </div>
        <div class="col-md-4">
          <div class="list-group">
            <a class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$item->statistics->viewCount}}</h5>
              </div>
              <p class="mb-1">Views </p>
            </a>
            <a class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$item->statistics->likeCount}}</h5>
              </div>
              <p class="mb-1">Likes </p>
            </a>
            <a class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$item->statistics->dislikeCount}}</h5>
              </div>
              <p class="mb-1">Dislikes </p>
            </a>
            <a class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$item->statistics->commentCount}}</h5>
              </div>
              <p class="mb-1">Comments </p>
            </a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <script>
    $(document).on('click','.playBtn',function(e) {

      e.preventDefault();
      var poster = $(this);

      var wrapper = poster.closest('.video');
      videoPlay(wrapper);
    });


    function videoPlay(wrapper) {
      var iframe = wrapper.find('iframe');

      var src = iframe.data('src');

      wrapper.addClass('videoActive');

      iframe.attr('src',src);
    }
  </script>
</body>
</html>