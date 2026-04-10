<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wishlist</title>
<link rel="stylesheet" href="{{ asset("user/assets") }}/css/wishlist.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<div class="cart-wrap">
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="main-heading mb-10">My Wishlist</div>
        <div class="table-wishlist">
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <thead>
                        <tr>
                            <th width="45%">Product Name</th>
                            <th width="15%">Unit Price</th>
                            <th width="15%"> Status</th>
                            <th width="15%">Action</th>
                            <th width="10%"></th>
                            <th><a href="{{ route('home') }}">Home</a></th>
                        </tr>
                    </thead>
            <tbody>
                @foreach ($wishlists as $wishlist)
                <tr>
                    <td width="45%">
                        <div class="display-flex align-center">
                            <div class="img-product">
                                <img src="{{ asset("storage/$wishlist->product->image") }}" alt="" class="mCS_img_loaded">
                            </div>
                            <div class="name-product">
                                <a href="{{ route('user.products.show',$wishlist->product->id) }}">{{ $wishlist->product->name }}</a>
                            </div>
                        </div>
                    </td>
                    <td width="15%" class="price">${{ number_format($wishlist->product->price, 2) }}</td>
                    <td width="15%"><span class="in-stock-box">Pending</span></td>

                    <td width="15%">
                        <form action="{{ route('user.wishlist.destroy', $wishlist->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="round-black-btn small-btn"> Remove </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>
	</div>
</body>
</html>
