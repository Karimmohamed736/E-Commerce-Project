    <!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Sixteen Clothing HTML Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset("user")}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <head>
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/fontawesome.css">
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/owl.css">
<div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>Sixteen <em>Clothing</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href=" {{ route('home') }} ">{{ __('user_message.Home') }}
                  <span class="sr-only">(current)</span>
                </a>

                </li>

                @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                        @csrf
                <li class="nav-item">
                <button class="nav-link" type="submit"> {{ __('user_message.Logout') }} </button>
              </li>
                </form>
            @endif

            @if (!Auth::check())
            <form method="POST" action="{{ route('login') }}">
                        @csrf
                <li class="nav-item">
                <button class="nav-link" type="submit"> {{ __('user_message.Login') }} </button>
              </li>
              </form>
            @endif
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <button class="nav-link" type="submit"> {{ __('user_message.Register') }} </button>
                </form>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('change/en') }}"> {{ __('user_message.English') }} </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('change/ar') }}">{{ __('user_message.Arabic') }}</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('user.products.all') }}">{{ __('user_message.Our Products') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('user.cart') }}">{{ __('user_message.Cart') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('user.orders.all') }}">{{ __('user_message.Orders') }}</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
