<header class="header-area header-sticky" style="position:fixed; top: 0;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <div class="d-flex">
                        <a href="{{ route('home') }}" class="logo" style="position:fixed; left: 70px;">
                            <img src="../../assets2/images/logo3.png">
                        </a>
                    </div>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav" style="position:fixed; right: 80px;">
                        <li class="scroll-to-section"><a href="{{ route('home') }}" class="active">Home</a></li>
                        @auth
                        <li class="submenu" wire:poll.keep-alive>
                            <a href="javascript:;" class="d-flex align-items-center">
                                Notifikasi
                                @if (auth()->user()->notifications()->count() > 0)
                                    <span style="color: gray;" class="ml-1">({{auth()->user()->unreadNotifications()->count()}})</span>
                                @endif
                            </a>
                            <ul style="width: 400px!important;">
                                @forelse (auth()->user()->unreadNotifications as $notification)
                                <li style="background-color: white;">

                                    <button  wire:click.prevent="handleNotification({{$notification->id}})" style="text-align:left;"
                                    class="btn btn-sm p-2">
                                        {{-- <span style="color: green;" class="mr-1">&bull;</span> --}}
                                        <div class="mb-2">{!! $notification->text !!}</div>
                                        <div style="color: rgb(170, 170, 170);font-size:12px;border-bottom:1px solid rgb(225, 225, 225);" class="pb-2">{{\Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</div>
                                    </button>
                                </li>
                                @empty
                                <li style="background-color:white;" class="p-3">Tidak ada notifikasi.</li>
                                @endforelse
                            </ul>
                        </li>
                        @endauth
                        <li class="scroll-to-section"><a href="{{ route('products') }}">
                                Daftar Produk </a></li>

                        <li class="submenu" wire:poll.keep-alive>
                            <a href="javascript:;" class="d-flex align-items-center">
                                Custom
                                {{-- @auth
                                    @if (auth()->user()->checkoutableCount() > 0)
                                        <span style="font-size: 28px;color: red;">&bull;</span>
                                    @endif
                                @endauth --}}
                            </a>
                            <ul>
                                <li><a href="{{ route('custom') }}">Custom Produk</a></li>
                                <li wire:poll.keep-alive>
                                    <a href="{{ route('detailcustom') }}">
                                        Detail Custom
                                        @auth
                                            @if (auth()->user()->checkoutableCount() > 0)
                                                ({{auth()->user()->checkoutableCount()}})
                                            @endif
                                        @endauth
                                    </a>
                                </li>
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
