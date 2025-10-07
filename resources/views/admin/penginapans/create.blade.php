@extends('layouts.admin')

@section('title', 'Tambah Penginapan Baru')

@section('content')
    <h1>Tambah Penginapan Baru</h1>

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
            <form action="{{ route('penginapans.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_penginapan" class="form-label">Nama Penginapan</label>
                    <input type="text" class="form-control" id="nama_penginapan" name="nama_penginapan" value="{{ old('nama_penginapan') }}" required>
                </div>
                <div class="mb-3">
                    <label for="harga_penginapan" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" id="harga_penginapan" name="harga_penginapan" value="{{ old('harga_penginapan') }}" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi_penginapan" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi_penginapan" name="lokasi_penginapan" value="{{ old('lokasi_penginapan') }}" required>
                </div>
                
                {{-- REVISI: Input file diubah menjadi input URL --}}
                <div class="mb-3">
                    <label for="gambar" class="form-label">Link Gambar</label>
                    <input class="form-control" type="url" id="gambar" name="gambar" value="{{ old('gambar') }}" placeholder="https://contoh.com/gambar.jpg">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('penginapans.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection