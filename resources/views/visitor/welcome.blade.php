<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gowes - Cycle Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        
        <style>.review-card {
            max-width: 720px;
            margin: 0 auto;
        }

        .review-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
        }

        .star {
            width: 20px;
            height: 20px;
            color: #ffc107;
            /* Bootstrap warning color */
        }

        .star-muted {
            color: #e5e7eb;
            /* gray-200 */
        }
    </style>
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">GOWES NGACIR</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="/rutelist">Rute Sepeda</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Kontak Kami</a></li>
      </ul>
    </div>
  </div>
</nav>

    <header class="py-5 text-white"
        style="position: relative; background: url('https://images6.alphacoders.com/549/549198.jpg') no-repeat center center/cover;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
                background: rgba(0,0,0,0.5);"></div>
        <div class="container text-center" style="position: relative; z-index: 1;">
            <br>
            <br>
            <h1 class="display-6 fw-bold">Temukan Rute Sepeda</h1>
            <h2 class="display-4 fw-bold">Favoritmu di Seluruh Indonesia</h2>
            <p class="lead"><b>Jelajahi ribuan rute sepeda terbaik di Indonesia. Dari jalur santai di kota hingga
                    petualangan menantang di pegunungan.</b></p>
            <a href="#" class="btn btn-success "> <b> Jelajahi Rutemu </b></a>
            <a href="#" class="btn btn-success "> <b> Merch Kami </b></a>
        </div>
    </header>
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <center>
                    <h3 class="fw-bold"> Mengapa Pilih Gowes Ngacir? </h3>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="reviewCarousel" class="carousel slide py-5" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#reviewCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Review 1"></button>
                        <button type="button" data-bs-target="#reviewCarousel" data-bs-slide-to="1"
                            aria-label="Review 2"></button>
                        <button type="button" data-bs-target="#reviewCarousel" data-bs-slide-to="2"
                            aria-label="Review 3"></button>
                    </div>

                    <div class="carousel-inner text-center">
                        <!-- Item 1 -->
                        <div class="carousel-item active">
                            <div class="card shadow-sm mx-auto" style="max-width: 720px;">
                                <div class="card-body p-4">
                                    <img src="https://i.pravatar.cc/100?img=5" class="rounded-circle mb-3"
                                        alt="Foto Aulia">
                                    <h5 class="fw-bold">Aulia Rahman</h5>
                                    <div class="text-warning mb-3">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <p class="text-secondary">
                                        “Koleksi rutenya lengkap dan akurat. Fitur filter elevasi & permukaan jalan
                                        bikin perencanaan gowes jadi super gampang!”
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="carousel-item">
                            <div class="card shadow-sm mx-auto" style="max-width: 720px;">
                                <div class="card-body p-4">
                                    <img src="https://i.pravatar.cc/100?img=11" class="rounded-circle mb-3"
                                        alt="Foto Bagus">
                                    <h5 class="fw-bold">Bagus Santoso</h5>
                                    <div class="text-warning mb-3">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <p class="text-secondary">
                                        “UI-nya rapi dan ringan. Saran: tambahkan rekomendasi rute berdasarkan
                                        cuaca—pasti makin mantap.”
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="carousel-item">
                            <div class="card shadow-sm mx-auto" style="max-width: 720px;">
                                <div class="card-body p-4">
                                    <img src="https://i.pravatar.cc/100?img=22" class="rounded-circle mb-3"
                                        alt="Foto Citra">
                                    <h5 class="fw-bold">Citra M.</h5>
                                    <div class="text-warning mb-3">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <p class="text-secondary">
                                        “Rute komunitasnya seru! Banyak jalur hidden gem. Review & foto dari pengguna
                                        lain membantu banget.”
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel"
                        data-bs-slide="prev">
                        <span aria-hidden="true">
                            <i class="bi bi-chevron-left fs-1 text-dark"></i>
                        </span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel"
                        data-bs-slide="next">
                        <span aria-hidden="true">
                            <i class="bi bi-chevron-right fs-1 text-dark"></i>
                        </span>
                        <span class="visually-hidden">Berikutnya</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Promo Section: Hotel + Resto + Landmark -->
<section class="py-5" style="background:#f5f7fb;">
  <div class="container">
    <div class="row g-4 align-items-center rounded-4 shadow-sm p-4 p-lg-5"
         style="background: linear-gradient(135deg, #1a8754 0%, #f3f6ff 55%, rgba(225, 255, 216, 1) 100%);">

      <!-- Gambar (kiri) -->
      <div class="col-lg-6">
        <div class="position-relative rounded-4 overflow-hidden shadow"
             style="max-height: 500px;">
          <img
            src="https://bakpiakukustugu.co.id/uploads/7/2021-09/31636_tugu_yogyakarta.jpeg"
            class="w-100 h-100"
            style="object-fit: cover;"
            alt="Gambar hotel">
          <!-- Overlay lembut supaya teks/ikon nanti tetap kebaca kalau ditambah -->
          <div class="position-absolute top-0 start-0 w-100 h-100"
               style="background: radial-gradient(ellipse at 30% 20%, rgba(0,0,0,.08), transparent 40%);"></div>

          <!-- Badge sudut -->
          <span class="position-absolute top-0 start-0 m-3 badge bg-success-subtle text-success-emphasis rounded-pill">
            <i class="bi bi-patch-check-fill me-1"></i> Best Deal
          </span>
        </div>
      </div>

      <!-- Teks (kanan) -->
      <div class="col-lg-6 d-flex flex-column align-items-center align-items-lg-start text-center text-lg-start">
        <h3 class="fw-bold mb-2">
          DAPATKAN PAKET HARGA TERBAIK
        </h3>
        <p class="lead mb-3">
          Lengkap dengan <span class="fw-semibold">Hotel</span>, <span class="fw-semibold">Resto</span>, dan
          <span class="fw-semibold">Landmark</span> yang siap Anda kunjungi!
        </p>

        <!-- Fitur singkat dengan ikon -->
        <ul class="list-unstyled d-grid gap-2 mb-4" style="grid-template-columns: repeat(2, minmax(0,1fr));">
          <li class="d-flex align-items-center gap-2">
            <i class="bi bi-building-check text-primary"></i> Hotel pilihan terkurasi
          </li>
          <li class="d-flex align-items-center gap-2">
            <i class="bi bi-egg-fried text-danger"></i> Rekomendasi resto favorit
          </li>
          <li class="d-flex align-items-center gap-2">
            <i class="bi bi-geo-alt-fill text-success"></i> Landmark populer & hidden gem
          </li>
          <li class="d-flex align-items-center gap-2">
            <i class="bi bi-star-fill text-warning"></i> Ulasan asli dari traveler
          </li>
        </ul>

        <!-- CTA -->
        <div class="d-flex flex-wrap gap-2">
          <a href="/rutelist" class="btn btn-primary btn-lg">
            <i class="bi bi-search me-1"></i> Jelajahi Paket
          </a>
        </div>

        <!-- Garis tipis pemisah -->
        <hr class="w-100 my-4 opacity-25">
      </div>
    </div>
  </div>
</section>


    </div>
    <footer class="bg-success text-white text-center py-3">
        &copy; {{ date('Y') }} Gowes. All rights reserved.
    </footer>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>