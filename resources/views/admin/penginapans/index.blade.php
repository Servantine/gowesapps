@extends('layouts.admin')

@section('title', 'Manajemen Penginapan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Penginapan</h1>
        <a href="{{ route('penginapans.create') }}" class="btn btn-primary">Tambah Penginapan</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Nama Penginapan</th>
                        <th>Harga (Rp)</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penginapans as $penginapan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- REVISI: src gambar langsung dari URL di database --}}
                                @if($penginapan->gambar)
                                    <img src="{{ $penginapan->gambar }}" alt="{{ $penginapan->nama_penginapan }}" width="100" style="object-fit: cover; border-radius: 4px;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $penginapan->nama_penginapan }}</td>
                            <td>{{ number_format($penginapan->harga_penginapan, 0, ',', '.') }}</td>
                            <td>{{ $penginapan->lokasi_penginapan }}</td>
                            <td>
                                <form action="{{ route('penginapans.destroy', $penginapan->id_penginapan) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data penginapan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection