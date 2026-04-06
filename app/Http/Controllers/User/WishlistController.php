<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('User.wishlist.index', compact('wishlists'));
    }

    public function create(Request $request, $productId)
    {
        $exist = Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->first();
        if ($exist) {
            return redirect()->back()->with('error', 'Product is already in your wishlist.');
        }
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);
        return redirect()->back()->with('message', 'Product added to wishlist successfully.');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        if ($wishlist->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        $wishlist->delete();
        return redirect()->back()->with('message', 'Product removed from wishlist successfully.');
    }
}
