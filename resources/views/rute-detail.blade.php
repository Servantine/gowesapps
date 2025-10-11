<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Detail Rute: {{ $bundle->nama_bundle }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { padding-top: 56px; }
        .carousel-control-prev, .carousel-control-next { position: absolute; top: 50%; transform: translateY(-50%); background-color: rgba(0, 0, 0, .5); border-radius: 50%; width: 40px; height: 40px; }
        .carousel-item img { width: 100%; height: 360px; object-fit: cover; }
        .card-img-custom { width: 100%; height: 180px; object-fit: cover; }
        .summary-sticky { position: sticky; top: 20px; }
        .chip { --bs-badge-padding-x: .6rem; --bs-badge-padding-y: .4rem; background: #f1f5f9; color: #0f172a; border-radius: 999px; font-weight: 500; }
        .difficulty-badge[data-level="Easy"] { background: #e8f7e9; color: #1e7e34; }
        .difficulty-badge[data-level="Intermediate"] { background: #fff4e5; color: #b96b00; }
        .difficulty-badge[data-level="Expert"] { background: #fde8e8; color: #b42318; }
        .pkg-card { border: 1px solid #e9ecef; border-radius: 1rem; padding: 1rem 1.25rem; transition: transform .15s ease, box-shadow .15s ease; background: linear-gradient(180deg, #ffffff 0%, #fafafa 100%); cursor: pointer; }
        .pkg-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(16, 24, 40, .08); }
        .pkg-title { display: flex; align-items: center; gap: .5rem; font-weight: 700; }
        .pkg-price { font-weight: 700; }
        .benefits { display: flex; flex-wrap: wrap; gap: .5rem; margin-top: .5rem; }
        .benefit-chip { background: #f1f5f9; color: #0f172a; border-radius: 999px; padding: .25rem .6rem; font-size: .85rem; font-weight: 500; }
        .star-rating { display: inline-flex; gap: .35rem; user-select: none; }
        .star-rating .star { font-size: 2rem; color: #ced4da; cursor: pointer; transition: transform .1s ease; }
        .star-rating .star.active, .star-rating .star.hover { color: #ffc107; }
        .star-rating .star:active { transform: scale(0.95); }
        .review-stars i { color: #ffc107; }
        .review-card { border: 1px solid #e9ecef; }
        .review-name { font-weight: 600; }
        .review-date { color: #6c757d; font-size: .9rem; }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">GOWES NGACIR</a>
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/rutelist">Rute Sepeda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/kontak">Kontak Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="/saran-rute">Berikan Saran Rute</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Komunitas</a></li>
            </ul>
        </div>
    </nav>

    <section class="container py-5">
        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger" id="error-section">
                <strong>Oops! Ada beberapa kesalahan pada form ulasan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-6">
                @if($bundle->destinasis->isNotEmpty())
                <h3 class="my-3">Galeri Destinasi di Rute Ini</h3>
                <div id="destinasiCarousel" class="carousel slide shadow-lg rounded" data-bs-ride="carousel">
                    <div class="carousel-inner rounded">
                        @foreach($bundle->destinasis as $destinasi)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ $destinasi->gambar }}" class="d-block w-100" alt="{{ $destinasi->nama_destinasi }}">
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                                <h5>{{ $destinasi->nama_destinasi }}</h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#destinasiCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                    <button class="carousel-control-next" type="button" data-bs-target="#destinasiCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold">{{ $bundle->nama_bundle }}</h2>
                <p class="text-secondary"><i class="bi bi-geo-alt-fill me-1"></i>{{ $bundle->kabupaten }}</p>
                <p class="lead">{{ $bundle->deskripsi ?? 'Deskripsi untuk rute ini belum tersedia.' }}</p>
                <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                    <span><i class="bi bi-arrow-left-right me-1"></i>{{ $bundle->jarak }} km</span>
                    <span><i class="bi bi-pin-map-fill me-1"></i>{{ $bundle->titik_kumpul }}</span>
                    <span class="badge difficulty-badge" data-level="{{ $bundle->kesulitan }}">{{ $bundle->kesulitan }}</span>
                    <span class="text-warning small">{!! renderStars($bundle->rating) !!}</span>
                </div>

                
            </div>
        </div>
        <br><br>

        <h3 class="mb-3 text-center">Rute (Google Maps)</h3>
        <div class="d-flex justify-content-center mb-4">
            <a href="{{ $bundle->link_maps }}" target="_blank" class="text-decoration-none position-relative d-inline-block">
                <img src="{{ $bundle->gambar_thumbnail_maps }}" alt="Rute {{ $bundle->nama_bundle }}" class="img-fluid rounded shadow" style="max-width: 800px;">
                <div class="position-absolute top-50 start-50 translate-middle bg-dark bg-opacity-50 text-white px-3 py-2 rounded">
                    <i class="bi bi-geo-alt-fill me-1"></i> Klik untuk buka di Google Maps
                </div>
            </a>
        </div>

        <div class="row mt-5 g-4">
            <div class="col-lg-9">
                <h3 class="mb-3">Default Package</h3>
                <div class="row g-3 align-items-stretch">
                    <div class="col-lg-6">
                        <label class="pkg-card w-100 h-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="pkg-title"><i class="bi bi-people-fill"></i> Paket 1 (≥ 10 orang)</div>
                                    <div class="text-muted small">Penyewaan • Helm • Sepeda • Guide Tour • P3K</div>
                                    <div class="benefits">
                                        <span class="benefit-chip"><i class="bi bi-bicycle"></i> Sepeda siap pakai</span>
                                        <span class="benefit-chip"><i class="bi bi-person-check-fill"></i> Guide Tour</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="pkg-price text-success">150.000</div>
                                    <div class="small text-muted">per orang</div>
                                    <input class="form-check-input mt-2" type="radio" name="mainPackage" id="pkg1" data-price="150000" checked>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="pkg-card w-100 h-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="pkg-title"><i class="bi bi-person-fill"></i> Paket 2 (< 10 orang)</div>
                                    <div class="text-muted small">Penyewaan • Helm • Sepeda • Guide Tour • P3K</div>
                                    <div class="benefits">
                                         <span class="benefit-chip"><i class="bi bi-bicycle"></i> Sepeda siap pakai</span>
                                        <span class="benefit-chip"><i class="bi bi-person-check-fill"></i> Guide Tour</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="pkg-price text-warning">210.000</div>
                                    <div class="small text-muted">per orang</div>
                                    <input class="form-check-input mt-2" type="radio" name="mainPackage" id="pkg2" data-price="210000">
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                
                @if($bundle->penginapans->isNotEmpty())
                <h3 class="mt-5 mb-3">Rekomendasi Penginapan (Add-on)</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($bundle->penginapans as $penginapan)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <img src="{{ $penginapan->gambar }}" class="card-img-custom" alt="{{ $penginapan->nama_penginapan }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $penginapan->nama_penginapan }}</h5>
                                <p class="card-text">{{ $penginapan->lokasi_penginapan }}</p>
                                <p class="card-price fw-bold text-success">IDR {{ number_format($penginapan->harga_penginapan, 0, ',', '.') }} / malam</p>
                            </div>
                            <div class="card-footer">
                                <input type="radio" class="form-check-input hotel-option" name="hotel" data-price="{{ $penginapan->harga_penginapan }}" id="hotel{{ $penginapan->id_penginapan }}">
                                <label class="form-check-label" for="hotel{{ $penginapan->id_penginapan }}">Pilih</label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                
                @if($bundle->restos->isNotEmpty())
                <h3 class="mt-5 mb-3">Rekomendasi Restoran (Add-on)</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($bundle->restos as $resto)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <img src="{{ $resto->gambar }}" class="card-img-custom" alt="{{ $resto->nama_resto }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $resto->nama_resto }}</h5>
                                <p class="card-text">{{ $resto->lokasi_resto }}</p>
                                <p class="card-price fw-bold text-success">Estimasi IDR {{ number_format($resto->harga_resto, 0, ',', '.') }} / orang</p>
                            </div>
                            <div class="card-footer">
                                <input type="radio" class="form-check-input resto-option" name="resto" data-price="{{ $resto->harga_resto }}" id="resto{{ $resto->id_resto }}">
                                <label class="form-check-label" for="resto{{ $resto->id_resto }}">Pilih</label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="col-lg-3">
                <div class="card shadow summary-sticky">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Ringkasan Pesanan</h5>
                        <div class="mb-3">
                            <label for="participants" class="form-label fw-bold mb-1">Jumlah Peserta</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" id="btnMinus">-</button>
                                <input type="number" class="form-control text-center" id="participants" value="1" min="1" step="1">
                                <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button>
                            </div>
                            <div class="form-text mt-2" id="pkgHint"></div>
                        </div>
                        <hr>
                        <ul class="list-unstyled small mb-3">
                            <li class="d-flex justify-content-between"><span>Paket Pilihan</span><strong id="summaryPaket"></strong></li>
                            <li class="d-flex justify-content-between mt-2"><span>Add-on Hotel</span><strong id="summaryHotel">—</strong></li>
                            <li class="d-flex justify-content-between"><span>Add-on Restoran</span><strong id="summaryResto">—</strong></li>
                        </ul>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Total Harga:</strong>
                            <strong id="totalPrice" class="text-success fs-5">IDR 0</strong>
                        </div>
                        <div class="d-grid mt-3">
                            <button id="btnBeli" class="btn btn-success"><i class="bi bi-bag-check me-1"></i> Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="my-5">
        <div class="container" id="ulasanList">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Ulasan Pengguna</h3>
                <div class="text-end">
                    <div><span class="fw-bold">{{ number_format($bundle->rating, 1) }}</span>/5</div>
                    <div class="small text-muted">{{ $bundle->reviews->count() }} ulasan</div>
                </div>
            </div>
            <div class="vstack gap-3">
                @forelse($bundle->reviews->sortByDesc('created_at') as $review)
                <div class="review-card rounded p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="review-name">{{ $review->nama }}</div>
                        <div class="review-date">{{ $review->created_at->format('d F Y') }}</div>
                    </div>
                    <div class="review-stars my-1 text-warning">{!! renderStars($review->rating) !!}</div>
                    <p class="mb-0">{{ $review->feedback }}</p>
                </div>
                @empty
                <div class="alert alert-secondary text-center">Belum ada ulasan untuk rute ini. Jadilah yang pertama!</div>
                @endforelse
            </div>
        </div>

        <hr class="my-5">
        <div class="container pb-5" id="ulasanForm">
            <h3 class="mb-3">Beri Rating & Tulis Kritik/Saran</h3>
            <form method="POST" action="{{ route('reviews.store', $bundle) }}" class="row g-3">
                @csrf
                <div class="col-12">
                    <label class="form-label d-block mb-1">Penilaian:</label>
                    <div class="star-rating">
                        <label class="star" data-value="1"><i class="bi bi-star-fill"></i></label>
                        <label class="star" data-value="2"><i class="bi bi-star-fill"></i></label>
                        <label class="star" data-value="3"><i class="bi bi-star-fill"></i></label>
                        <label class="star" data-value="4"><i class="bi bi-star-fill"></i></label>
                        <label class="star" data-value="5"><i class="bi bi-star-fill"></i></label>
                    </div>
                    <input type="hidden" id="ratingValue" name="rating" value="{{ old('rating', 0) }}">
                </div>
                <div class="col-12">
                    <label for="feedback" class="form-label">Kritik & Saran</label>
                    <textarea id="feedback" name="feedback" class="form-control" rows="4" placeholder="Tulis masukan Anda..." required>{{ old('feedback') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama (opsional)</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Nama Anda">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success"><i class="bi bi-send me-1"></i>Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const participantsInput = document.getElementById('participants');
            const btnMinus = document.getElementById('btnMinus');
            const btnPlus = document.getElementById('btnPlus');
            const packageRadios = document.querySelectorAll('input[name="mainPackage"]');
            const addonRadios = document.querySelectorAll('input.hotel-option, input.resto-option');
            const pkgHint = document.getElementById('pkgHint');
            const totalPriceEl = document.getElementById('totalPrice');
            const summaryPaketEl = document.getElementById('summaryPaket');
            const summaryHotelEl = document.getElementById('summaryHotel');
            const summaryRestoEl = document.getElementById('summaryResto');
            const btnBeli = document.getElementById('btnBeli');

            const rupiah = (v) => 'IDR ' + Number(v).toLocaleString('id-ID');
            const getSelectedAddon = (name) => {
                const el = document.querySelector(`input[name="${name}"]:checked`);
                if (!el) return { name: '—', price: 0 };
                const price = parseInt(el.dataset.price) || 0;
                const nameText = el.closest('.card')?.querySelector('.card-title')?.textContent?.trim() || 'Pilihan';
                return { name: nameText, price: price };
            };
            const enforcePackageRules = () => {
                const selectedPkg = document.querySelector('input[name="mainPackage"]:checked');
                let count = parseInt(participantsInput.value) || 1;
                if (!selectedPkg) return;
                if (selectedPkg.id === 'pkg1') {
                    if (count < 10) count = 10;
                    pkgHint.textContent = 'Paket 1 membutuhkan minimal 10 orang.';
                } else if (selectedPkg.id === 'pkg2') {
                    if (count >= 10) count = 9;
                    pkgHint.textContent = 'Paket 2 untuk 1-9 orang.';
                }
                if (parseInt(participantsInput.value) !== count) participantsInput.value = count;
            };
            const updateSummaryAndPrice = () => {
                enforcePackageRules();
                const participants = parseInt(participantsInput.value);
                const selectedPkgRadio = document.querySelector('input[name="mainPackage"]:checked');
                if (!selectedPkgRadio) return;
                const pkgPricePerPerson = parseInt(selectedPkgRadio.dataset.price) || 0;
                const pkgLabel = selectedPkgRadio.closest('.pkg-card')?.querySelector('.pkg-title')?.textContent?.trim() || 'Paket';
                let total = pkgPricePerPerson * participants;
                const hotel = getSelectedAddon('hotel');
                const resto = getSelectedAddon('resto');
                total += hotel.price;
                total += (resto.price * participants);
                totalPriceEl.innerText = rupiah(total);
                summaryPaketEl.innerText = `${pkgLabel} × ${participants}`;
                summaryHotelEl.innerText = hotel.name;
                summaryRestoEl.innerText = resto.name;
            };

            packageRadios.forEach(radio => radio.addEventListener('change', updateSummaryAndPrice));
            addonRadios.forEach(radio => radio.addEventListener('change', updateSummaryAndPrice));
            participantsInput.addEventListener('input', updateSummaryAndPrice);
            btnMinus.addEventListener('click', () => {
                participantsInput.value = Math.max(1, (parseInt(participantsInput.value) || 1) - 1);
                updateSummaryAndPrice();
            });
            btnPlus.addEventListener('click', () => {
                participantsInput.value = (parseInt(participantsInput.value) || 0) + 1;
                updateSummaryAndPrice();
            });
            btnBeli.addEventListener('click', () => {
            // 1. Ambil nilai total harga dari elemen dan bersihkan dari format Rupiah (menghapus "IDR ", ".", dll.)
            const totalPriceEl = document.getElementById('totalPrice');
            const total = parseInt(totalPriceEl.innerText.replace(/[^\d]/g, "")) || 0;

            // 2. Validasi: Jangan lanjutkan jika tidak ada paket yang dipilih (total harga 0)
            if (total === 0) {
                alert('Silakan pilih paket terlebih dahulu sebelum melanjutkan.');
                return; // Hentikan eksekusi fungsi
            }

            // 3. Ambil teks ringkasan dari elemen terkait untuk ditampilkan di halaman selanjutnya
            const summaryPaketEl = document.getElementById('summaryPaket');
            const summaryHotelEl = document.getElementById('summaryHotel');
            const summaryRestoEl = document.getElementById('summaryResto');

            // 4. Siapkan objek data (checkoutData) untuk dikirim ke halaman pembayaran
            const checkoutData = {
                // ID Bundle, penting untuk disimpan ke database
                bundleId: {{ $bundle->id_bundle }}, 
                
                // Nama Rute untuk ditampilkan
                routeName: '{{ addslashes($bundle->nama_bundle) }}',
                
                // Detail ringkasan pesanan untuk ditampilkan ulang
                summary: {
                    paket: summaryPaketEl.innerText,
                    hotel: summaryHotelEl.innerText,
                    resto: summaryRestoEl.innerText,
                },

                // Total harga final
                total: total,
            };

            // 5. Simpan objek data sebagai string JSON ke sessionStorage browser
            // Data ini akan tetap ada selama tab browser tidak ditutup
            sessionStorage.setItem('checkout', JSON.stringify(checkoutData));

            // 6. Arahkan (redirect) pengguna ke halaman pembayaran
            window.location.href = '{{ route("payment.create") }}';
        });
            
            const initStarRating = () => {
                const stars = Array.from(document.querySelectorAll('.star-rating .star'));
                const ratingInput = document.getElementById('ratingValue');
                if (!stars.length || !ratingInput) return;
                let selected = parseInt(ratingInput.value) || 0;
                const paint = (val, mode = 'active') => {
                    stars.forEach(s => {
                        s.classList.remove('hover', 'active');
                        if (Number(s.dataset.value) <= val) s.classList.add(mode);
                    });
                };
                stars.forEach(star => {
                    star.addEventListener('mouseenter', e => paint(Number(e.currentTarget.dataset.value), 'hover'));
                    star.addEventListener('mouseleave', () => paint(selected));
                    star.addEventListener('click', e => {
                        selected = Number(e.currentTarget.dataset.value);
                        ratingInput.value = selected;
                        paint(selected);
                    });
                });
                paint(selected);
            };

            updateSummaryAndPrice();
            initStarRating();

            if (document.getElementById('error-section')) {
                document.getElementById('ulasanForm').scrollIntoView({ behavior: 'smooth' });
            }
        });
    </script>
</body>
</html>