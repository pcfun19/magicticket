<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Share'NLock - Securely transfer documents online</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('vendor/simple-line-icons/css/simple-line-icons.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

  <!-- Plugin CSS -->
  <link rel="stylesheet" href="{{asset('device-mockups/device-mockups.min.css')}}">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/new-age.min.css')}}" rel="stylesheet">
  <style>
    #mainNav .navbar-brand {
        color: #FFFFFF;
        font-weight:bold;
    }
    </style>
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="{{route('guest.home')}}">Share'NLock</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      @if (Route::has('login'))
        <ul class="navbar-nav ml-auto">
        @auth
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Home</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a>
          </li>
          @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('register') }}">Register</a>
          </li>
          @endif
        @endauth
        </ul>
      @endif
      </div>
    </div>
  </nav>


  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-lg-7 my-auto">
          <div class="header-content mx-auto">
            <h1 class="mb-5">The place to securely upload and send files</h1>
            <a href="{{ route('login') }}" class="btn btn-outline btn-xl js-scroll-trigger">Start Now for Free!</a>
          </div>
        </div>
        <div class="col-lg-5 my-auto">
          <div class="device-container">
            <div class="device-mockup macbook_2015 portrait white">
              <div class="device">
                <div class="screen">
                  <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                  <img src="{{asset('img/demo-screen-1.png')}}" class="img-fluid" alt="">
                </div>
                <div class="button">
                  <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class="download bg-secondary text-center" id="download">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-warning">
          <h1 class="section-heading">Discover what all the buzz is about!</h1>
          <p class="text-white">Our platform allows you to easily share content with friends and family but also for professional use collaborating with your team at work.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="features" id="features">
    <div class="container">
    
    <div class="row">
        <div class="col-lg-6 my-auto">
          <div class="device-container">
            <div class="device-mockup ipad_pro landscape silver">
              <div class="device">
                <div class="screen">
                  <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                  <img src="{{asset('img/demo-screen-2.png')}}" class="img-fluid" alt="">
                </div>
                <div class="button">
                  <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-lg-6 my-auto">
        <div class="text-center">
            <h2>Limitless experience</h2>
            <p class="text-muted">Our clients come first and we take privacy really seriously. You can feel free to share your content as public and get the brand awareness you deserve or share privately to specific groups of people or individuals. The choice is yours and our system is designed to give you all this freedom.</p>
        </div>
        </div>
    </div>

    <hr>

      <div class="row">
        <div class="col-12 my-auto">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-screen-smartphone text-primary"></i>
                  <h3>Access anywhere</h3>
                  <p class="text-muted">Access your own files for FREE from any device!</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-camera text-primary"></i>
                  <h3>Secure storage</h3>
                  <p class="text-muted">All files are stored in Amazon AWS secure storage facilities</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-present text-primary"></i>
                  <h3>Fast speed</h3>
                  <p class="text-muted">Upload and download with no speed limits or restrictions</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-lock-open text-primary"></i>
                  <h3>Paid membership</h3>
                  <p class="text-muted">Access files others shared with you. Best option for teams' collaboration.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta">
    <div class="cta-content">
      <div class="container">
        <h2>Stop waiting.<br>Create an account now.</h2>
        <a href="{{route('login')}}" class="btn btn-outline btn-xl js-scroll-trigger">Let's Get Started!</a>
      </div>
    </div>
    <div class="overlay"></div>
  </section>
<!-- 
  <section class="contact bg-primary" id="contact">
    <div class="container">
      <h2>We
        <i class="fas fa-heart"></i>
        new friends!</h2>
      <ul class="list-inline list-social">
        <li class="list-inline-item social-twitter">
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li class="list-inline-item social-facebook">
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li class="list-inline-item social-google-plus">
          <a href="#">
            <i class="fab fa-google-plus-g"></i>
          </a>
        </li>
      </ul>
    </div>
  </section> -->

  <footer>
    <div class="container">
      <p>&copy; Share'NLock 2020. All Rights Reserved.</p>
      <ul class="list-inline">
        <li class="list-inline-item">
          <a href="{{route('pages.static','privacy')}}">Privacy</a>
        </li>
        <li class="list-inline-item">
          <a href="{{route('pages.static','terms')}}">Terms</a>
        </li>
        <li class="list-inline-item">
          <a href="{{route('pages.static','contact')}}">About us</a>
        </li>
      </ul>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Plugin JavaScript -->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{asset('js/new-age.min.js')}}"></script>

</body>

</html>
