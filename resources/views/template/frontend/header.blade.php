        <!--  Header & Menu  -->
        <header id="header" class="border navbar-fixed-top">
                <div class="container">
                    <nav class="navbar navbar-default">
                        <!--  Header Logo  -->
                        <div id="logo">
                            <a class="navbar-brand" href="{{ route('frontend.home') }}">
                                <img src="img/logo.png" class="normal" alt="logo">
                                <img src="img/logo@2x.png" class="retina" alt="logo">
                            </a>
                        </div>
                        <!--  END Header Logo  -->
                        <!--  Menu  -->
                        <div id="sidemenu">
                            <div class="menu-holder">
                                <ul>
                                    <li>
                                        <a href="{{ route('frontend.home') }}" class="@yield('home')">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.portofolio') }}" class="@yield('portofolio')">Portfolio</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.career') }}" class="@yield('career')">Career</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.contacts') }}" class="@yield('contacts')">Contacts</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--  END Menu  -->
                        <!--  Button for Responsive Menu  -->
                        <div id="menu-responsive-sidemenu">
                            <div class="menu-button">
                                <span class="bar bar-1"></span>
                                <span class="bar bar-2"></span>
                                <span class="bar bar-3"></span>
                            </div>
                        </div>
                        <!--  END Button for Responsive Menu  -->
                    </nav>
                </div>
            </header>
            <!--  END Header & Menu  -->
