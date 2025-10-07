<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <title>Pembayaran | GOWES NGACIR</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Bootstrap CSS & Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .summary-sticky {
      position: sticky;
      top: 90px;
    }

    .qr-box {
      background: #fff;
      border-radius: 1rem;
      padding: 1rem;
    }

    .qr-img {
      width: 100%;
      max-width: 260px;
      height: auto;
      display: block;
      margin: 0 auto;
    }

    .muted {
      color: #6c757d;
    }
  </style>
</head>

<body>
  {{-- Navbar sederhana --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">GOWES NGACIR</a>
    </div>
  </nav>

  <main class="container py-4">
    <div class="row g-4">
      {{-- Kiri: Form Pembayaran --}}
      <div class="col-lg-8">
        <h2 class="mb-3">Form Pembayaran</h2>

        {{-- Info ringkas rute (opsional) --}}
        <div class="alert alert-light border d-flex align-items-center" id="routeInfo" style="display:none;">
          <i class="bi bi-bicycle me-2"></i>
          <div>
            <div class="fw-semibold" id="routeName">Gunung Pancar Loop</div>
            <small class="text-muted" id="routeMeta">Bogor, Jawa Barat • 24 km • +620 m</small>
          </div>
        </div>

        {{-- Form (frontend only). Saat sudah ada backend, arahkan action ke route proses. --}}
        <form id="formPembayaran" class="row g-3" autocomplete="on">
          @csrf {{-- kalau nanti submit ke server --}}

          <div class="col-md-6">
            <label for="namaPemesan" class="form-label">Nama Pemesan</label>
            <input type="text" class="form-control" id="namaPemesan" name="nama" placeholder="Nama lengkap" required>
          </div>

          <div class="col-md-6">
            <label for="jumlahOrang" class="form-label">Berapa Orang</label>
            <input type="number" min="1" class="form-control" id="jumlahOrang" name="orang" value="1" required>
          </div>

          <div class="col-md-6">
            <label for="tglCheckin" class="form-label">Tanggal Check-in</label>
            <input type="date" class="form-control" id="tglCheckin" name="checkin" required>
          </div>

          <div class="col-md-6">
            <label for="tglCheckout" class="form-label">Tanggal Check-out</label>
            <input type="date" class="form-control" id="tglCheckout" name="checkout" required>
          </div>

          <div class="col-12">
            <label class="form-label d-block mb-2">Metode Pembayaran</label>
            <div class="d-flex gap-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="metode" id="payQris" value="qris" checked>
                <label class="form-check-label" for="payQris">
                  <i class="bi bi-qr-code me-1"></i>QRIS
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="metode" id="payCash" value="cash">
                <label class="form-check-label" for="payCash">
                  <i class="bi bi-cash-stack me-1"></i>Cash
                </label>
              </div>
            </div>
            <div class="form-text">QRIS: tampilkan kode QR & bayar via e-wallet/bank. Cash: bayar di lokasi.</div>
          </div>

          {{-- Hidden checkout info (diisi dari sessionStorage bila tersedia) --}}
          <input type="hidden" id="orderTotal" name="total" value="0">
          <input type="hidden" id="orderId" name="order_id" value="">

          <div class="col-12">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-credit-card me-1"></i>Bayar
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary ms-2">Kembali</a>
          </div>
        </form>
      </div>

      {{-- Kanan: Ringkasan Pesanan --}}
      <div class="col-lg-4">
        <div class="card shadow summary-sticky">
          <div class="card-body">
            <h5 class="card-title">Ringkasan Pesanan</h5>
            <ul class="list-unstyled small mb-3" id="summaryList">
              <li class="d-flex justify-content-between"><span>Hotel</span><span id="sumHotel">—</span></li>
              <li class="d-flex justify-content-between"><span>Restoran</span><span id="sumResto">—</span></li>
              <li class="d-flex justify-content-between"><span>Paket</span><span id="sumPaket">—</span></li>
              <li class="d-flex justify-content-between"><span>Orang</span><span id="sumOrang">1</span></li>
              <li class="d-flex justify-content-between"><span>Check-in</span><span id="sumIn">—</span></li>
              <li class="d-flex justify-content-between"><span>Check-out</span><span id="sumOut">—</span></li>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
              <strong>Total</strong>
              <strong id="sumTotal" class="text-success">IDR 0</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  {{-- Modal QRIS --}}
  <div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="qrisModalLabel"><i class="bi bi-qr-code me-2"></i>QRIS Pembayaran</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-3">
            <div class="muted small">Order ID: <span id="qrOrderId">—</span></div>
            <div class="fw-semibold fs-5 mt-1" id="qrAmount">IDR 0</div>
          </div>
          <div class="qr-box shadow-sm">
            {{-- QR contoh (dummy). Ganti ke QR dinamis saat backend siap. --}}
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=280x280&data=GOWES-NGACIR-DEMO" alt="QRIS"
              class="qr-img" id="qrImage">
          </div>
          <div class="mt-3 text-center muted">
            Scan 1x dengan e-wallet/banking Anda. Setelah berhasil, klik tombol konfirmasi.
          </div>
        </div>
        <div class="modal-footer">
          <button id="btnConfirmPaid" type="button" class="btn btn-success">
            <i class="bi bi-check2-circle me-1"></i>Saya sudah scan & bayar
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // ===== Helper =====
    const rupiah = (v) => 'IDR ' + Number(v || 0).toLocaleString('id-ID');
    const todayStr = () => new Date().toISOString().slice(0, 10);

    function parseCheckout(raw) {
      let c = null;
      try { c = JSON.parse(raw || 'null'); } catch { c = null; }
      if (!c) return null;

      // dukung shape baru { package: {...}, addons: {...}, total }
      const pkg = c.package || {};
      const addons = c.addons || {};

      const participants = Number(pkg.participants || c.participants || 1);
      const perPerson = Number(pkg.perPerson || c.perPerson || 0);
      const pkgLabel = pkg.label || c.paket || '—';

      const hotelName = (addons.hotel ?? c.hotel) ?? '—';
      const hotelPrice = Number(addons.hotelPrice ?? c.hotelPrice ?? 0); // flat per malam

      const restoName = (addons.resto ?? c.resto) ?? '—';
      const restoPP = Number(addons.restoPricePerPerson ?? c.restoPricePerPerson ?? 0); // per orang

      const pkgSubtotal = (perPerson * participants) || 0;
      const restoSubtotal = (restoPP * participants) || 0;
      const hotelSubtotal = hotelPrice || 0;

      // total fallback: hitung ulang jika c.total tidak ada
      const total = Number(c.total ?? (pkgSubtotal + restoSubtotal + hotelSubtotal));

      return {
        routeName: c.routeName || '—',
        pkg: { label: pkgLabel, perPerson, participants, subtotal: pkgSubtotal },
        hotel: { name: hotelName, price: hotelPrice, subtotal: hotelSubtotal },
        resto: { name: restoName, perPerson: restoPP, subtotal: restoSubtotal },
        total
      };
    }

    // Render ringkasan ke DOM
    function renderSummary(model) {
      const sumHotel = document.getElementById('sumHotel');
      const sumResto = document.getElementById('sumResto');
      const sumPaket = document.getElementById('sumPaket');
      const sumTotal = document.getElementById('sumTotal');
      const orderTotal = document.getElementById('orderTotal');

      sumPaket.textContent = `${model.pkg.label} — ${rupiah(model.pkg.perPerson)} × ${model.pkg.participants} = ${rupiah(model.pkg.subtotal)}`;

      sumHotel.textContent = (model.hotel.name && model.hotel.name !== '—')
        ? `${model.hotel.name} — ${rupiah(model.hotel.subtotal)}`
        : '—';

      sumResto.textContent = (model.resto.name && model.resto.name !== '—')
        ? `${model.resto.name} — ${rupiah(model.resto.perPerson)} × ${model.pkg.participants} = ${rupiah(model.resto.subtotal)}`
        : '—';

      sumTotal.textContent = rupiah(model.total);
      orderTotal.value = model.total;
    }
    // ===== Ambil & render checkout =====
  let checkoutModel = parseCheckout(sessionStorage.getItem('checkout'));

  (function init() {
    const routeInfo = document.getElementById('routeInfo');
    const routeName = document.getElementById('routeName');

    const inEl  = document.getElementById('tglCheckin');
    const outEl = document.getElementById('tglCheckout');
    inEl.value  = todayStr();
    outEl.value = todayStr();

    // Generate Order ID (demo)
    const orderId = document.getElementById('orderId');
    orderId.value = 'GN-' + Math.random().toString(36).slice(2, 8).toUpperCase();

    // Prefill jumlah orang dari checkout (kalau ada)
    const jumlahOrang = document.getElementById('jumlahOrang');
    if (checkoutModel?.pkg?.participants) {
      jumlahOrang.value = checkoutModel.pkg.participants;
    }

    // Tampilkan info rute & ringkasan
    if (checkoutModel) {
      routeInfo.style.display = 'flex';
      routeName.textContent = checkoutModel.routeName || '—';
      renderSummary(checkoutModel);
    } else {
      // fallback kosong
      renderSummary({
        routeName: '—',
        pkg:   { label: '—', perPerson: 0, participants: Number(jumlahOrang.value||1), subtotal: 0 },
        hotel: { name: '—', price: 0, subtotal: 0 },
        resto: { name: '—', perPerson: 0, subtotal: 0 },
        total: 0
      });
    }
  })();

    // ===== Update summary orang & tanggal dari form =====
    const jumlahOrang = document.getElementById('jumlahOrang');
    const tglCheckin = document.getElementById('tglCheckin');
    const tglCheckout = document.getElementById('tglCheckout');
    const sumOrang = document.getElementById('sumOrang');
    const sumIn = document.getElementById('sumIn');
    const sumOut = document.getElementById('sumOut');

    const refreshSummary = () => {
      const jumlahOrang = document.getElementById('jumlahOrang');
  const tglCheckin  = document.getElementById('tglCheckin');
  const tglCheckout = document.getElementById('tglCheckout');
  const sumOrang    = document.getElementById('sumOrang');
  const sumIn       = document.getElementById('sumIn');
  const sumOut      = document.getElementById('sumOut');

  function recalcWithParticipants(p) {
    if (!checkoutModel) return;

    const participants = Number(p || 1);

    // Hitung ulang subtotal & total
    checkoutModel = {
      ...checkoutModel,
      pkg:   { ...checkoutModel.pkg, participants, subtotal: checkoutModel.pkg.perPerson * participants },
      resto: { ...checkoutModel.resto, subtotal: checkoutModel.resto.perPerson * participants },
    };
    const newTotal = checkoutModel.pkg.subtotal + checkoutModel.resto.subtotal + checkoutModel.hotel.subtotal;
    checkoutModel.total = newTotal;

    renderSummary(checkoutModel);
  }

  const refreshSummary = () => {
    const people = Number(jumlahOrang.value || 1);
    sumOrang.textContent = people;
    sumIn.textContent  = tglCheckin.value  || '—';
    sumOut.textContent = tglCheckout.value || '—';
    recalcWithParticipants(people);
  };

  [jumlahOrang, tglCheckin, tglCheckout].forEach(el => el.addEventListener('change', refreshSummary));
  refreshSummary();

    // ===== Handler submit pembayaran =====
    const form = document.getElementById('formPembayaran');
    form.addEventListener('submit', (e) => {
      e.preventDefault();

      const nama = document.getElementById('namaPemesan').value.trim();
      const orang = Number(jumlahOrang.value || 1);
      const cin = tglCheckin.value;
      const cout = tglCheckout.value;
      const total = Number(document.getElementById('orderTotal').value || 0);
      const metode = document.querySelector('input[name="metode"]:checked')?.value || 'qris';

      // Validasi sederhana
      if (!nama) return alert('Nama pemesan wajib diisi.');
      if (!cin || !cout) return alert('Tanggal check-in & check-out wajib diisi.');
      if (new Date(cin) > new Date(cout)) return alert('Tanggal check-out harus setelah check-in.');

      // Simpan ringkasan untuk halaman sukses
      const orderId = document.getElementById('orderId').value;
  const baseCheckout = parseCheckout(sessionStorage.getItem('checkout'));

  const successPayload = {
    orderId,
    nama,
    orang,
    checkin: cin,
    checkout: cout,
    metode,
    // breakdown harga:
    package: {
      label: baseCheckout?.pkg?.label || '—',
      perPerson: baseCheckout?.pkg?.perPerson || 0,
      participants: orang,
      subtotal: (baseCheckout?.pkg?.perPerson || 0) * orang
    },
    hotel: {
      name: baseCheckout?.hotel?.name || '—',
      price: baseCheckout?.hotel?.price || 0,
      subtotal: baseCheckout?.hotel?.subtotal || 0
    },
    resto: {
      name: baseCheckout?.resto?.name || '—',
      perPerson: baseCheckout?.resto?.perPerson || 0,
      subtotal: (baseCheckout?.resto?.perPerson || 0) * orang
    },
    total: Number(document.getElementById('orderTotal').value || 0),
    routeName: baseCheckout?.routeName || '—'
  };
  sessionStorage.setItem('order_success', JSON.stringify(successPayload));

      if (metode === 'qris') {
        // Tampilkan modal QR otomatis
        const qrAmount = document.getElementById('qrAmount');
        const qrOrderId = document.getElementById('qrOrderId');
        const qrImg = document.getElementById('qrImage');

        qrAmount.textContent = rupiah(total);
        qrOrderId.textContent = orderId;

        // Ganti data QR dengan payload unik (demo)
        const qrData = encodeURIComponent(`GOWES-NGACIR|OID=${orderId}|AMT=${total}`);
        qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=280x280&data=${qrData}`;

        const modal = new bootstrap.Modal(document.getElementById('qrisModal'));
        modal.show();
      } else {
        // Cash → langsung sukses (anggap bayar di lokasi)
        // GANTI URL di bawah sesuai route detail pesanan kamu
        window.location.href = "{{ url('/pesanan/sukses') }}";
      }
    });

    // ===== Simulasi konfirmasi setelah scan (QRIS) =====
    document.getElementById('btnConfirmPaid').addEventListener('click', () => {
      // Tutup modal lalu redirect
      const modalEl = document.getElementById('qrisModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      modal?.hide();

      // GANTI URL di bawah sesuai route detail pesanan kamu
      window.location.href = "{{ url('/pesanan/sukses') }}";
    });
  </script>
</body>

</html>