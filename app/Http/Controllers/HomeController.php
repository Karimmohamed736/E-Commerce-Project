<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function Home(){
        //role 0 => user or guest
        //role 1 => Admin
        //so we check if it`s user or admin side
        $role = Auth::user()->role;
        if ($role== '1') {
            return view('Admin.dashboard');
        }else {
            $products = Product::paginate(3);
            return view('User.dashboard')->with('products',$products);
        }
    }
}
