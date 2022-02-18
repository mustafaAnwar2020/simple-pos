@extends('layouts.app')

@section('content')
@include('partials.errors')
    <form action="{{ route('dashboard.client.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">@lang('site.add')</div>

            <div class="card-body">
                <div class="form-group">
                    <label class="required" for="name">@lang('site.name')</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="name">@lang('site.email')</label>
                    <input class="form-control" type="email" name="email" id="email" required>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="name">@lang('site.address')</label>
                    <input class="form-control" type="text" name="address" id="address" required>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="name">@lang('site.phone')</label>
                    <input class="form-control" type="text" name="phone" id="phone" required>
                    <span class="help-block"> </span>
                </div>

                <button class="btn btn-primary" type="submit">
                    @lang('site.add')
                </button>
            </div>
        </div>

    </form>
@endsection
