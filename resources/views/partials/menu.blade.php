<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('dashboard.')}}">
            <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>
            @lang('site.dashboard')
        </a>
    </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('dashboard.category.index')}}">
                <i class="c-sidebar-nav-icon fas fa-fw fa-user-alt"></i>
                @lang('site.categories')
            </a>
        </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('dashboard.client.index')}}">
            <i class="c-sidebar-nav-icon fas fa-fw fa-address-card"></i>
            @lang('site.clients')
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('dashboard.product.index')}}">
            <i class="c-sidebar-nav-icon fas fa-fw fa-copy"></i>
            @lang('site.products')
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('dashboard.orders.index')}}">
            <i class="c-sidebar-nav-icon fas fa-fw fa-tasks"></i>
            @lang('site.orders')
        </a>
    </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="">
                <i class="c-sidebar-nav-icon fas fa-fw fa-user-cog"></i>
                Roles
            </a>
        </li>
    <li class="c-sidebar-nav-divider"></li>
    <li class="c-sidebar-nav-item mt-auto"></li>
    <li class="c-sidebar-nav-item"><a href="#" class="c-sidebar-nav-link"
            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt"></i>
            Logout</a>
    </li>
</ul>
