@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">@lang('site.product')</div>



    <div class="col-md-8">
        <div class="card card-accent-primary">
            <div class="card-header">{{ $product->name }}</div>

            <div class="card-body">
                <p>{{ $product->description }}</p>
            </div>

            <div class="card-footer">
                <p class="mb-0">@lang('site.sale_price') : {{$product->sale_price}}</p>
                <p class="mb-0">@lang('site.stock') : {{$product->stock}}</p>
                <p class="mb-0">@lang('site.category') : {{$product->category->name}}</p>
                <p class="mb-0"><img src="{{ URL::asset('uploads/product_images/' . $product->image) }}" style="width: 100px"
                        class="img-thumbnail image-preview" alt=""></p>
            </div>
        </div>
    </div>


    @endsection
