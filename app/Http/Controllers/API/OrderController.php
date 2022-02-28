<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Resources\orderRresource;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::join('product_order','product_order.order_id','=','orders.id')->get();
        return $this->sendResponse(orderRresource::collection($orders),'All data is here!');
    }

    public function show(Order $Order){
        $neworder = Order::join('product_order','product_order.order_id','=','orders.id')->where('orders.id',$Order->id)->get();
        return $this->sendResponse(orderRresource::collection($neworder),'All data is here!');
    }

    public function store(Request $request,Client $client){
        $input = $request->all();

        $validator =Validator::make($input,[
            'products'=>'required|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $this->orderAttach($request,$client);
        return $this->sendResponse(['order is created'],'done');

    }


    public function update(Request $request,Client $client, Order $order){
        $input = $request->all();

        $validator =Validator::make($input,[
            'products'=>'required|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $this->orderDetach($order);

        $this->orderAttach($request,$client);
        return $this->sendResponse(['order is updated'],'done');

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

    public function destroy(Order $order)
    {
        foreach($order->products as $product){
            $product->update([
                'stock'=> $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete($order->id);
        return $this->sendResponse(['order is deleted'],'done');
    }
}
