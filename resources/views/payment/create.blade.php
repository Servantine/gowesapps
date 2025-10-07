<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="text-center mb-4">
            <h2>Formulir Pembayaran</h2>
            <p>Selesaikan pesanan Anda dengan mengisi formulir di bawah ini.</p>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Ringkasan Pesanan</span>
                </h4>
                <ul class="list-group mb-3" id="summary-container">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (IDR)</span>
                        <strong id="summary-total">Rp 0</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Data Pemesan</h4>
                <form method="POST" action="{{ route('payment.store') }}">
                    @csrf
                    <input type="hidden" name="bundle_id" id="bundle_id_input">
                    <input type="hidden" name="detail_pesanan" id="detail_pesanan_input">
                    <input type="hidden" name="total_harga" id="total_harga_input">

                    <div class="row g-3">
                        <div class="col-12"><label for="nama_lengkap" class="form-label">Nama Lengkap</label><input type="text" class="form-control" name="nama_lengkap" required></div>
                        <div class="col-12"><label for="nomer_wa" class="form-label">Nomor WhatsApp</label><input type="tel" class="form-control" name="nomer_wa" placeholder="08xxxxxxxxxx" required></div>
                        <div class="col-sm-6"><label for="tanggal_checkin" class="form-label">Tanggal Check-in</label><input type="date" class="form-control" name="tanggal_checkin" required></div>
                        <div class="col-sm-6"><label for="tanggal_checkout" class="form-label">Tanggal Check-out</label><input type="date" class="form-control" name="tanggal_checkout" required></div>
                        <div class="col-12"><label for="catatan" class="form-label">Catatan (Penyakit atau Alergi)</label><textarea class="form-control" name="catatan" rows="3"></textarea></div>
                    </div>
                    <hr class="my-4">
                    <h4 class="mb-3">Metode Pembayaran</h4>
                    <div class="my-3">
                        <div class="form-check"><input id="qris" name="metode_pembayaran" type="radio" value="QRIS" class="form-check-input" required><label class="form-check-label" for="qris">QRIS</label></div>
                        <div class="form-check"><input id="cash" name="metode_pembayaran" type="radio" value="Cash" class="form-check-input" required><label class="form-check-label" for="cash">Cash (Bayar di Tempat)</label></div>
                    </div>
                    <div id="qris-payment-info" class="text-center my-4 d-none">
                        <p>Silakan pindai QR code di bawah ini untuk membayar:</p>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=ContohPembayaranGowesNgacir" alt="QR Code Pembayaran" class="img-fluid">
                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Konfirmasi Pemesanan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const checkoutData = JSON.parse(sessionStorage.getItem('checkout'));
            if (!checkoutData) {
                alert('Data pesanan tidak ditemukan. Silakan ulangi dari halaman detail rute.');
                window.location.href = '/rutelist';
                return;
            }
            const summaryContainer = document.getElementById('summary-container');
            const summaryTotal = document.getElementById('summary-total');
            const summaryHtml = `
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div><h6 class="my-0">${checkoutData.routeName}</h6><small class="text-muted">${checkoutData.summary.paket}</small></div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div><small class="text-muted">Add-on Hotel</small></div><span class="text-muted">${checkoutData.summary.hotel}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div><small class="text-muted">Add-on Restoran</small></div><span class="text-muted">${checkoutData.summary.resto}</span>
                </li>`;
            summaryContainer.insertAdjacentHTML('afterbegin', summaryHtml);
            summaryTotal.textContent = 'Rp ' + checkoutData.total.toLocaleString('id-ID');

            // INI BAGIAN PALING PENTING
            document.getElementById('bundle_id_input').value = checkoutData.bundleId;
            document.getElementById('detail_pesanan_input').value = JSON.stringify(checkoutData.summary);
            document.getElementById('total_harga_input').value = checkoutData.total;

            const qrisInfo = document.getElementById('qris-payment-info');
            document.querySelectorAll('input[name="metode_pembayaran"]').forEach(radio => {
                radio.addEventListener('change', (e) => {
                    qrisInfo.classList.toggle('d-none', e.target.value !== 'QRIS');
                });
            });
        });
    </script>
</body>
</html>