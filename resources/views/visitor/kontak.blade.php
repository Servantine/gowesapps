<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Kontak Kami – Gowes Ngacir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(135deg, #f8fafc 0%, #eef6ff 100%);
        }

        .contact-info-card {
            background-color: #f7f7f7;
            border-radius: 10px;
        }

        .map-placeholder {
            height: 300px;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            border-radius: 8px;
        }

        /* Nav active link adjustment */
        .navbar-nav .nav-item .nav-link.active {
            font-weight: bold;
            color: white !important;
            border-bottom: 2px solid white;
        }

        body {
            padding-top: 56px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">GOWES NGACIR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/rutelist">Rute Sepeda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/kontak">Kontak Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="/saran-rute">Berikan Saran Rute</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Komunitas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero py-5">
        <div class="container text-center pt-4">
            <h1 class="display-5 fw-bold mb-2">Hubungi Kami</h1>
            <p class="lead text-secondary mb-0">Kami siap membantu menjawab pertanyaan Anda seputar rute, paket, atau kerja sama.</p>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                
                <div class="col-lg-7">
                    <h2 class="fw-bold mb-4">Kirim Pesan Kepada Kami</h2>
                    
                    {{-- ID ditambahkan ke form untuk diakses JavaScript --}}
                    <form id="waContactForm" action="https://wa.me/6281938245720" method="GET" target="_blank"> 
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Aktif</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="nama@contoh.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Contoh: Pertanyaan Rute X" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label">Pesan Anda</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        
                        {{-- Input tersembunyi untuk menampung pesan WA yang sudah terformat --}}
                        <input type="hidden" name="text" id="whatsappMessage"> 

                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-send-fill me-2"></i> Kirim Pesan via WhatsApp
                        </button>
                    </form>
                </div>

                <div class="col-lg-5">
                    <h2 class="fw-bold mb-4">Informasi Kontak</h2>
                    
                    <div class="contact-info-card p-4 mb-4 shadow-sm">
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-envelope-fill fs-4 text-success me-3"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">Email Dukungan</h6>
                                <p class="text-secondary mb-0">admin@gowesngacir.com</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-telephone-fill fs-4 text-success me-3"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">Telepon/WhatsApp</h6>
                                <p class="text-secondary mb-0">+62 819-3824-5720</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <i class="bi bi-geo-alt-fill fs-4 text-success me-3"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">Alamat SMA BOPKRI 1</h6>
                                <p class="text-secondary mb-0">Jl. Wardhani No.2, Kotabaru, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55224</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="map-placeholder shadow-sm">
                        <p class="mb-0"><i class="bi bi-map me-2"></i> Placeholder Peta Lokasi</p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    
    <footer class="py-4 border-top">
        <div class="container d-flex justify-content-between align-items-center">
            <small class="text-secondary mb-0">© {{ date('Y') }} Gowes Ngacir</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('waContactForm').addEventListener('submit', function(e) {
            
            // Mengambil nilai dari input
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            // Membuat template pesan WhatsApp
            const template = 
                "*Pesan Kontak Baru dari Website*\n\n" +
                "Nama: " + name + "\n" +
                "Email: " + email + "\n" +
                "Subjek: " + subject + "\n\n" +
                "*Isi Pesan:*\n" + message;

            // Mengganti baris baru (\n) menjadi kode URL encoding (%0A)
            const encodedTemplate = encodeURIComponent(template);

            // Menetapkan pesan yang sudah di-encode ke input tersembunyi 'text'
            document.getElementById('whatsappMessage').value = encodedTemplate;
            
            // Setelah ini, form akan di-submit ke https://wa.me/6281938245720?text=...
        });
    </script>
</body>
</html>