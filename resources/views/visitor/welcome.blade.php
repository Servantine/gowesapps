<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gowes - Cycle Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .bundle-card {
            border: none;
            border-radius: 1rem;
            /* Sudut lebih bulat */
            overflow: hidden;
            /* Penting agar gambar tidak keluar dari border-radius */
            position: relative;
            height: 250px;
            /* Atur tinggi card sesuai kebutuhan */
            background-size: cover;
            background-position: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            color: white;
        }

        .bundle-card:hover {
            transform: translateY(-5px);
            /* Efek mengangkat saat hover */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Gradient overlay dari bawah ke atas */
        .bundle-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0) 60%);
        }

        .bundle-card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 1.25rem;
            width: 100%;
            z-index: 10;
            /* Pastikan konten di atas gradient overlay */
        }

        /* Kustomisasi Kontrol Carousel */
        #bundleCarousel .carousel-control-prev,
        #bundleCarousel .carousel-control-next {
            width: 3rem;
            height: 3rem;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        #bundleCarousel .carousel-control-prev-icon,
        #bundleCarousel .carousel-control-next-icon {
            filter: invert(1);
            /* Membuat ikon menjadi hitam */
        }

        /* Kustomisasi Indikator Carousel */
        #bundleCarousel .carousel-indicators [data-bs-target] {
            background-color: #343a40;
        }

        .review-card {
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

        .bundle-card-img {
            height: 200px;
            object-fit: cover;
        }

        .ad-placeholder {
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px dashed #ced4da;
        }

        #reviewCarousel .carousel-indicators [data-bs-target] {
            background-color: #6c757d;
            /* Warna abu-abu untuk indikator */
        }

        #reviewCarousel .carousel-indicators .active {
            background-color: #000;
            /* Warna hitam untuk indikator aktif */
        }
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
                    <li class="nav-item"><a class="nav-link" href="/kontak">Kontak Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="/saran-rute">Berikan Saran Rute</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Komunitas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="py-5 text-white"
        style="position: relative; background: url('https://images6.alphacoders.com/549/549198.jpg') no-repeat center center/cover;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);"></div>
        <div class="container text-center" style="position: relative; z-index: 1;">
            <br>
            <br>
            <h1 class="display-6 fw-bold">Temukan Rute Sepeda</h1>
            <h2 class="display-4 fw-bold">Favoritmu di Seluruh Yogyakarta</h2>
            <p class="lead"><b>Jelajahi ribuan rute sepeda terbaik di Yogyakarta. Dari jalur santai di kota hingga
                    petualangan menantang di pegunungan.</b></p>
            <a href="/rutelist" class="btn btn-success "> <b> Jelajahi Rutemu </b></a>
            <a href="#" class="btn btn-success "> <b> Merch Kami </b></a>
        </div>
    </header>
    <br>

    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 d-none d-lg-block" id="sidebarAd"> 
                <div class="position-sticky" style="top: 80px;">


                    <div class="card ad-placeholder position-relative">


                        <p>advertisement</p>

                        <img src="https://i.pinimg.com/736x/6c/5e/43/6c5e432be59e5fa5fdb7cd36410a2b51.jpg"
                            class="img-fluid" alt="advertisement">
                    </div>
                </div>
            </aside>
            <main class="col-lg-8">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div id="reviewCarousel" class="carousel slide py-5" data-bs-ride="carousel">

                                {{-- Tampilkan hanya jika ada ulasan --}}
                                @if ($reviews->isNotEmpty())

                                    {{-- Indikator Carousel Dinamis --}}
                                    <div class="carousel-indicators">
                                        @foreach ($reviews as $index => $review)
                                            <button type="button" data-bs-target="#reviewCarousel"
                                                data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                                aria-label="Review {{ $index + 1 }}"></button>
                                        @endforeach
                                    </div>

                                    <div class="carousel-inner text-center">
                                        {{-- Loop untuk setiap item review --}}
                                        @foreach ($reviews as $index => $review)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <div class="card shadow-sm border-0 mx-auto" style="max-width: 720px;">
                                                    <div class="card-body p-4 p-md-5">

                                                        {{-- Foto profil statis sesuai permintaan --}}
                                                        <img src="https://i.pravatar.cc/100?u=a042581f4e29026704d"
                                                            class="rounded-circle mb-3 shadow-sm" alt="Foto Profil Pengguna">

                                                        <h5 class="fw-bold">{{ $review->nama }}</h5>

                                                        {{-- Menampilkan bundle yang di-review --}}
                                                        <p class="text-muted small mb-3">
                                                            Memberi ulasan untuk
                                                            <strong>{{ $review->bundle->nama_bundle }}</strong>
                                                        </p>

                                                        {{-- Rating Bintang Dinamis --}}
                                                        <div class="text-warning mb-3">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $review->rating)
                                                                    <i class="bi bi-star-fill"></i>
                                                                @else
                                                                    <i class="bi bi-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>

                                                        {{-- Feedback Dinamis --}}
                                                        <p class="text-secondary fst-italic">
                                                            “{{ $review->feedback }}”
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Kontrol Navigasi --}}
                                    <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel"
                                        data-bs-slide="prev">
                                        <span aria-hidden="true"><i class="bi bi-chevron-left fs-1 text-dark"></i></span>
                                        <span class="visually-hidden">Sebelumnya</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel"
                                        data-bs-slide="next">
                                        <span aria-hidden="true"><i class="bi bi-chevron-right fs-1 text-dark"></i></span>
                                        <span class="visually-hidden">Berikutnya</span>
                                    </button>

                                @else
                                    {{-- Tampilan jika tidak ada ulasan sama sekali --}}
                                    <div class="text-center py-5">
                                        <p class="text-muted">Belum ada ulasan yang tersedia.</p>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <section class="py-5">
                        <div class="container-fluid px-md-5">
                            <h2 class="fw-bolder text-center mb-5">⭐Rekomendasi Bundle Terbaik ⭐</h2>
                            <h3 class="fw-bolder text-center mb-5">Dengan rating di atas 4</h3>

                            <div id="bundleCarousel" class="carousel slide" data-bs-ride="carousel">

                                {{-- Indikator Carousel --}}
                                <div class="carousel-indicators">
                                    @foreach ($bundleChunks as $index => $chunk)
                                        <button type="button" data-bs-target="#bundleCarousel"
                                            data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                            aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>

                                <div class="carousel-inner">
                                    {{-- Loop untuk setiap chunk (3 item) --}}
                                    @forelse ($bundleChunks as $index => $chunk)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 px-md-5">
                                                {{-- Loop untuk setiap bundle di dalam chunk --}}
                                                @foreach ($chunk as $bundle)
                                                    <div class="col">
                                                        <a href="#" class="text-decoration-none">
                                                            <div class="bundle-card shadow-sm"
                                                                style="background-image: url('{{ $bundle->gambar ?? 'https://picsum.photos/id/40/400/300' }}');">
                                                                <div class="bundle-card-content">

                                                                    {{-- Rating Bintang Dinamis (Contoh: $bundle->rating = 4.5)
                                                                    --}}
                                                                    <div class="text-warning mb-2">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= floor($bundle->rating ?? 4)) {{-- Bintang
                                                                                penuh --}}
                                                                                <i class="bi bi-star-fill"></i>
                                                                            @elseif ($i - 0.5 <= ($bundle->rating ?? 4.5)) {{--
                                                                                Bintang setengah --}}
                                                                                <i class="bi bi-star-half"></i>
                                                                            @else {{-- Bintang kosong --}}
                                                                                <i class="bi bi-star"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>

                                                                    <h5 class="fw-bold mb-1">{{ $bundle->nama_bundle }}</h5>
                                                                    <p class="small mb-2"><i
                                                                            class="bi bi-geo-alt-fill me-1"></i>
                                                                        {{ $bundle->kabupaten }}
                                                                    </p>

                                                                    @php
                                                                        $kesulitan = strtoupper($bundle->kesulitan);
                                                                        $badgeColor = match ($kesulitan) {
                                                                            'SULIT' => 'bg-danger',
                                                                            'SEDANG' => 'bg-warning text-dark',
                                                                            default => 'bg-success', // MUDAH
                                                                        };
                                                                    @endphp
                                                                    <span
                                                                        class="badge {{ $badgeColor }}">{{ $kesulitan }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @empty
                                        {{-- Pesan ditampilkan jika tidak ada bundle sama sekali --}}
                                        <div class="text-center py-5">
                                            <h5 class="text-muted">Belum ada bundle rute yang tersedia.</h5>
                                            <p class="text-muted">Silakan cek kembali nanti.</p>
                                        </div>
                                    @endforelse
                                </div>

                                {{-- Tampilkan kontrol hanya jika ada lebih dari 1 slide --}}
                                @if ($bundleChunks->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#bundleCarousel"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Sebelumnya</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#bundleCarousel"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Berikutnya</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </section>

                    <section class="py-5" style="background:#f5f7fb;">
                        <div class="container">
                            <div class="row g-4 align-items-center rounded-4 shadow-sm p-4 p-lg-5"
                                style="background: linear-gradient(135deg, #1a8754 0%, #f3f6ff 55%, rgba(225, 255, 216, 1) 100%);">

                                <div class="col-lg-6">
                                    <div class="position-relative rounded-4 overflow-hidden shadow"
                                        style="max-height: 500px;">
                                        <img src="https://bakpiakukustugu.co.id/uploads/7/2021-09/31636_tugu_yogyakarta.jpeg"
                                            class="w-100 h-100" style="object-fit: cover;" alt="Gambar hotel">
                                        <div class="position-absolute top-0 start-0 w-100 h-100"
                                            style="background: radial-gradient(ellipse at 30% 20%, rgba(0,0,0,.08), transparent 40%);">
                                        </div>

                                        <span
                                            class="position-absolute top-0 start-0 m-3 badge bg-success-subtle text-success-emphasis rounded-pill">
                                            <i class="bi bi-patch-check-fill me-1"></i> Best Deal
                                        </span>
                                    </div>
                                </div>

                                <div
                                    class="col-lg-6 d-flex flex-column align-items-center align-items-lg-start text-center text-lg-start">
                                    <h3 class="fw-bold mb-2">
                                        DAPATKAN PAKET HARGA TERBAIK
                                    </h3>
                                    <p class="lead mb-3">
                                        Lengkap dengan <span class="fw-semibold">Hotel</span>, <span
                                            class="fw-semibold">Resto</span>, dan
                                        <span class="fw-semibold">Landmark</span> yang siap Anda kunjungi!
                                    </p>

                                    <ul class="list-unstyled d-grid gap-2 mb-4"
                                        style="grid-template-columns: repeat(2, minmax(0,1fr));">
                                        <li class="d-flex align-items-center gap-2">
                                            <i class="bi bi-building-check text-primary"></i> Hotel pilihan terkurasi
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <i class="bi bi-egg-fried text-danger"></i> Rekomendasi resto favorit
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <i class="bi bi-geo-alt-fill text-success"></i> Landmark populer & hidden
                                            gem
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <i class="bi bi-star-fill text-warning"></i> Ulasan asli dari traveler
                                        </li>
                                    </ul>

                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="/rutelist" class="btn btn-primary btn-lg">
                                            <i class="bi bi-search me-1"></i> Jelajahi Paket
                                        </a>
                                    </div>

                                    <hr class="w-100 my-4 opacity-25">
                                </div>
                            </div>
                        </div>
                    </section>


                </div>
            </main>

            <aside class="col-lg-2 d-none d-lg-block" id="sidebarAd">
                <div class="position-sticky" style="top: 80px;">

                    <div class="card ad-placeholder position-relative">


                        <p>advertisement</p>

                        <img src="https://i.pinimg.com/736x/6c/5e/43/6c5e432be59e5fa5fdb7cd36410a2b51.jpg"
                            class="img-fluid" alt="advertisement">
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <footer class="bg-success text-white text-center py-3 mt-5">
        &copy; {{ date('Y') }} Gowes. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

