<body>


   <!-- ***** Main Banner Area Start ***** -->
   <section class="welcome_area bg-img background-overlay" style="background-image:url(assets/slider/bg2.jpg)">
      <div class="container h-100">
         <div class="row h-100 align-items-center">
            <div class="col-12">
               <div class="hero-content">
                  <h2>CV. Mirai Alam Sejahtera</h2>
                  <h6>Dapatkan Pengalaman Pemesanan Online Plywood Lebih Mudah dan Aman!</h6>
                  <span>Hanya Klik, Bayar &amp; Langsung Kami Proses</span>
                  <br>
                  <br>
                  <div class="main-border-button">
                     <a href="/products">Beli Sekarang</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <br><br>

   <div class="container">
      <section>
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <div class="main_heading text_align_center">
                        <h1><span>Kenapa Memilih Kami</span></h1>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="full">
                           <div class="Services_blog_inner">
                              <div class="icon"><img src="image/best-quality.png" alt=""></div><br>
                              <h4 class="Services-heading">Best Quality</h4>
                              <p>Menghadirkan produk yang berkualitas</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="full">
                           <div class="Services_blog_inner">
                              <div class="icon"><img src="image/secure-payment.png" alt=""></div><br>
                              <h4 class="Services-heading">Secure Payment</h4>
                              <p>Pembayaran akan diverifikasi secara otomatis oleh sistem</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="full">
                           <div class="Services_blog_inner">
                              <div class="icon"><img src="image/shipped.png" alt=""></div><br>
                              <h4 class="Services-heading">Best Shipped</h4>
                              <p>Melakukan pengiriman produk dengan aman sampai tujuan</p>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
      </section>
      <br><br>


      <section>
         {{-- PILIH KATEGORI  --}}

         <div class="full">
            <div class="main_heading text_align_center">
               <h1><span>Kategori</span></h1><br>
               <div class="section-heading">
                  <span>Terdapat 3 kategori produk kami yaitu Plywood, Veneer dan LVL</span>
               </div>
            </div>
         </div>
         <br>
         <div class="row" style="display:flex !important;">
            @foreach($categories as $c)
            <!-- DEMO 1 Item-->
            <div class="col-lg-4" style="display:grid !important;">
               <a href="{{ route('products.categories', $c->id) }}">
                  <div class="hover hover-1 text-white rounded"><img src="{{ url('../assets/liga') }}/{{ $c->foto_kategori }}" alt="">
                     <div class="hover-overlay"></div>
                     <div class="hover-1-content px-5 py-4">
                        <h3 class="hover-1-title text-uppercase font-weight-bold mb-0"> <span class="font-weight-light">Kategori </span>{{ $c->nama_kategori }}</h3>
                        <p class="hover-1-description font-weight-light mb-0"><b>{{ $c->keterangan_kategori }}</b></p>
                     </div>
                  </div>
            </div>


            <br>
            @endforeach
      </section>
   </div>
</body>

<style>
   .welcome_area .hero-content h2 {
      font-size: 65px;
      color: whitesmoke;
      margin-bottom: 3px;
      font-family: "Ubuntu", sans-serif;
   }

   h2,
   h5,
   h6 {
      color: whitesmoke;
      line-height: 1.3;
      font-weight: 700;
      font-family: "Ubuntu", sans-serif;
   }

   .welcome_area .hero-content h6 {
      color: papayawhip;
      line-height: 1.3;
      font-weight: 400;
      font-family: "Ubuntu", sans-serif;
   }

   span {
      color: papayawhip;
      line-height: 1.3;
      font-weight: 400;
      font-family: "Ubuntu", sans-serif;
   }

   .welcome_area {
      position: relative;
      z-index: 1;
      width: 100%;
      height: 600px;
   }

   .bg-img {
      background-position: center center;
      background-size: cover;
      background-repeat: no-repeat;
   }

   /* why choose us */

   .full {
      width: 100%;
      text-align: center;
      margin: 0;
      padding: 0;

   }

   .Services_blog_inner .icon img {
      width: 70px;

   }

   .icon img {
      color: wheat;
   }

   .services_heading {
      color: wheat;
   }

   .Services_blog_inner {
      margin-top: 45px;
      /* background-color:  #664228; */
      background-color: wheat;
      padding: 45px 50px;
      border-radius: 5px;
   }

   .text_align_center {
      text-align: center;
   }

   .main_heading {
      position: relative;
      margin-bottom: 40px;
   }

   .main_heading h3 {
      font-weight: 500;
      font-size: 30px;
      margin-bottom: 0;
   }

   .main_heading h2 span {
      position: relative;
   }

   .main_heading h1 span {
      color: black;
   }

   .main_heading h1 span::after {
      content: "";
      display: block;
      width: 90px;
      height: 7px;
      background: #d7bb3e;
      position: relative;
      right: 0;
      bottom: 0;
      margin: 10px auto 0;
   }

   .main_heading.text_align_left::after {
      margin-left: 0;
   }

   .main_heading.text_align_right::after {
      margin-right: 0;
   }



   /* hover */
   .owl-item .cloned {
      display: none !important;
   }

   .owl-item .active {
      display: none !important;
   }

   .inner-content {
      color: white;
   }

   /* DEMO GENERAL ============================== */
   .hover {
      overflow: hidden;
      position: relative;
      padding-bottom: 60%;
   }

   .hover-overlay {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 90;
      transition: all 0.4s;
   }

   .hover img {
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      transition: all 0.3s;
   }

   .hover-content {
      position: relative;
      z-index: 99;
   }


   /* DEMO 1 ============================== */
   .hover-1 img {
      width: 105%;
      position: absolute;
      top: 0;
      float: right;
      left: -5%;
      transition: all 0.3s;
   }

   .hover-1-title {
      position: relative;
      top: 50%;
      left: -15%;
      text-align: center;
      width: 120%;
      z-index: 99;
      color: whitesmoke;
      transition: all 0.3s;
   }

   .hover-1-content {
      position: absolute;
      bottom: 0;
      left: 0;
      z-index: 99;
      transition: all 0.4s;
   }

   .hover-1 .hover-overlay {
      background: rgba(0, 0, 0, 0.5);
   }

   .hover-1-description {
      transform: translateY(0.5rem);
      transition: all 0.4s;
      opacity: 0;
      top: 70%;
      left: 50%;
      color: #964b00;
      background-color: wheat;
      padding: 10px
   }

   .hover-1:hover .hover-1-content {
      bottom: 2rem;
   }

   .hover-1:hover .hover-1-description {
      opacity: 1;
      transform: none;
   }

   .hover-1:hover img {
      left: 0;
   }

   .hover-1:hover .hover-overlay {
      opacity: 0;
   }
</style>