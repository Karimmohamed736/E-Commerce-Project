<?php

namespace App\Services\User;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistService
{
    public function getUserWishlists()
    {
        return Wishlist::where('user_id', Auth::id())
            ->with('product')
            ->get();
    }

    public function addToWishlist(int $productId): void
    {
        $exist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        if ($exist) {
            throw new \Exception('Product is already in your wishlist.');
        }

        Wishlist::create([
            'user_id'    => Auth::id(),
            'product_id' => $productId,
        ]);
    }

    public function removeFromWishlist(Wishlist $wishlist): void
    {
        if ($wishlist->user_id !== Auth::id()) {
            throw new \Exception('Unauthorized action.');
        }

        $wishlist->delete();
    }
}
