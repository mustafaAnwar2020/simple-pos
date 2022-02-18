<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Validation\Rule;
use Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = category::all();
        $products = Product::when($request->search,function($q) use ($request){
            return $q->whereTranslationLike('name','%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(5);
        return view('dashboard.products.index')->with('products',$products)->with('categories',$categories);
    }


    public function create()
    {
        $categories = category::all();
        return view('dashboard.products.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'category_id'=>'required'
        ];


        foreach (config('translatable.locales') as $locale){

            $rules+=[$locale.'.name'=>['required',Rule::unique('products_translation','name')]];
            $rules+=[$locale.'.description'=>'required'];
        }
        $rules+=[
            'sale_price'=>'required',
            'purchase_price'=>'required',
            'stock'=>'required'
        ];
        $this->validate($request,$rules);

        $input=$request->all();

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $input['image'] = $request->image->hashName();

        }
        $product = Product::create($input);
        return redirect()->route('dashboard.product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show')->with('product',$product);
    }

    public function edit(Product $product)
    {
        $categories = category::all();
        return view('dashboard.products.edit')->with('categories',$categories)->with('product',$product);
    }


    public function update(Request $request, Product $product)
    {
        $rules=[
            'category_id'=>'required'
        ];


        foreach (config('translatable.locales') as $locale){

            $rules+=[$locale.'.name'=>['required',Rule::unique('products_translation','name')->ignore($product->id,'product_id')]];
            $rules+=[$locale.'.description'=>'required'];
        }
        $rules+=[
            'sale_price'=>'required',
            'purchase_price'=>'required',
            'stock'=>'required'
        ];

        $this->validate($request,$rules);
        $input = $request->all();
        if ($request->image) {
            if($request->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
            }
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $input['image'] = $request->image->hashName();

        }
        $product->update($input);
        return redirect()->route('dashboard.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);

        }
        $product->delete($product->id);
        return redirect()->route('dashboard.product.index');
    }
}
