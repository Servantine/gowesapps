@extends('layouts.admin')

@section('title', 'Manajemen Destinasi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Destinasi</h1>
        <a href="{{ route('destinasis.create') }}" class="btn btn-primary">Tambah Destinasi</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Nama Destinasi</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($destinasis as $destinasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- REVISI: src gambar langsung dari URL di database --}}
                                @if($destinasi->gambar)
                                    <img src="{{ $destinasi->gambar }}" alt="{{ $destinasi->nama_destinasi }}" width="100" style="object-fit: cover; border-radius: 4px;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $destinasi->nama_destinasi }}</td>
                            <td>{{ $destinasi->lokasi_destinasi }}</td>
                            <td>
                                <form action="{{ route('destinasis.destroy', $destinasi->id_destinasi) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                            <td colspan="5" class="text-center">Belum ada data destinasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection