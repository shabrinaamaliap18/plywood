<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

</head>

<body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky" style="position:fixed; top: 0;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ route('home') }}" class="logo" style="position:fixed; left: 70px;">
                            <img src="../../assets2/images/logo3.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav" style="position:fixed; right: 80px;">
                            <li class="scroll-to-section"><a href="{{ route('home') }}" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="{{ route('products') }}">
                                    Daftar Produk </a></li>

                            <li class="submenu">
                                <a href="javascript:;">Custom</a>
                                <ul>
                                    <li><a href="{{ route('custom') }}">Custom Produk</a></li>
                                    <li><a href="{{ route('detailcustom') }}">Detail Custom</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:;">Pesanan Saya</a>
                                <ul>
                                    <li><a href="{{ route('historyy') }}">Pesanan Saya</a></li>
                                    <li><a href="{{ route('historyc') }}">Pesanan Custom</a></li>
                                </ul>
                            </li>

                            <li class="scroll-to-section"><a href="{{ route('keranjang') }}">
                                    Keranjang <i class="fas fa-shopping-bag"></i>
                                    @if($jumlah_pesanan !==0)
                                    <span class="badge badge-danger">{{ $jumlah_pesanan }}</span>
                                    @endif
                                </a></li>
                            @guest
                            <li class="scroll-to-section"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @if (Route::has('register'))
                            <li class="scroll-to-section"><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                            @else
                            <li class="scroll-to-section">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
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
    <!-- ***** Header Area End ***** -->