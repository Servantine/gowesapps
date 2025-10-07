@extends('layouts.admin')

@section('title', 'Detail Pemesanan #' . $booking->id)

@section('content')
    <h1>Detail Pemesanan #{{ $booking->id }}</h1>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary mb-3">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Pemesanan
    </a>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Data Pemesan</h5>
                    <table class="table table-borderless">
                        <tr><th style="width: 150px;">Nama</th><td>: {{ $booking->nama_lengkap }}</td></tr>
                        <tr><th>No. WA</th><td>: {{ $booking->nomer_wa }}</td></tr>
                        <tr><th>Tanggal</th><td>: {{ \Carbon\Carbon::parse($booking->tanggal_checkin)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($booking->tanggal_checkout)->format('d M Y') }}</td></tr>
                        <tr><th>Catatan</th><td>: {{ $booking->catatan ?? '-' }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Detail Pesanan</h5>
                    <table class="table table-borderless">
                        <tr><th style="width: 150px;">Rute Bundle</th><td>: {{ $booking->bundle->nama_bundle }}</td></tr>
                        <tr><th>Paket</th><td>: {{ $booking->detail_pesanan['paket'] ?? '-' }}</td></tr>
                        <tr><th>Add-on Hotel</th><td>: {{ $booking->detail_pesanan['hotel'] ?? '-' }}</td></tr>
                        <tr><th>Add-on Resto</th><td>: {{ $booking->detail_pesanan['resto'] ?? '-' }}</td></tr>
                    </table>
                    <hr>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Metode Pembayaran: <span class="badge bg-primary rounded-pill">{{ $booking->metode_pembayaran }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Status Pembayaran: <span class="badge bg-warning rounded-pill">{{ Str::title($booking->status_pembayaran) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Total Harga:</strong> <strong class="fs-5 text-success">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection