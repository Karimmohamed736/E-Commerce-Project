    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>{{ __('user_message.Latest Products') }}</h2>
              <a href="products.html">{{ __('user_message.view all products') }} <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
        @forelse ( $products as $product )




          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src=" {{ asset("storage/$product->image") }} " alt=""></a>
              <div class="down-content">
                <a href="{{ route("user.products.show", "$product->id") }}"><h4>{{$product->name}}</h4></a>
                <h6>{{$product->price}}</h6>
                <p>{{$product->desc}}</p>
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span> Quantity({{ $product->quantity }})</span>
              </div>
              {{-- <form action="{{ route('user.addToCart', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-primary">{{ __('user_message.Add To Cart') }}</button>
              </form> --}}

            <form action="{{ route('user.wishlist.create', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-secondary">{{ __('user_message.Add To Wishlist') }}</button>
            </form>

            </div>
          </div>
           @empty
           <div>No Data Founded</div>
        @endforelse ()


        </div>
        {{ $products->links() }}
      </div>
    </div>

    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>About Sixteen Clothing</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4>Looking for the best products?</h4>
              <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">This template</a> is free to use for your business websites. However, you have no permission to redistribute the downloadable ZIP file on any template collection website. <a rel="nofollow" href="https://templatemo.com/contact">Contact us</a> for more info.</p>
              <ul class="featured-list">
                <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                <li><a href="#">Consectetur an adipisicing elit</a></li>
                <li><a href="#">It aquecorporis nulla aspernatur</a></li>
                <li><a href="#">Corporis, omnis doloremque</a></li>
                <li><a href="#">Non cum id reprehenderit</a></li>
              </ul>
              <a href="about.html" class="filled-button">Read More</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="{{asset("user/assets")}}/images/feature-image.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
