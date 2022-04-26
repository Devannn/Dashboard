<nav class="sidebar close" style="float: left;">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="img/uploads/avatars/{{ Auth::user()->avatar }}" alt="">
            </span>
            <div class="text logo-text">
                <span class="name">{{ Auth::user()->name }}</span>
                <span class="profession">{{ Auth::user()->profession }}</span>
            </div>
        </div>
        <i class='bx bx-chevron-right toggle button-slideout'></i>
    </header>
    <div class="menu-bar">
        <div class="menu">
            <li class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="text" placeholder="Search...">
            </li>
            <ul class="menu-links">
                {{-- Dashboard list item --}}
                <li class="nav-link {{ Request::is('home*') ? 'nav-link-active' : 'nav-link' }}">
                    <a href="{{ url('/home') }}">
                        <i class='icon'><x-heroicon-o-home style="height: 20px;" /></i>
                        <span class="text nav-text">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                {{-- Inbox list item --}}
                <li class="nav-link {{ Request::is('inbox*') ? 'nav-link-active' : 'nav-link' }}">
                    <a href="{{ url('/inbox') }}">
                        <i class='icon'><x-heroicon-o-inbox style="height: 20px;" /></i>
                        <span class="text nav-text">{{ __('Inbox') }}</span>
                    </a>
                </li>
                {{-- Slack list item --}}
                {{-- <li class="nav-link {{ Request::is('slack*') ? 'nav-link-active' : 'nav-link' }}">
                    <a href="{{ url('/slack') }}">
                        <i class='icon'><x-ri-slack-line style="height: 20px;" /></i>
                        <span class="text nav-text">{{ __('Slack') }}</span>
                    </a>
                </li> --}}
                {{-- To-Do list item --}}
                <li class="nav-link {{ Request::is('to-do*') ? 'nav-link-active' : 'nav-link' }}">
                    <a href="{{ url('/to-do') }}">
                        <i class='icon'><x-heroicon-o-clipboard-list style="height: 20px;" /></i>
                        <span class="text nav-text">{{ __('To-Do List') }}</span>
                    </a>
                </li>
                @if(isset($userName))
                {{-- Calendar list item --}}
                    <li class="nav-link {{ Request::is('calendar*') ? 'nav-link-active' : 'nav-link' }}">
                        <a href="{{ url('/calendar') }}">
                            <i class='icon'><x-heroicon-o-calendar style="height: 20px;" /></i>
                            <span class="text nav-text">{{ __('Calendar') }}</span>
                        </a>
                    </li>
                @else
                    {{-- Calendar list item --}}
                    <li class="nav-link {{ Request::is('calendar-login*') ? 'nav-link-active' : 'nav-link' }}">
                        <a href="{{ url('/calendar-login') }}">
                            <i class='icon'><x-heroicon-o-calendar style="height: 20px;" /></i>
                            <span class="text nav-text">{{ __('Calendar') }}</span>
                        </a>
                    </li>
                @endif
                {{-- Users list item --}}
                <li class="nav-link">
                    <a href="{{ url('/users') }}">
                        <i class='icon'><x-heroicon-o-users style="height: 20px;" /></i>
                        <span class="text nav-text">{{ __('Users') }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bottom-content">
            {{-- User list item --}}
            <li class="nav-link">
                <a href="{{ url('/user') }}">
                    <i class='icon'><x-heroicon-o-user style="height: 20px;" /></i>
                    <span class="text nav-text">{{ __('My Account') }}</span>
                </a>
            </li>
            {{-- Logout list item --}}
            <li class="">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='icon'><x-heroicon-o-logout style="height: 20px;" /></i>
                    <span class="text nav-text">Logout</span>
                </a>
            </li>
            {{-- Form to log out --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            {{-- Light/Dark mode slider item --}}
            <li class="mode">
                <div class="sun-moon">
                    <i class='icon'><x-css-dark-mode style="height: 20px;" /></i>
                </div>
                <span class="mode-text text">Dark mode</span>
                <div class="toggle-switch">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <div class="slider round"></div>
                    </label>
                </div>
            </li>          
        </div>
    </div>
</nav>