    <!-- Bootstrap core CSS -->
    <link href="{{asset("user")}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <head>
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/fontawesome.css">
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/templatemo-sixteen.css">

    @extends('User.layouts.app')
@section('content')

    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2> {{ $product->name }} </h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <p>{{ $product->desc }} </p>
              <p>Price: {{ $product->price }}$ </p>
              <p>Quantity ({{ $product->quantity}}) </p>
            </div>

            <form action="{{ route('user.addToCart',$product->id) }}" method="POST">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}">
                <button class="btn btn-primary">Add To Cart</button>
            </form>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="{{ asset("storage/$product->image") }}" alt="#">
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
