<div class="sidebar" data-color="brown" data-active-color="danger">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{Auth::guard('admin')->user()->avatar
                ?'/images/avatars/'.Auth::guard('admin')->user()->avatar
                :asset('backend/img/logo-small.png')}}">
            </div>
        </a>
        <a href="{{route('admin.dashboard')}}" class="simple-text logo-normal">
            Admin Area
            <!-- <div class="logo-image-big">
              <img src="../assets/img/logo-big.png">
            </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{Auth::guard('admin')->user()->avatar
                ?'/images/avatars/'.Auth::guard('admin')->user()->avatar
                :asset('backend/img/faces/ayo-ogunseinde-2.jpg')}}"/>
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
                            <a href="/">
                                <span class="sidebar-mini-icon">C</span>
                                <span class="sidebar-normal">Cập nhật thông tin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.logout')}}">
                                <span class="sidebar-mini-icon">Đ</span>
                                <span class="sidebar-normal">Đăng xuất</span>
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
                    <a data-toggle="collapse" href="#{{ $menu['name'] }}">
                        <i class="nc-icon {{ $menu['icon'] }}"></i>
                        <p>
                            {{ $menu['label'] }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ request()->segment(2) == $menu['name'] ? 'show' : '' }}" id="{{ $menu['name'] }}">
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
                </li>
            @endforeach
        </ul>
    </div>
</div>
