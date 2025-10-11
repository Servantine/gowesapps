@extends('layouts.admin')

@section('title', 'Manajemen Restoran')

@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col">
                <h2 class="mb-4">Manajemen Saran Rute</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#ID</th>
                                        <th>Pengirim</th>
                                        <th>Nama Rute</th>
                                        <th>Lokasi</th>
                                        <th>Jarak</th>
                                        <th>Kesulitan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($suggestions as $suggestion)
                                        <tr>
                                            <td>#{{ $suggestion->id }}</td>
                                            <td>{{ $suggestion->nama_pengirim }}<br><small
                                                    class="text-muted">{{ $suggestion->email_pengirim }}</small></td>
                                            <td>{{ $suggestion->nama_rute }}</td>
                                            <td>{{ $suggestion->lokasi }}</td>
                                            <td>{{ $suggestion->estimasi_jarak }} km</td>
                                            <td>
                                                <span class="badge 
                                                @if($suggestion->tingkat_kesulitan == 'Easy') bg-success
                                                @elseif($suggestion->tingkat_kesulitan == 'Intermediate') bg-warning
                                                @else bg-danger @endif">
                                                    {{ $suggestion->tingkat_kesulitan }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('suggestions.updateStatus', $suggestion) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-select form-select-sm"
                                                        onchange="this.form.submit()">
                                                        <option value="pending" @if($suggestion->status == 'pending') selected
                                                        @endif>Pending</option>
                                                        <option value="approved" @if($suggestion->status == 'approved') selected
                                                        @endif>Approved</option>
                                                        <option value="rejected" @if($suggestion->status == 'rejected') selected
                                                        @endif>Rejected</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                {{-- Tombol Detail bisa Anda kembangkan nanti --}}
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $suggestion->id }}">Detail</button>
                                                <form action="{{ route('suggestions.destroy', $suggestion) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin hapus saran ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="detailModal{{ $suggestion->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Saran: {{ $suggestion->nama_rute }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Deskripsi:</strong></p>
                                                        <p>{{ $suggestion->deskripsi }}</p>
                                                        <hr>
                                                        <p><strong>Dikirim pada:</strong>
                                                            {{ $suggestion->created_at->format('d M Y, H:i') }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Belum ada saran rute yang masuk.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection