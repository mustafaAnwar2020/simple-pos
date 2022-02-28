@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">


                <div class="card-body">
                    <div class="card-header">@lang('site.name')</div>
                    <p class="mb-0">{{ $role->name }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-accent-primary">

                <div class="card-header">@lang('site.permissions')</div>

                @foreach ($rolePermissions as $item)
                    <div class="card-body">
                        <p class="mb-0">{{ $item->name }}</p>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
