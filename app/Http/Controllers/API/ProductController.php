<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Resources\productRresource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $product = Product::withTranslation()->get();
        return $this->sendResponse(productRresource::collection($product),'All data is here!');
    }

    public function show(Product $product){
        $newProduct = Product::withTranslation()->where('id',$product->id)->get();
        return $this->sendResponse(productRresource::collection($newProduct),'Product is ready!');
    }

    public function store(Request $request){
        $input = $request->all();
        $rules=[
            'category_id'=>'required'
        ];
        $rules+=['name'=>['required',Rule::unique('products_translation','name')]];
        $rules+=['description'=>'required'];
        $validator = Validator::make($input,$rules);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $product = Product::create([
            'category_id' => $request->category_id,
            'sale_price' => $request->sale_price,
            'purchase_price'=>$request->purchase_price,
            'stock'=>$request->stock
        ]);
        DB::table('products_translation')->insert(array(
            'product_id'=>$product->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'locale'=>$request->locale,
        ));
        $this->addEn($product,$request);
        return $this->sendResponse(new productRresource($product),'Product created successfully!');
    }

    public function addEn($product,$request){
        DB::table('products_translation')->insert(array(
            'product_id'=>$product->id,
            'name'=>$request->enname,
            'description'=>$request->endescription,
            'locale'=>$request->en,
        ));
    }

    public function updateEn($product,$request){
        DB::table('products_translation')->where('locale','en')->where('product_id',$product->id)->update(array(
            'name'=>$request->enname,
            'description'=>$request->endescription,
        ));
    }

    public function update(Request $request,Product $product){
        $input = $request->all();
        $rules=[];
        $rules+=['name'=>['required',Rule::unique('products_translation','name')]];
        $rules+=['description'=>'required'];
        $validator = Validator::make($input,$rules);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }

        $product->update([
            'sale_price' => $request->sale_price,
            'purchase_price'=>$request->purchase_price,
            'stock'=>$request->stock
        ]);
        DB::table('products_translation')->where('product_id',$product->id)->update(array(
            'name'=>$request->name,
            'description'=>$request->description,
        ));
        $this->updateEn($product,$request);
        return $this->sendResponse(new productRresource($product),'Product updated successfully!');
    }

    public function destroy(Product $product){
        $product->delete($product->id);
        return $this->sendResponse(new productRresource($product),'Product deleted successfully!');
    }
}

