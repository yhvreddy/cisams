<header>
    <nav class="navbar">

        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}"></a>
        <span class="nv-text">Cybercrime Investigation Support, Analysis and Monitoring System</span>

        <ul class="navbar-menu " id="navbar-menu">
            <li class="navbar-item">
                <a class="navbar-link" href="#"><img src="{{ asset('assets/images/bell.svg') }}" class="icon"></a>
            </li>

            <li class="navbar-item">
                <a class="navbar-link" href="#"><img src="{{ asset('assets/images/sett.svg') }}"
                        class="icon"></a>
            </li>

            <li class="navbar-item">
                <a class="navbar-link" href="#"><img src="{{ asset('assets/images/pro-img.png') }}"
                        class="profile"></a>
            </li>

            <li class="navbar-item ">
                <a class="navbar-toggle dropdown-toggle" href="#">

                    <span class="text-container">
                        {{auth()->user()->name}}<br><span class="addi">{{auth()->user()->email}}</span>
                    </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </li>

        </ul>
    </nav>

</header>
<!--header area end-->


<div class="hamburger" id="hamburger-menu">
    <img src="{{ asset('assets/images/menu_icon.jpg') }}" alt="Menu">
</div>
