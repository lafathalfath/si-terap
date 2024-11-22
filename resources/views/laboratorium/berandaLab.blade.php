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
        <h1 class="page-title">Peta Sebaran Identifikasi dan Inventarisasi SIP 
        </h1>

        <!-- Leaflet Map -->
        <div id="map"></div> <!-- Map Container -->

        <!-- Filter Section -->
        <div class="filter-container">
            <label for="bpsip">BPSIP:</label>
            <select id="bpsip">
                <option value="">Pilih BPSIP</option>
                <option value="bpsip1">BPSIP 1</option>
                <option value="bpsip2">BPSIP 2</option>
                <!-- Tambahkan pilihan lainnya sesuai kebutuhan -->
            </select>

            <label for="year">Tahun:</label>
            <input type="number" id="year" placeholder="Tahun" />

            <button type="button" onclick="filterData()">Filter</button>
        </div>

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
  </tbody>
</table>
    </div>

    <!-- Add Leaflet JS after the map -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
    var map = L.map('map').setView([-2.5489, 118.0149], 5); // Koordinat Indonesia

        // Add OpenStreetMap tiles
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Example markers in Jawa Barat
        var provinces = [
          { name: "Aceh", coords: [4.695135, 96.749397] },
        { name: "Sumatera Utara", coords: [3.585242, 98.675598] },
        { name: "Sumatera Barat", coords: [-0.789275, 100.650558] },
        { name: "Riau", coords: [0.507068, 101.447777] },
        { name: "Jawa Barat", coords: [-6.917464, 107.619125] },
        { name: "Jawa Tengah", coords: [-7.566298, 110.831787] },
        { name: "Jawa Timur", coords: [-7.250445, 112.768845] },
        { name: "Kalimantan Timur", coords: [-0.502106, 117.153709] },
        { name: "Sulawesi Selatan", coords: [-5.147665, 119.432732] },
        { name: "Papua", coords: [-4.269928, 138.080353] }
        ];

        // Add markers for each city with popups
        provinces.forEach(city => {
            var marker = L.marker(city.coords).addTo(map);
            marker.bindPopup(`<b>${city.name}</b><br>Ini adalah lokasi ${city.name}.`).openPopup();
        });

        // Data kegiatan (dummy data)
        const kegiatanData = [
            {
        no: 1,
        bpsip: "BPSIP SUMSEL",
        jenisLab: "Laboratorium Pengujian Kimia Tanah dan Mutu Beras",
        jenisAnalisis: "Analisa Kimia Tanah Rutin dan Analisa Mutu Beras",
        metodeAnalisis: "Kolorimetri/Pewarnaan",
        analisis: "Tidak ada",
        kompetensiPersonal: "Belum ada",
        namaPelatihan: "Pelatihan Pemahaman SNI ISO/IEC 17025:2017",
        waktu: "2023"
    },
    {
        no: 2,
        bpsip: "BPSIP JAWA BARAT",
        jenisLab: "Laboratorium Analisa Pupuk",
        jenisAnalisis: "Analisa Nitrogen dan Fosfat",
        metodeAnalisis: "Spektrofotometri dan Titrasi",
        analisis: "Nitrogen total, Fosfat total",
        kompetensiPersonal: "Ada",
        namaPelatihan: "Pelatihan Analisa Pupuk dan Tanah",
        waktu: "2022"
    },
    {
        no: 3,
        bpsip: "BPSIP JAWA TIMUR",
        jenisLab: "Laboratorium Mutu Pangan",
        jenisAnalisis: "Analisa Kimia Pangan",
        metodeAnalisis: "Kromatografi Gas dan Cair",
        analisis: "Kadar Air, Protein, Lemak, dan Karbohidrat",
        kompetensiPersonal: "Tidak ada",
        namaPelatihan: "Pelatihan Penerapan ISO 17025",
        waktu: "2021"
    },
    {
        no: 4,
        bpsip: "BPSIP SUMATERA BARAT",
        jenisLab: "Laboratorium Uji Sampel Air",
        jenisAnalisis: "Analisa Parameter Fisika dan Kimia Air",
        metodeAnalisis: "Spektrofotometri, TDS, dan pH Meter",
        analisis: "TSS, COD, BOD, dan pH",
        kompetensiPersonal: "Ada",
        namaPelatihan: "Pelatihan Pengendalian Mutu Air",
        waktu: "2023"
    },
    {
        no: 5,
        bpsip: "BPSIP KALIMANTAN TENGAH",
        jenisLab: "Laboratorium Uji Kesuburan Tanah",
        jenisAnalisis: "Analisa Unsur Hara Makro dan Mikro",
        metodeAnalisis: "Titrasi dan Spektrofotometri",
        analisis: "Nitrogen, Fosfat, Kalium, Magnesium, dan Kalsium",
        kompetensiPersonal: "Ada",
        namaPelatihan: "Workshop Penilaian Kesuburan Tanah",
        waktu: "2020"
    }
        ];

        function filterData() {
            const bpsip = document.getElementById('bpsip').value;
            const year = document.getElementById('year').value;
            const sipType = document.getElementById('sip-type').value;

            const filteredData = kegiatanData.filter(item => {
                return (
                    (bpsip === '' || item.bpsip === bpsip) &&
                    (year === '' || item.tahun === parseInt(year)) &&
                    (sipType === '' || item.type === sipType)
                );
            });

            displayData(filteredData);
        }

        function displayData(data) {
            const tableBody = document.querySelector('#kegiatan-table tbody');
            tableBody.innerHTML = ''; 

            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.no}</td>
                    <td>${item.bpsip}</td>
                    <td>${item.jenisLab}</td>
                    <td>${item.jenisAnalisis}</td>
                    <td>${item.metodeAnalisis}</td>
                    <td>${item.analisis}</td>
                    <td>${item.kompetensiPersonal}</td>
                    <td>${item.namaPelatihan}</td>
                    <td>${item.waktu}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        displayData(kegiatanData);
    </script>
@endsection
