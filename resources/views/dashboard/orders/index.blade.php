@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('dashboard.orders.create') }}">
                @lang('site.add')
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">@lang('site.clients')</div>

        <div class="card-body">

            <table class="table table-responsive-sm table-striped">
                <form action="{{ route('dashboard.orders.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>
                        </div>
                    </div>
                </form>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.client_name')</th>
                        <th>@lang('site.price')</th>
                        <th>@lang('site.created_at')</th>
                        <th>@lang('site.show')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $i++ }}</a></td>
                            <td><a href="{{ route('dashboard.orders.show', $item) }}">{{ $item->client->name }}</a></td>
                            <td>{{ $item->total_price }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm order-products"
                                data-url="{{route('dashboard.orders.products',$item)}}"
                                data-method="get"
                        >
                            <i class="fa fa-list"></i>
                            @lang('site.show')
                        </button>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('dashboard.order.edit', $item) }}">
                                    @lang('site.edit')
                                </a>

                                <form action="{{ route('dashboard.orders.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-sm btn-danger" value="@lang('site.delete')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ $tasks->withQueryString()->links() }} --}}
        </div>
        <div class="col-md-4">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 10px">@lang('site.show_products')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                        <div class="loader"></div>
                        <p style="margin-top: 10px">@lang('site.loading')</p>
                    </div>

                    <div id="order-product-list">

                    </div><!-- end of order product list -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </div><!-- end of col -->
    </div>
@endsection
