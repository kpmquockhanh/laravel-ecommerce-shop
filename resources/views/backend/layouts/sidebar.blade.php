<div class="sidebar" data-color="brown" data-active-color="danger">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    {{--        <a href="" class="simple-text logo-mini">--}}
    {{--            <div class="logo-image-small">--}}
    {{--                <img src="{{Auth::guard('admin')->user()->avatar--}}
    {{--                ?'/images/avatars/'.Auth::guard('admin')->user()->avatar--}}
    {{--                :asset('backend/img/logo-small.png')}}">--}}
    {{--            </div>--}}
    {{--        </a>--}}
    <div class="flex gap-4 align-items-center justify-content-between mx-2">
      <a href="{{route('admin.dashboard')}}" class="simple-text logo-normal">
          <span>Admin Area</span>
      </a>
        <a class="simple-text logo-normal" href="/" target="_blank">
            <i class="nc-icon nc-tv-2"></i>
        </a>
    </div>

  </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{Auth::guard('admin')->user()->avatar
                ?'/images/avatars/'.Auth::guard('admin')->user()->avatar
                :asset('backend/img/faces/ayo-ogunseinde-2.jpg')}}" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                {{Auth::guard('admin')->user()->name}} (<strong>{{Auth::guard('admin')->user()->name_type}}</strong>)
                <b class="caret"></b>
              </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.accounts.update', Auth::guard('admin')->id())}}">
                                <span class="sidebar-mini-icon">U</span>
                                <span class="sidebar-normal">Update profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.logout')}}">
                                <span class="sidebar-mini-icon">L</span>
                                <span class="sidebar-normal">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="{{ request()->segment(2) == null ? 'active':'' }}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Tổng quan</p>
                </a>
            </li>

            @foreach(config('app.menus') as $menu)
                <li class="{{ request()->segment(2) == $menu['name'] ? 'active':'' }}">
                    <a
                        data-toggle="{{ Arr::exists($menu, 'items') ? 'collapse' : '' }}"
                        href="{{ !Arr::exists($menu, 'items') ? route(Arr::get($menu, 'route')) : '#'.Arr::get($menu, 'name') }}">
                        <i class="nc-icon {{ $menu['icon'] }}"></i>
                        <p>
                            {{ $menu['label'] }}
                            @if(Arr::exists($menu, 'items'))
                                <b class="caret"></b>
                            @endif
                        </p>
                    </a>
                    @if(Arr::exists($menu, 'items'))
                        <div class="collapse {{ request()->segment(2) == $menu['name'] ? 'show' : '' }}"
                             id="{{ $menu['name'] }}">
                            <ul class="nav">
                                @foreach($menu['items'] as $item)
                                    <li class="{{ Request::route()->getName() === $item['route'] ? 'active' : ''}}">
                                        <a href="{{ route($item['route']) }}">
                                            <span class="sidebar-mini-icon">{{ $item['icon'] }}</span>
                                            <span class="sidebar-normal"> {{ $item['label'] }} </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
    </ul>
  </div>
</div>
