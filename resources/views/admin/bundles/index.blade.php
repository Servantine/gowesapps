@extends('layouts.admin')

@section('title', 'Manajemen Bundle')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Bundle</h1>
        <a href="{{ route('bundles.create') }}" class="btn btn-primary">Tambah Bundle Baru</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Bundle</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">Detail</th>
                            {{-- REVISI BARU: Kolom baru untuk Maps & Rating --}}
                            <th scope="col">Maps & Rating</th>
                            <th scope="col" style="min-width: 250px;">Item Terhubung</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bundles as $bundle)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($bundle->gambar)
                                        <img src="{{ $bundle->gambar }}" alt="{{ $bundle->nama_bundle }}" width="120" style="object-fit: cover; border-radius: 8px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $bundle->nama_bundle }}</td>
                                <td>{{ $bundle->kabupaten }}</td>
                                <td>
                                    <div><strong>Kesulitan:</strong> {{ $bundle->kesulitan }}</div>
                                    <div><strong>Jarak:</strong> {{ $bundle->jarak }} KM</div>
                                    <div><strong>Kumpul:</strong> {{ $bundle->titik_kumpul }}</div>
                                </td>
                                
                                {{-- REVISI BARU: Tampilkan data Maps & Rating --}}
                                <td>
                                    @if($bundle->rating > 0)
                                        <div class="mb-2">
                                            <span class="badge bg-warning text-dark">
                                                <i class="fa-solid fa-star"></i> {{ number_format($bundle->rating, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                    @if($bundle->link_maps)
                                        <a href="{{ $bundle->link_maps }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-map-location-dot"></i> Lihat Peta
                                        </a>
                                        @if($bundle->gambar_thumbnail_maps)
                                            <a href="{{ $bundle->link_maps }}" target="_blank">
                                                <img src="{{ $bundle->gambar_thumbnail_maps }}" alt="Thumbnail Peta" class="mt-2" width="100" style="border-radius: 4px;">
                                            </a>
                                        @endif
                                    @else
                                        <span class="text-muted">Peta tidak tersedia</span>
                                    @endif
                                </td>

                                <td>
                                    @if($bundle->restos->isNotEmpty())
                                        {{-- ... (kode item terhubung tidak berubah) ... --}}
                                    @endif
                                    @if($bundle->destinasis->isNotEmpty())
                                        {{-- ... (kode item terhubung tidak berubah) ... --}}
                                    @endif
                                    @if($bundle->penginapans->isNotEmpty())
                                       {{-- ... (kode item terhubung tidak berubah) ... --}}
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('bundles.destroy', $bundle->id_bundle) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus bundle ini?');">
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
                                {{-- REVISI BARU: Colspan diubah menjadi 8 --}}
                                <td colspan="8" class="text-center py-4">
                                    <p class="mb-0">Belum ada data bundle.</p>
                                    <a href="{{ route('bundles.create') }}" class="btn btn-primary btn-sm mt-2">Buat Bundle Pertama Anda</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $bundles->links() }}
            </div>
        </div>
    </div>
@endsection