@extends('layouts.app')

@section('content')
    @include('partials.errors')
    <form action="{{ route('dashboard.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-header">@lang('site.add')</div>

            <div class="card-body">
                @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label class="required" for="title">@lang('site.' .$locale.'.name')</label>
                        <input class="form-control" type="text" name="{{ $locale }}[name]" id="title" required>

                        <label class="required" for="title">@lang('site.' .$locale.'.description')</label>
                        <textarea class="form-control ckeditor" name="{{ $locale }}[description]"
                            id="exampleFormControlTextarea1" rows="3"></textarea>
                        <span class="help-block"> </span>
                    </div>
                @endforeach

                <div class="form-group">
                    <label class="required" for="title">@lang('site.purchase_price')</label>
                    <input class="form-control" type="text" name="purchase_price" id="title" required>
                </div>

                <div class="form-group">
                    <label class="required" for="title">@lang('site.sale_price')</label>
                    <input class="form-control" type="text" name="sale_price" id="title" required>
                </div>

                <div class="form-group">
                    <label class="required" for="title">@lang('site.stock')</label>
                    <input class="form-control" type="text" name="stock" id="title" required>
                </div>
                <div class="form-group">
                    <label>@lang('site.image')</label>
                    <input type="file" name="image" class="form-control image">
                </div>

                <div class="form-group">
                    <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                </div>

                <div class="form-group">
                    <select name="category_id" class="form-control">
                        <option value="">@lang('site.all_categories')</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">
                    @lang('site.add')
                </button>
            </div>
        </div>

    </form>
@endsection
