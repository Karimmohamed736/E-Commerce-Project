    <!-- Bootstrap core CSS -->
    <link href="{{asset("user")}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <head>
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/fontawesome.css">
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/templatemo-sixteen.css">

@extends('User.layouts.app')
@section('content')
@foreach ( $errors->all() as $error )
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
@endforeach



    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1>(Shopping Cart)</h1>
                    </div>
                    <div class="card-body">
                        <!-- Cart content will be displayed here -->
                        @if ($cart && count($cart) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $id => $details)
                                        <tr>
                                            <td>{{ $details['name'] }}</td>
                                            <td>{{ $details['price'] }} $</td>
                                            <td>{{ $details['quantity'] }}</td>
                                            <td>{{ $details['total_price'] }} $</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4 text-end">
                                <form action="{{ route('user.makeOrder') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Make Order</button>
                                </form>
                            </div>
                            @else
                            <p>Your cart is empty.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
