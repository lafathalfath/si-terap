@extends('layouts.header_navbar_footer_lab')

@section('content')
    <style>
        .content.stylish-content {
            padding: 20px;
        }

        .page-title {
            text-align: center;
            font-size: 2em;
            color: #00452C;
            margin: 20px 0;
        }

        .stylish-button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 12px 25px;
            color: white;
            background-color: #00452C;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1em;
        }

        .stylish-button:hover {
            background-color: #006633;
        }

        .stylish-content {
            margin: 0 auto;
            max-width: 1200px;
            padding: 40px 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        #map {
            height: 400px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #00452C;
            color: white;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        .filter-container select, .filter-container input {
            padding: 8px;
            font-size: 1em;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .filter-container button {
            padding: 8px 15px;
            background-color: #00452C;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .filter-container button:hover {
            background-color: #006633;
        }
    </style>

    <div class="content stylish-content">
        <h1 class="page-title">Peta Sebaran Laboratorium Pengujian 
        </h1>

        <!-- Leaflet Map -->
        <div id="map"></div> <!-- Map Container -->

        <!-- Filter Section -->
        <form class="filter-container">
            <label for="bpsip">BPSIP:</label>
            <select id="bpsip" name="bsip_id">
                <option value="">Semua BPSIP</option>
                @foreach ($bsip as $bs)
                    <option value="{{ $bs->id }}" {{ request()->bsip_id == $bs->id ? 'selected' : '' }}>{{ $bs->name }}</option>
                @endforeach
            </select>

            <label for="year">Tahun:</label>
            <select id="year" name="tahun">
                <option value="">Semua Tahun</option>
                @for ($i = now()->year; $i >= 2000; $i--)
                    <option value="{{ $i }}" {{ request()->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>

            <button type="submit">Filter</button>
        </form>

        <!-- Kegiatan Table -->
        <h2>Data Lab</h2>
<table border="1" id="kegiatan-table">
  <thead>
    <tr>
      <th rowspan="3">No</th>
      <th rowspan="3">Nama BPSIP</th>
      <th rowspan="3">Jenis Laboratorium</th>
      <th colspan="2">Ruang Lingkup Analisis</th>
      <th colspan="4">Dukungan SDM Laboratorium</th>
    </tr>
    <tr>
      <th rowspan="2">Jenis Analisis</th>
      <th rowspan="2">Metode Analisis</th>
      <th rowspan="2">Analisis</th>
      <th rowspan="2">Kompetensi Personal</th>
      <th colspan="2">Pelatihan</th>
    </tr>
    <tr>
      <th>Nama/Jenis</th>
      <th>Waktu</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($lab as $l)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $l->bsip->name }}</td>
            <td>{{ $l->jenis_lab->name }}</td>
            <td>{{ $l->jenis_analisis }}</td>
            <td>{{ $l->metode_analisis }}</td>
            <td>{{ $l->analisis }}</td>
            <td>{{ $l->kompetensi_personal }}</td>
            <td>{{ $l->nama_pelatihan }}</td>
            <td>{{ $l->tahun }}</td>
        </tr>
    @endforeach
  </tbody>
</table>
    </div>

    <!-- Add Leaflet JS after the map -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
var map = L.map('map').setView([-2.5489, 118.0149], 5);

// Add OpenStreetMap tiles
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// Example markers in Jawa Barat
var provinces = [
    { id: 1, name: "Aceh", coords: [4.695135, 96.749397] },
    { id: 2, name: "Sumatera Utara", coords: [3.585242, 98.675598] },
    { id: 3, name: "Sumatera Barat", coords: [-0.789275, 100.650558] },
    { id: 4, name: "Riau", coords: [0.507068, 101.447777] },
    { id: 5, name: "Jawa Barat", coords: [-6.917464, 107.619125] },
    { id: 6, name: "Jawa Tengah", coords: [-7.566298, 110.831787] },
    { id: 7, name: "Jawa Timur", coords: [-7.250445, 112.768845] },
    { id: 8, name: "Kalimantan Timur", coords: [-0.502106, 117.153709] },
    { id: 9, name: "Sulawesi Selatan", coords: [-5.147665, 119.432732] },
    { id: 10, name: "Papua", coords: [-4.269928, 138.080353] }
];

// Add markers for each city with popups and redirect using ID
provinces.forEach(province => {
    var marker = L.marker(province.coords).addTo(map);
    marker.bindPopup(`<b>${province.name}</b><br><a href='/lab-pengujian/laboratoriumview/${province.id}'>Lihat Detail</a>`);

    // marker.on('click', function() {
    //     window.location.href = `/lab-pengujian/laboratoriumview/${province.id}`;
    // });
});

    </script>
@endsection

