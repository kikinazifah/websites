<x-layout>


    {{-- content Main --}}
    <div class="relative z-10">
        <div class="max-w-5xl mx-auto px-6 py-20">
        </div>
    </div>

    {{-- MAP SECTION: gunakan layout saja, taruh di bawah hero/cards --}}
    <div class="relative z-10 max-w-6xl mx-auto px-6 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sidebar -->
            <aside class="lg:col-span-1 bg-white rounded shadow p-4">
                <h2 class="font-semibold mb-2">Titik Donasi</h2>
                <div class="space-y-2 overflow-auto max-h-[60vh]">
                    @foreach ($locations as $loc)
                        <div class="p-2 border rounded hover:bg-green-50 cursor-pointer" data-lat="{{ $loc['lat'] }}"
                            data-lng="{{ $loc['lng'] }}">
                            <div class="font-medium">{{ $loc['name'] }}</div>
                            <div class="text-xs text-gray-600">{{ $loc['address'] }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <button id="locateBtn" class="w-full bg-blue-600 text-white py-2 rounded">Temukan Lokasiku</button>
                    <p id="locStatus" class="text-sm text-gray-600 mt-2">Klik tombol untuk membagikan lokasi (HTTPS /
                        localhost).</p>
                </div>
            </aside>

            <!-- Map -->
            <main class="lg:col-span-2 bg-white rounded shadow p-4">
                <div id="map" class="w-full" style="height: 68vh; min-height: 420px; border-radius: 8px;"></div>
            </main>
        </div>
    </div>

    {{-- Load Leaflet CSS/JS (letakkan di view karena layout belum include) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const LOCATIONS = @json($locations);

        // Inisialisasi peta
        const defaultCenter = LOCATIONS.length ? [LOCATIONS[0].lat, LOCATIONS[0].lng] : [-6.200000, 106.816666];
        const map = L.map('map').setView(defaultCenter, 13);

        // Tile OpenStreetMap (gratis)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // donation markers
        const donationLayer = L.layerGroup().addTo(map);
        LOCATIONS.forEach(loc => {
            const m = L.marker([loc.lat, loc.lng]).addTo(donationLayer);
            m.bindPopup(
                `<strong>${loc.name}</strong><br>${loc.address}<br><small>Menerima: ${loc.items ?? '-'}</small>`
                );
        });

        // Marker & circle untuk lokasi pengguna
        let userMarker = null;
        let userCircle = null;

        function onLocationFound(e) {
            const latlng = e.latlng;
            const accuracy = e.accuracy || 20;

            if (userMarker) map.removeLayer(userMarker);
            if (userCircle) map.removeLayer(userCircle);

            userMarker = L.marker(latlng).addTo(map).bindPopup('Lokasi Anda').openPopup();
            userCircle = L.circle(latlng, {
                radius: accuracy
            }).addTo(map);

            map.setView(latlng, 15);
            document.getElementById('locStatus').textContent = 'Lokasi terdeteksi (akurasi ≈ ' + Math.round(accuracy) +
                ' m).';
        }

        function onLocationError(e) {
            document.getElementById('locStatus').textContent = 'Gagal mendapatkan lokasi: ' + e.message;
        }

        // Tombol cari lokasi
        document.getElementById('locateBtn').addEventListener('click', () => {
            if (!navigator.geolocation) {
                document.getElementById('locStatus').textContent = 'Browser Anda tidak mendukung Geolocation.';
                return;
            }

            document.getElementById('locStatus').textContent = 'Meminta izin lokasi...';

            map.locate({
                setView: false,
                maxZoom: 16,
                enableHighAccuracy: true
            });
            map.once('locationfound', onLocationFound);
            map.once('locationerror', onLocationError);
        });

        // Klik pada sidebar -> center ke lokasi donasi
        document.querySelectorAll('[data-lat]').forEach(el => {
            el.addEventListener('click', () => {
                const lat = parseFloat(el.dataset.lat);
                const lng = parseFloat(el.dataset.lng);
                map.setView([lat, lng], 15);
            });
        });
    </script>

    {{-- optional: link css custom (green-drop.css) jika ada --}}
    {{-- <link href="{{ asset('css/green-drop.css') }}" rel="stylesheet"> --}}
</x-layout>
