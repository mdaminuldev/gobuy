<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Category()
    {
        return view('home.category');
    }

    public function SingleProduct()
    {
        return view('home.singleproduct');
    }

    public function AddCart()
    {
        return view('home.addcart');
    }
    public function Checkout()
    {
        return view('home.checkout');
    }
    public function UserProfile()
    {
        return view('home.userprofile');
    }
    public function NewRel()
    {
        return view('home.newrelease');
    }
    public function TodayDeal()
    {
        return view('home.todaydeal');
    }
    public function CustomerService()
    {
        return view('home.customerservice');
    }


}
