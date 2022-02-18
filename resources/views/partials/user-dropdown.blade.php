<ul class="c-header-nav ml-auto mr-4">
    <li class="dropdown tasks-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa-solid fa-flag"></i></a>
        <ul class="dropdown-menu">
            <li>
                <ul class="menu">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </li>
    <li class="c-header-nav-item d-md-down-none mx-2">
        <a class="c-header-nav-link" href="">
            {{-- @if (auth()->user()->unreadNotifications->count())
                <span class="badge rounded-pill bg-success">{{ auth()->user()->unreadNotifications->count() }}</span>
            @endif --}}
            <i class="far fa-bell"></i>
        </a>
    </li>
    <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false">
            <div class="c-avatar">
                <i class="far fa-user"></i>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
            <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
            <a class="dropdown-item" href="">
                <i class="c-icon fas fa-fw fa-id-card mr-2"></i>
                Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-icon fas fa-fw fa-sign-out-alt mr-2"></i>
                Logout</a>
        </div>
    </li>



</ul>
