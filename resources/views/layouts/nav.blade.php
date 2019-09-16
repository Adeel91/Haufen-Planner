<nav class="navbar has-shadow is-info">
    <div class="navbar-brand">
        @if ( ! Auth::guest())
            <a class="navbar-item" @click.prevent="toggleSidebar">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
        @endif
        <a href="{{ url('/') }}" class="navbar-item">{{ config('app.name', 'Haufen Planner') }}</a>
        <div class="navbar-burger burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="navbar-menu" id="navMenu">
        <div class="navbar-start"></div>

        <div class="navbar-end">
            @if (!Auth::guest())
                <a class="navbar-item ">Auto Logout: &nbsp; <span id="countDownTimer"></span></a>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="#">
                        <p class="image-initial">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</p>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>
