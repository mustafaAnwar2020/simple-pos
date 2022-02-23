<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index(){
        $category_count = category::count();
        $Order_count = Order::count();
        $Product_count = Product::count();
        $Client_count = Client::count();

        return view('dashboard.index')->with('cat_count',$category_count)->with('order_count',$Order_count)
        ->with('product_count',$Product_count)->with('client_count',$Client_count);
    }
}
