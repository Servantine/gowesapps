<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Rute Sepeda – Gowes Ngacir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hero { background: linear-gradient(135deg, #f8fafc 0%, #eef6ff 100%); }
        .route-thumb { height: 160px; object-fit: cover; }
        .chip { --bs-badge-padding-x: .6rem; --bs-badge-padding-y: .4rem; background: #f1f5f9; color: #0f172a; border-radius: 999px; font-weight: 500; }
        .difficulty-badge[data-level="Easy"] { background: #e8f7e9; color: #1e7e34; }
        .difficulty-badge[data-level="Intermediate"] { background: #fff4e5; color: #b96b00; }
        .difficulty-badge[data-level="Expert"] { background: #fde8e8; color: #b42318; }
        body { padding-top: 56px; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">GOWES NGACIR</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('rutelist') }}">Rute Sepeda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero py-5">
        <div class="container text-center pt-4">
            <h1 class="fw-bold mb-2">Rute Sepeda</h1>
            <p class="text-secondary mb-0">Temukan rute sepeda terbaik di seluruh Indonesia</p>
        </div>
    </header>

    <section class="py-4">
        <div class="container">
            <form method="GET" action="{{ route('rutelist') }}">
                <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterCanvas">
                            <i class="bi bi-sliders me-1"></i> Filter
                        </button>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="search" name="search" class="form-control" placeholder="Cari nama trek..." value="{{ request('search') }}">
                        </div>
                         <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <label class="text-secondary small mb-0">Urutkan:</label>
                        <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="nama_bundle" {{ request('sort', 'nama_bundle') == 'nama_bundle' ? 'selected' : '' }}>Nama Trek</option>
                            <option value="jarak" {{ request('sort') == 'jarak' ? 'selected' : '' }}>Jarak Terjauh</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                        </select>
                    </div>
                </div>
            </form>

            <div class="row g-4">
                @forelse ($bundles as $bundle)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $bundle->gambar ?? 'https://via.placeholder.com/400x200.png?text=No+Image' }}"
                                 class="route-thumb card-img-top" alt="{{ $bundle->nama_bundle }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h5 class="card-title mb-1">{{ $bundle->nama_bundle }}</h5>
                                    <span class="badge difficulty-badge" data-level="{{ $bundle->kesulitan }}">{{ $bundle->kesulitan }}</span>
                                </div>
                                <p class="text-secondary small mb-3"><i class="bi bi-geo-alt-fill me-1"></i>{{ $bundle->kabupaten }}</p>
                                <div class="d-flex flex-wrap gap-3 small text-secondary">
                                    <span><i class="bi bi-arrow-left-right me-1 text-primary"></i>{{ $bundle->jarak }} km</span>
                                    @if($bundle->titik_kumpul)
                                    <span><i class="bi bi-pin-map-fill me-1 text-primary"></i>{{ $bundle->titik_kumpul }}</span>
                                    @endif
                                    @if($bundle->restos_count > 0)
                                    <span><i class="bi bi-shop me-1 text-primary"></i>{{ $bundle->restos_count }} Resto</span>
                                    @endif
                                    @if($bundle->penginapans_count > 0)
                                    <span><i class="bi bi-house-door-fill me-1 text-primary"></i>{{ $bundle->penginapans_count }} Penginapan</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                <div class="text-warning small">
                                    {!! renderStars($bundle->rating) !!}
                                    <span class="text-secondary ms-1">({{ number_format($bundle->rating, 1) }})</span>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('rute.detail', $bundle->id_bundle) }}" class="btn btn-sm btn-success"><i class="bi bi-info-circle me-1"></i>Pesan Bundle</a>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            <h4 class="alert-heading">Tidak Ada Rute Ditemukan</h4>
                            <p>Maaf, kami tidak dapat menemukan rute yang sesuai dengan kriteria pencarian atau filter Anda. Coba reset filter atau gunakan kata kunci lain.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <nav class="mt-4 d-flex justify-content-center">
                {{ $bundles->links() }}
            </nav>
        </div>
    </section>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="filterCanvas">
        <div class="offcanvas-header">
            <h5 class="mb-0"><i class="bi bi-sliders me-1"></i> Filter Rute</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form method="GET" action="{{ route('rutelist') }}">
                {{-- Menyimpan parameter search & sort yang sedang aktif --}}
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Lokasi (Kabupaten)</label>
                    <select class="form-select" name="kabupaten">
                        <option value="">Semua Lokasi</option>
                        @foreach ($kabupatens as $kab)
                            <option value="{{ $kab->kabupaten }}" {{ request('kabupaten') == $kab->kabupaten ? 'selected' : '' }}>
                                {{ $kab->kabupaten }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tingkat Kesulitan</label>
                    <select class="form-select" name="kesulitan">
                        <option value="">Semua Tingkat</option>
                        <option value="Easy" {{ request('kesulitan') == 'Easy' ? 'selected' : '' }}>Easy</option>
                        <option value="Intermediate" {{ request('kesulitan') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="Expert" {{ request('kesulitan') == 'Expert' ? 'selected' : '' }}>Expert</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Rating Minimal</label>
                    <select class="form-select" name="rating">
                        <option value="">Semua Rating</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>★★★★☆ & up</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>★★★☆☆ & up</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>★★☆☆☆ & up</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>★☆☆☆☆ & up</option>
                    </select>
                </div>
                
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel me-1"></i>Terapkan Filter</button>
                    <a href="{{ route('rutelist') }}" class="btn btn-outline-secondary">Reset Semua Filter</a>
                </div>
            </form>
        </div>
    </div>
    
    <footer class="py-4 border-top">
        <div class="container d-flex justify-content-between align-items-center">
            <small class="text-secondary mb-0">© {{ date('Y') }} Gowes Ngacir</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>