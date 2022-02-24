@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('dashboard.user.create')}}">
                @lang('site.add')
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">@lang('site.users')</div>

        <div class="card-body">

            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.phone')</th>
                        <th>role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)


                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->profile->phone}}</td>
                            <td></td>
                            {{-- @foreach ($item->getRoleNames() as $role)<td>{{$role}}</td>@endforeach --}}

                    <td>
                        <a class="btn btn-sm btn-info" href="{{route('dashboard.user.edit',$item)}}">
                            @lang('site.edit')
                        </a>

                        <form action="{{route('dashboard.user.destroy',$item)}}" method="POST"
                            onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $user->withQueryString()->links() }}
        </div>
    </div>

@endsection
