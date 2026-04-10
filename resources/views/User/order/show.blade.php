@extends('User.layouts.app')

@section('content')

<section class="h-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-10 col-xl-8">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">


            <h5 class="text-muted mb-0">Your Order, <span style="color: #a8729a;"></span>{{ Auth::user()->name }}  !</h5>
          </div>
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
              <a href="{{ route('user.orders.all') }}">Return To Orders</a>
            </div>
            @foreach ($order->items as $item)
            <div class="card shadow-0 border mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0"> {{ $item->product->name }} </p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Created_at: {{$item->created_at->format('Y-m-d')}}</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Qty: {{$item->quantity}}</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Price: {{$item->price}}</p>
                  </div>
                </div>
                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
              </div>
            </div>

            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0"> {{ $item->created_at }} </p>
            </div>
                        @endforeach


          </div>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection
