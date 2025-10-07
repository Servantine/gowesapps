@extends('layouts.admin')

@section('title', 'Tambah Bundle Baru')

@section('content')
    <h1>Tambah Bundle Baru</h1>
    <div class="card mt-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('bundles.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3"><label for="nama_bundle" class="form-label">Nama Bundle</label><input type="text" class="form-control" name="nama_bundle" value="{{ old('nama_bundle') }}"></div>
                    <div class="col-md-6 mb-3"><label for="kesulitan" class="form-label">Kesulitan</label><input type="text" class="form-control" name="kesulitan" value="{{ old('kesulitan') }}"></div>
                    <div class="col-md-6 mb-3"><label for="jarak" class="form-label">Jarak (KM)</label><input type="number" class="form-control" name="jarak" value="{{ old('jarak') }}"></div>
                    <div class="col-md-6 mb-3"><label for="titik_kumpul" class="form-label">Titik Kumpul</label><input type="text" class="form-control" name="titik_kumpul" value="{{ old('titik_kumpul') }}"></div>
                    <div class="col-md-6 mb-3"><label for="kabupaten" class="form-label">Kabupaten</label><input type="text" class="form-control" name="kabupaten" value="{{ old('kabupaten') }}"></div>
                    <div class="col-md-6 mb-3"><label for="gambar" class="form-label">Link Gambar Utama</label><input class="form-control" type="url" name="gambar" value="{{ old('gambar') }}" placeholder="https://contoh.com/gambar-utama.jpg"></div>

                    {{-- REVISI BARU: Input untuk Maps, Thumbnail, dan Rating --}}
                    <div class="col-md-8 mb-3">
                        <label for="link_maps" class="form-label">Link Google Maps</label>
                        <input class="form-control" type="url" name="link_maps" value="{{ old('link_maps') }}" placeholder="https://maps.app.goo.gl/contoh">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="rating" class="form-label">Rating (0.0 - 5.0)</label>
                        <input class="form-control" type="number" name="rating" value="{{ old('rating') }}" step="0.1" min="0" max="5.0" placeholder="4.5">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="gambar_thumbnail_maps" class="form-label">Link Gambar Thumbnail Maps</label>
                        <input class="form-control" type="url" name="gambar_thumbnail_maps" value="{{ old('gambar_thumbnail_maps') }}" placeholder="https://contoh.com/gambar-thumbnail.jpg">
                    </div>
                </div>
                
                <hr>
                <h4>Pilih Item untuk Bundle</h4>
                {{-- Bagian select untuk resto, destinasi, penginapan tidak berubah --}}
                <div class="mb-3">
                    <label for="restos" class="form-label">Restoran</label>
                    <select class="form-select" name="restos[]" id="restos" multiple>@foreach ($restos as $resto)<option value="{{ $resto->id_resto }}">{{ $resto->nama_resto }}</option>@endforeach</select>
                    <small class="form-text text-muted">Tahan Ctrl (atau Cmd di Mac) untuk memilih lebih dari satu.</small>
                </div>
                <div class="mb-3">
                    <label for="destinasis" class="form-label">Destinasi</label>
                    <select class="form-select" name="destinasis[]" id="destinasis" multiple>@foreach ($destinasis as $destinasi)<option value="{{ $destinasi->id_destinasi }}">{{ $destinasi->nama_destinasi }}</option>@endforeach</select>
                </div>
                <div class="mb-3">
                    <label for="penginapans" class="form-label">Penginapan</label>
                    <select class="form-select" name="penginapans[]" id="penginapans" multiple>@foreach ($penginapans as $penginapan)<option value="{{ $penginapan->id_penginapan }}">{{ $penginapan->nama_penginapan }}</option>@endforeach</select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('bundles.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection