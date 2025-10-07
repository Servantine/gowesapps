@extends('layouts.admin')

@section('title', 'Tambah Restoran Baru')

@section('content')
    <h1>Tambah Restoran Baru</h1>

    <div class="card mt-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- REVISI: enctype dihapus dari form --}}
            <form action="{{ route('restos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_resto" class="form-label">Nama Restoran</label>
                    <input type="text" class="form-control" id="nama_resto" name="nama_resto" value="{{ old('nama_resto') }}" required>
                </div>
                <div class="mb-3">
                    <label for="harga_resto" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" id="harga_resto" name="harga_resto" value="{{ old('harga_resto') }}" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi_resto" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi_resto" name="lokasi_resto" value="{{ old('lokasi_resto') }}" required>
                </div>
                
                {{-- REVISI: Input file diubah menjadi input URL --}}
                <div class="mb-3">
                    <label for="gambar" class="form-label">Link Gambar</label>
                    <input class="form-control" type="url" id="gambar" name="gambar" value="{{ old('gambar') }}" placeholder="https://contoh.com/gambar.jpg">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('restos.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection