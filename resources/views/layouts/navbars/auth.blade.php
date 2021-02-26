<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.bazeuniversity.edu.ng" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="/" class="simple-text logo-normal">
           {{$user->name}}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @if($user->isAdmin() == true)
            <li class="{{ $elementActive == 'users' || $elementActive == 'admin_bookings' || $elementActive == 'admin_sessions' || $elementActive == 'admin_hostels' || $elementActive == 'admin_rooms' || $elementActive == 'admin_incidents' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#adminLinks">
                    <i class="nc-icon nc-lock-circle-open"></i>
                    <p>
                            Admin
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="adminLinks">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'users' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li>
                        <!-- manage booking -->
                        <li class="{{ $elementActive == 'admin_bookings' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'admin_bookings') }}">
                                <span class="sidebar-mini-icon">{{ __('MB') }}</span>
                                <span class="sidebar-normal">{{ __(' Manage Bookings ') }}</span>
                            </a>
                        </li>
                        <!-- manage hostel -->
                        <li class="{{ $elementActive == 'admin_hostels' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'admin_hostels') }}">
                                <span class="sidebar-mini-icon">{{ __('MH') }}</span>
                                <span class="sidebar-normal">{{ __(' Manage Hostels ') }}</span>
                            </a>
                        </li>
                        <!-- manage rooms -->
                        <li class="{{ $elementActive == 'admin_rooms' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'admin_rooms') }}">
                                <span class="sidebar-mini-icon">{{ __('MR') }}</span>
                                <span class="sidebar-normal">{{ __(' Manage Rooms ') }}</span>
                            </a>
                        </li>
                         <!-- manage sessions -->
                         <li class="{{ $elementActive == 'admin_sessions' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'admin_sessions') }}">
                                <span class="sidebar-mini-icon">{{ __('MS') }}</span>
                                <span class="sidebar-normal">{{ __(' Manage Sessions ') }}</span>
                            </a>
                        </li>
                        <!-- manage incidents -->
                        <li class="{{ $elementActive == 'admin_incidents' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'admin_incidents') }}">
                                <span class="sidebar-mini-icon">{{ __('MI') }}</span>
                                <span class="sidebar-normal">{{ __(' Manage Incidents ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            <li class="{{ $elementActive == 'book_room' ? 'active' : '' }}">
                <a href="{{ route('get.pages', 'book_room') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Book a room</p>
                </a>
            </li>
            @if($user->isAdmin() == false)
            <li class="{{ $elementActive == 'my_bookings' ? 'active' : '' }}">
                <a href="{{ route('get.pages', 'my_bookings') }}">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>My Bookings</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'payments' ? 'active' : '' }}">
                <a href="{{ route('get.pages', 'payments') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>My Payments</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'incidents' ? 'active' : '' }}">
                <a href="{{ route('get.pages', 'incidents') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Report Incident</p>
                </a>
            </li>
            @endif
            <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                <a href="{{ route('profile.edit', 'profile') }}">
                    <i class="nc-icon nc-single-02"></i>
                    <p>Profile</p>
                </a>
            </li>
            <!-- <li class="{{ $elementActive == 'typography' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'typography') }}">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li> -->
            
        </ul>
    </div>
</div>
