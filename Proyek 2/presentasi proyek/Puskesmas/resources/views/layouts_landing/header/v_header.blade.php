<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="{{ url('autentikasi/img/kesmas.png') }}" weight="80" height="80" alt="Chain App Dev">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                        <li class="scroll-to-section"><a href="#services">Tentang Kami</a></li>
                        <li class="scroll-to-section"><a href="#about">Pelayanan</a></li>
                        <li class="scroll-to-section"><a href="#newsletter">Kontak Kami</a></li>
                        <li>
                            <div class="gradient-button">
                                @if (empty(Auth::user()->nama))
                                <a href="{{ url('/login') }}">
                                    <i class="fa fa-sign-in-alt"></i>
                                    Masuk
                                </a>
                                @else
                                <a href="{{ url('/login') }}">
                                    <i class="fa fa-sign-in-alt"></i>
                                    Dashboard
                                </a>
                                @endif
                            </div>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
