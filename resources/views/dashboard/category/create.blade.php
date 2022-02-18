@extends('layouts.app')

@section('content')
@include('partials.errors')
    <form action="{{ route('dashboard.category.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">Create category</div>

            <div class="card-body">
                @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label class="required" for="title">@lang('site.' .$locale.'.name')</label>
                        <input class="form-control" type="text" name="{{$locale}}[name]" id="title" required>
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
