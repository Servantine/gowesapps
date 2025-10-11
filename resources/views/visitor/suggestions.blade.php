<html>

<head>
    <meta charset="utf-8">
    <title>Sarankan Rute – Gowes Ngacir </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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
                    <li class="nav-item"><a class="nav-link" href="/kontak">Kontak Kami</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/saran-rute">Berikan Saran Rute</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Komunitas</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Formulir Saran Rute Sepeda</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Punya ide rute gowes yang seru? Bagikan dengan kami agar bisa dinikmati
                            oleh komunitas!</p>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('suggestions.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_pengirim" class="form-label">Nama Anda</label>
                                    <input type="text" class="form-control @error('nama_pengirim') is-invalid @enderror"
                                        id="nama_pengirim" name="nama_pengirim" value="{{ old('nama_pengirim') }}"
                                        required>
                                    @error('nama_pengirim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_pengirim" class="form-label">Email Anda</label>
                                    <input type="email"
                                        class="form-control @error('email_pengirim') is-invalid @enderror"
                                        id="email_pengirim" name="email_pengirim" value="{{ old('email_pengirim') }}"
                                        required>
                                    @error('email_pengirim') <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label for="nama_rute" class="form-label">Nama Rute</label>
                                <input type="text" class="form-control @error('nama_rute') is-invalid @enderror"
                                    id="nama_rute" name="nama_rute" value="{{ old('nama_rute') }}"
                                    placeholder="Contoh: Keliling Waduk Sermo" required>
                                @error('nama_rute') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi/Kota</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                                    placeholder="Contoh: Kulon Progo, Yogyakarta" required>
                                @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="estimasi_jarak" class="form-label">Estimasi Jarak (km)</label>
                                    <input type="number" step="0.1"
                                        class="form-control @error('estimasi_jarak') is-invalid @enderror"
                                        id="estimasi_jarak" name="estimasi_jarak" value="{{ old('estimasi_jarak') }}"
                                        placeholder="Contoh: 22.5" required>
                                    @error('estimasi_jarak') <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tingkat_kesulitan" class="form-label">Tingkat Kesulitan</label>
                                    <select class="form-select @error('tingkat_kesulitan') is-invalid @enderror"
                                        id="tingkat_kesulitan" name="tingkat_kesulitan" required>
                                        <option value="" disabled selected>-- Pilih Tingkat Kesulitan --</option>
                                        <option value="Easy" {{ old('tingkat_kesulitan') == 'Easy' ? 'selected' : '' }}>
                                            Easy</option>
                                        <option value="Intermediate" {{ old('tingkat_kesulitan') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="Expert" {{ old('tingkat_kesulitan') == 'Expert' ? 'selected' : '' }}>Expert</option>
                                    </select>
                                    @error('tingkat_kesulitan') <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Rute</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                                    name="deskripsi" rows="4"
                                    placeholder="Jelaskan keunikan rute ini, seperti pemandangan, kondisi jalan, atau tempat menarik yang dilewati."
                                    required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">Kirim Saran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>