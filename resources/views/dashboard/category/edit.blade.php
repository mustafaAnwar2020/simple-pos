@extends('layouts.app')

@section('content')
@include('partials.errors')
    <form action="{{ route('dashboard.category.update',$category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">@lang('site.edit')</div>

            <div class="card-body">
                @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label class="required" for="title">@lang('site.' .$locale.'.name')</label>
                    <input class="form-control" type="text" name="{{$locale}}[name]" id="title" value="{{$category->translate($locale)->name}}" required>
                    <span class="help-block"> </span>
                </div>
            @endforeach

                <button class="btn btn-primary" type="submit">
                    Save
                </button>
            </div>
        </div>

    </form>
@endsection
