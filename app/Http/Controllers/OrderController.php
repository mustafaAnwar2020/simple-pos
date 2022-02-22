<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('dashboard.orders.index')->with('orders',$orders);
    }

    public function create(Client $client)
    {
        $categories = category::all();
        return view('dashboard.clients.orders.create')->with('categories',$categories)->with('client',$client);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Client $client)
    {
        $this->validate($request,[
            'products'=>'required|array',
        ]);
        $this->orderAttach($request,$client);
        return redirect()->route('dashboard.orders.index');
    }

    public function edit(Client $client,Order $order)
    {
        $categories = category::with('products')->get();
        $orders =$client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.edit')->with('client',$client)->with('categories',$categories)->with('orders',$orders)->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Client $client,Order $order)
    {
        $this->validate($request,[
            'products'=>'required|array',
        ]);

        $this->orderDetach($order);

        $this->orderAttach($request,$client);

        return redirect()->route('dashboard.orders.index');
    }

    public function products(Order $order){
        $products=$order->products;
        return view('dashboard.orders.products')->with('products',$products)->with('order',$order);
    }


    public function destroy(Order $order)
    {
        foreach($order->products as $product){
            $product->update([
                'stock'=> $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete($order->id);
        return redirect()->route('dashboard.orders.index');
    }


    private function orderAttach($request,$client){
        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);
        $totalPrice=0;
        foreach($request->products as $id=>$quantity)
        {
            $product = Product::find($id);
            $totalPrice += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' =>$product->stock - $quantity['quantity'],
            ]);
        }

        $order->update([
            'total_price'=>$totalPrice,
        ]);
    }


    private function orderDetach($order){
        foreach($order->products as $product){
            $product->update([
                'stock'=> $product->stock + $product->pivot->quantity
            ]);
        }

        $order->delete($order->id);
    }
}
