<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Services\User\WishlistService;

class WishlistController extends Controller
{
    protected $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        $wishlists = $this->wishlistService->getUserWishlists();
        return view('User.wishlist.wishlist', compact('wishlists'));
    }

    public function create(int $productId)
    {
        try {
            $this->wishlistService->addToWishlist($productId);

            return redirect()->back()->with('message', 'Product added to wishlist successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Wishlist $wishlist)
    {
        
        try {
            $this->wishlistService->removeFromWishlist($wishlist);

            return redirect()->back()->with('message', 'Product removed from wishlist successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
