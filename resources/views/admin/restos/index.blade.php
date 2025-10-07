@extends('layouts.admin')

@section('title', 'Manajemen Restoran')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Restoran</h1>
        <a href="{{ route('restos.create') }}" class="btn btn-primary">Tambah Restoran</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Nama Restoran</th>
                        <th>Harga (Rp)</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($restos as $resto)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- REVISI: src gambar langsung dari URL di database --}}
                                @if($resto->gambar)
                                    <img src="{{ $resto->gambar }}" alt="{{ $resto->nama_resto }}" width="100" style="object-fit: cover; border-radius: 4px;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $resto->nama_resto }}</td>
                            <td>{{ number_format($resto->harga_resto, 0, ',', '.') }}</td>
                            <td>{{ $resto->lokasi_resto }}</td>
                            <td>
                                <form action="{{ route('restos.destroy', $resto->id_resto) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                            <td colspan="6" class="text-center">Belum ada data restoran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection