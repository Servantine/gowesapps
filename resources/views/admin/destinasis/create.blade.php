@extends('layouts.admin')

@section('title', 'Tambah Destinasi Baru')

@section('content')
    <h1>Tambah Destinasi Baru</h1>

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
            <form action="{{ route('destinasis.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_destinasi" class="form-label">Nama Destinasi</label>
                    <input type="text" class="form-control" id="nama_destinasi" name="nama_destinasi" value="{{ old('nama_destinasi') }}" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi_destinasi" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi_destinasi" name="lokasi_destinasi" value="{{ old('lokasi_destinasi') }}" required>
                </div>
                
                {{-- REVISI: Input file diubah menjadi input URL --}}
                <div class="mb-3">
                    <label for="gambar" class="form-label">Link Gambar</label>
                    <input class="form-control" type="url" id="gambar" name="gambar" value="{{ old('gambar') }}" placeholder="https://contoh.com/gambar.jpg">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('destinasis.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection