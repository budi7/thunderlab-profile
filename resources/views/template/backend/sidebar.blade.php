<div class="sidebar">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                T
            <a href="#" class="simple-text logo-normal">
               Thunderlab 
            </a>
        </div>
        <ul class="nav">
            <li class="@yield('menu_dashboard')">
                <a href="{{ route('backend.dashboard') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="@yield('menu_career')">
                <a href="{{ route('backend.career.index') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>Career</p>
                </a>
            </li>
            <li class="@yield('menu_guestbook')">
                <a href="{{ route('backend.guestbook.index') }}">
                    <i class="tim-icons icon-notes"></i>
                    <p>Guest Book</p>
                </a>
            </li>            
            <li class="@yield('menu_portofolio')">
                <a href="{{ route('backend.portofolio.index') }}">
                    <i class="tim-icons icon-bulb-63"></i>
                    <p>Portofolio</p>
                </a>
            </li>
            <li class="@yield('menu_blog')">
                <a href="{{ route('backend.blog.index') }}">
                    <i class="tim-icons icon-single-copy-04"></i>
                    <p>Blog</p>
                </a>
            </li>
            <li class="@yield('menu_config')">
                <a href="{{ route('backend.config.create') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>Configuration</p>
                </a>
            </li>
            <li class="@yield('menu_user')">
                <a href="{{ route('backend.user.index') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>User</p>
                </a>
            </li>            
        </ul>
    </div>
</div>