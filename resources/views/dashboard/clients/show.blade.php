@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">@lang('site.client')</div>

                <div class="card-body">
                    <p class="mb-0">{{$client->name}}</p>
                    <p class="mb-0">{{$client->address}}</p>
                    <p class="mb-0">{{$client->phone}}</p>
                    <p class="mb-0">{{$client->email}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('site.orders')</div>
                <div class="card-body">

                    <p class="mb-0"></p>
                    <p class="mb-0"></p>

                </div>
            </div>
        </div>

    </div>
@endsection
