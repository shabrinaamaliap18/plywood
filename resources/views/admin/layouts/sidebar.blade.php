  <!-- Left column -->
  <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
          <header class="templatemo-site-header">

              <b>
                  <h1 style=" padding-left: 50px">Admin</h1>
              </b>
          </header>

          <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
          </div>
          <nav class="templatemo-left-nav">
              <ul>
                  <li><a href="/dashboard"><i class="fa fa-home" aria-hidden="true"></i>Dashboard</a></li>
                  <li><a href="/pesanan"><i class="fa fa-list-alt" aria-hidden="true"></i>Manajemen Pesanan</a></li>
                  <li><a href="/customm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Manajemen Custom</a></li>
                  <li><a href="#"><i class="fa fa-cube" aria-hidden="true"></i>Produk</a></li>

                  <ul><a href="/produk" style=" padding-left: 50px">Manajemen Produk</a></ul>
                  <ul><a href="/categories" style=" padding-left: 50px">Manajemen Kategori</a></ul>
                  <ul><a href="/material" style=" padding-left: 50px">Manajemen Material</a></ul>

                  <li><a href="/customer"><i class="fa fa-users fa-fw"></i>Manajemen User</a></li>
                  <li><a href="/ongkir"><i class="fa fa-money fa-fw"></i>Manajemen Ongkir</a></li>
                  <li><a href="/rekap"><i class="fa fa-folder-open" aria-hidden="true"></i>Rekap Laporan</a></li>
                  <li>
                      <a href="{{route('logout')}}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">

                          <i class="fas fa-sign-out-alt" style="float: right;"></i><b> Logout</b>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </a>
                  </li>

              </ul>
          </nav>


      </div>

      <style>
          .templatemo-sidebar {
              background-color:cadetblue;
              font-size: 13px;
              font-weight: 700px;
              font-family: "Open Sans",
                  "Segoe UI",
                  arial;
              color: darkslategrey;
              width: 300px;
          }

          .main-content {
              padding-left: 50px;
          }

          .templatemo-left-nav a {
              padding: 20px;
              background-color:darkslategray;
              

          }
      </style>