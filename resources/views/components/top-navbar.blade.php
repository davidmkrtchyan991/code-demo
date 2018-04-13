@if(Auth::user() && auth()->user()->isClient())
    @include('components.tawkchat')
@elseif(Auth::user() && auth()->user()->isAdministrator())
    @include('components.firechat')
@elseif(Auth::user() && auth()->user()->isTechManager())
    @include('components.firechat')
@elseif(Auth::user() && auth()->user()->isOptimizer())
    @include('components.firechat')
@endif

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                @guest

                @else
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                           data-user-email="{{Auth::user()->email}}" data-user-name="{{ Auth::user()->name }}">
                            <img src="/images/img.jpg" alt="">{{$user['name']}} {{$user['surname']}}
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" id="logout-btn">
                                    <i class="fa fa-sign-out pull-right"></i>
                                    Выход
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->