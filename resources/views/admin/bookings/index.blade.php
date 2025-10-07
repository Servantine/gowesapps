@extends('layouts.admin')

@section('title', 'Manajemen Pemesanan')

@section('content')
    <h1>Daftar Pemesanan</h1>

    <div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pemesan</th>
                            <th>Rute Bundle</th>
                            <th>Check-in</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>{{ $booking->nama_lengkap }}<br><small class="text-muted">{{ $booking->nomer_wa }}</small></td>
                                <td>{{ $booking->bundle->nama_bundle }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->tanggal_checkin)->format('d M Y') }}</td>
                                <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status_pembayaran" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="pending" @if($booking->status_pembayaran == 'pending') selected @endif>Pending</option>
                                            <option value="paid" @if($booking->status_pembayaran == 'paid') selected @endif>Paid</option>
                                            <option value="cancelled" @if($booking->status_pembayaran == 'cancelled') selected @endif>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-info btn-sm">Detail</a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada pemesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-3">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
@endsection