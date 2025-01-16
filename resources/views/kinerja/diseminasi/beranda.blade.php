@extends('layouts.layoutKinerja')

@section('content')
<style>
    .maincontainer {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    h1, h2, h3 {
        text-align: center;
        color: #006400;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 26px;
        font-weight: bold;
    }

    h2 {
        font-size: 18px;
    }

    h3 {
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 20px; 
    }

    .filter-container {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 10px;
    margin: 20px 0;
    }

    .filter-label {
    font-size: 16px;
    font-weight: bold;
    color: #00452C;
    margin-right: 8px;
    }

    .filter-input {
    width: 200px;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    }

    .filter-group {
    display: inline-block;
    }

    .page-title {
        font-size: 18px;
        font-weight: bold;
        color: #00452C;
    }

    .btn-filter {
        padding: 10px;
        background-color: #009144;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-filter:hover {
        background-color: #006400;
    }

    .infographics {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Membagi grid menjadi 3 kolom */
    gap: 20px; /* Jarak antar card */
    margin: 30px 0;
    }

    .card {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }


    .infographic {
        text-align: center;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        min-height: 200px;
    }

    .icon {
        font-size: 36px;
        color: #009144;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
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

    .button-container {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .btn-form {
        padding: 10px 20px;
        background-color: #009144;
        color: #fff;
        font-size: 16px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-form:hover {
        background-color: #006400;
    }

    .content.stylish-content {
        padding: 20px;
    }

    .stylish-button {
    display: block !important;
    width: fit-content;
    margin: 10px auto;
    padding: 10px 20px;
    color: white;
    background-color: #006633;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    font-size: 1em;
    z-index: 10; /* Set z-index lebih rendah dari navbar */
    position: sticky;
    top: 100px; /* Sesuaikan dengan tinggi navbar agar tombol tidak tertutup */
    }

    .stylish-button:hover {
        background-color: #009144;
    }
    .stylish-content {
        margin: 0 auto;
        max-width: 1200px;
        padding: 20px 10px; /* Mengurangi padding */
        background-color: #ffffff;
    }

    .map-container {
        padding: 20px; 
        background-color: #ffffff;
        border-radius: 0px; 
        margin-bottom: 10px;
    }

    #mapindo {
        height: 500px;
        width: 100%;
        /* max-width: 800px; */
        margin: 0 auto;
        margin-bottom: 50px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 10px;
        border-radius: 10px;
    }

    .loading {
        margin-top: 10em;
        text-align: center;
        color: gray;
    }

    .highcharts-title{
        opacity: 0% !important;
    } 

    .highcharts-background{
        fill: #f4f4f4 !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5) !important; 
    }
    .icon img {
        width: 50px; 
        height: 50px; 
        margin: 0 auto; 
        display: block; 
    }
    .paginate-item {
        border: 1px solid gray;
        border-radius: 3px;
        padding: 0 5px;
        text-decoration: none;
        color: black;
    }

    .paginate-item:hover {
        border: 1px solid gray;
        background-color: lightgray;
        border-radius: 3px;
        padding: 0 5px;
        text-decoration: none;
        color: black;
    }
    
    .paginate-button {
        /* border: 1px solid black; */
        background-color: #3d943d;
        color: white;
        padding: 0 5px;
        text-decoration: none;
        border: 0px solid gray;
        border-radius: 3px;
    }

    .paginate-button:hover {
        /* border: 1px solid black; */
        background-color: #51ac51;
        color: white;
        padding: 0 5px;
        text-decoration: none;
        border: 0px solid gray;
        border-radius: 3px;
    }
    
    .disabled-paginate {
        pointer-events: none;
        background-color: #cacaca;
        color: white;
        border: none;
    }
    
    .active-paginate {
        pointer-events: none;
        background-color: #00452C;
        color: white;
        border: none;
    }
</style>

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <div class="maincontainer">
        <h1>Dashboard Diseminasi Standar Instrumen Pertanian</h1>

        <div class="filter-container" style="margin-bottom: 20px; text-align: left; display: flex; align-items: center;">
                    <label for="sasaran-diseminasi" class="page-title" style="margin-right: 10px;">
                        Peta Sebaran Provinsi
                    </label>
                    <div class="filter-group" style="display: inline-block;">
                        <select id="sasaran-diseminasi" class="filter-input" style="width: 200px;">
                            <option value="">Semua Sasaran</option>
                            <option value="petani">Petani</option>
                            <option value="umkm">UMKM</option>
                            <option value="pelaku-usaha">Pelaku Usaha</option>
                            <option value="koperasi">Koperasi</option>
                            <option value="bumdes-bumd">BUMDes/BUMD</option>
                        </select>
                    </div>
                </div>

        <div class="content stylish-content">
            <h1 class="page-title">Peta Sebaran Diseminasi Standar Instrumen Pertanian</h1>    
            <div class="map-container">
            <div class="map">      
                <div id="mapindo"></div>
                <a href="{{route('diseminasi.form_sektor')}}" class="stylish-button">Isi Form</a>
            </div>
        </div>

            <!-- Jumlah Peserta -->
            <h3>Jumlah Peserta</h3>
            <div class="infographic">
                <h2>Total Peserta</h2>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <p>{{ $jumlah_sasaran }}</p>
            </div>

            
            <!-- Sasaran Diseminasi -->
            <h3>Sasaran Diseminasi</h3>
            <div class="infographics">
                <!-- Target dan Pencapaian -->
                <div class="infographic">
                    <h2>Petani</h2>
                    <div class="icon"><i class="fas fa-tractor"></i></div>
                    <p>Target: {{ $sasaran->petani }}</p>
                    <p>Pencapaian: 50 (83%)</p>
                </div>
                <div class="infographic">
                    <h2>UMKM</h2>
                    <div class="icon"><i class="fas fa-store"></i></div>
                    <p>Target: {{ $sasaran->umkm }}</p>
                    <p>Pencapaian: 30 (75%)</p>
                </div>
                <div class="infographic">
                    <h2>Pelaku Usaha</h2>
                    <div class="icon"><i class="fas fa-briefcase"></i></div>
                    <p>Target: {{ $sasaran->pelaku_usaha }}</p>
                    <p>Pencapaian: 20 (67%)</p>
                </div>
                <div class="infographic">
                    <h2>Koperasi</h2>
                    <div class="icon"><i class="fas fa-handshake"></i></div>
                    <p>Target: {{ $sasaran->koperasi }}</p>
                    <p>Pencapaian: 15 (75%)</p>
                </div>
                <div class="infographic">
                    <h2>BUMDes/BUMD</h2>
                    <div class="icon"><i class="fas fa-building"></i></div>
                    <p>Target: {{ $sasaran->bumd }}</p>
                    <p>Pencapaian: 5 (50%)</p>
                </div>
            </div>

            <!-- Filter Form -->
            <form action="{{ route('diseminasi_beranda') }}" class="filter-container">
                <div class="filter-group">
                    <select id="bpsip" name="bsip_id" class="filter-input">
                        <option value="">BPSIP</option>
                        @foreach ($diseminasi as $ds)
                            <option value="{{ $ds->bsip_id }}" {{ request()->bsip_id == $ds->bsip_id ? 'selected' : '' }}>{{ $ds->bsip->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <input id="tanggal" type="month" name="tanggal" value="{{ request()->tanggal }}" class="filter-input">
                </div>

                <div class="filter-group">
                    <select id="sip" name="sip_id" class="filter-input">
                        <option value="">SIP</option>
                        @foreach ($sip as $sp)
                            <option value="{{ $sp->id }}" {{ request()->sip_id == $sp->id ? 'selected' : '' }}>{{ $sp->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <select id="jenis-standar" name="jenis_standard_id" class="filter-input">
                        <option value="">Jenis Standar</option>
                        @foreach ($jenis_standard as $js)
                            <option value="{{ $js->id }}" {{ request()->jenis_standard_id == $js->id ? 'selected' : '' }}>{{ $js->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <button type="submit" class="btn-filter">Filter</button>
                </div>
            </form>

            <!-- Kegiatan Table -->
            <table id="kegiatan-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>BPSIP</th>
                        <th>Tanggal</th>
                        <th>SIP</th>
                        <th>Metode</th>
                        <th>Sasaran</th>
                        <th>Jumlah Sasaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diseminasi as $ds)
                        <tr>
                        <td class="number">{{ $loop->iteration + ( $diseminasi->currentPage() - 1 ) * $diseminasi->perPage() }}</td>                             <td>{{ $ds->bsip->name }}</td>
                            <td>{{ $ds->tanggal }}</td>
                            <td>
                                <ul>
                                    @foreach ($ds->sip as $sp)
                                        <li>{{ $sp->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $ds->metode->name }}</td>
                            <td>
                                <ul>
                                    @foreach ($ds->sasaran as $sr)
                                        <li>{{ $sr->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $ds->jumlah_sasaran }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ dd(request()->table) }} --}}
            {{-- pagination --}}
            <div style="margin: 10px;display:flex;align-items:center;justify-content:center;gap: 5px;">
                <a href="{{ route('kinerja.diseminasi.store', [...request()->all(), 'page' => 1]) }}" class="paginate-button {{ $diseminasi->currentPage() == 1 ? 'disabled-paginate' : '' }}">First</a>
                <a href="{{ route('kinerja.diseminasi.store', [...request()->all(), 'page' => $diseminasi->currentPage() - 1]) }}" class="paginate-button {{ $diseminasi->currentPage() == 1 ? 'disabled-paginate' : '' }}"><<</a>
                @php
                    $start = ($diseminasi->currentPage() - 1) * $diseminasi->perPage();
                @endphp
                @for ($i = 1; $i <= $diseminasi->lastPage(); $i++)
                    @if ($i > $diseminasi->currentPage() - 5 && $i < $diseminasi->currentPage() + 5)
                        <a href="{{ route('kinerja.diseminasi.store', [...request()->all(), 'page' => $i]) }}" class="paginate-item {{ $diseminasi->currentPage() == $i ? 'active-paginate' : '' }}">{{ $i }}</a>
                    @endif
                @endfor
                <a href="{{ route('kinerja.diseminasi.store', [...request()->all(), 'page' => $diseminasi->currentPage() + 1]) }}" class="paginate-button {{ $diseminasi->currentPage() == $diseminasi->lastPage() ? 'disabled-paginate' : '' }}">>></a>
                <a href="{{ route('kinerja.diseminasi.store', [...request()->all(), 'page' => $diseminasi->lastPage()]) }}" class="paginate-button {{ $diseminasi->currentPage() == $diseminasi->lastPage() ? 'disabled-paginate' : '' }}">Last</a>
            </div>
            {{--  end pagination --}}

            <h3>Standar Instrumen Pertanian yang didiseminasikan</h3>
                <div class="infographics">
                    <div class="card">
                        <h2>Tanaman Pangan (TP)</h2>
                        <div class="icon"><i class="fas fa-seedling"></i></div>
                        <p>Jumlah SNI: {{ $standard->tp }}</p> 
                        <p>Kelompok SNI: 5</p> 
                    </div>
                    <div class="card">
                        <h2>Hortikultura (Horti)</h2>
                        <div class="icon"><i class="fas fa-carrot"></i></div>
                        <p>Jumlah SNI: {{ $standard->horti }}</p>
                        <p>Kelompok SNI: 3</p>
                    </div>
                    <div class="card">
                        <h2>Perkebunan (Bun)</h2>
                        <div class="icon"><i class="fas fa-apple-alt"></i></div>
                        <p>Jumlah SNI: {{ $standard->bun }}</p>
                        <p>Kelompok SNI: 2</p>
                    </div>
                    <div class="card">
                        <h2>Peternakan (Nak)</h2>
                        <div class="icon"><i class="fas fa-regular fa-cow"></i></div>
                        <p>Jumlah SNI: {{ $standard->nak }}</p>
                        <p>Kelompok SNI: 4</p>
                    </div>
                    <div class="card">
                        <h2>Agroinput</h2>
                        <div class="icon"><i class="fa-solid fa-leaf"></i></div>
                        <p>Jumlah SNI: {{ $standard->agroinput }}</p>
                        <p>Kelompok SNI: 2</p>
                    </div>
                    <div class="card">
                        <h2>Pasca Panen (Paspa)</h2>
                        <div class="icon">
                            <img src="/assets/img/planting.png" alt="Icon Pasca Panen" style="width: 50px; height: 50px;">
                        </div>                          <p>Jumlah SNI: {{ $standard->paspa }}</p>
                        <p>Kelompok SNI: 6</p>
                    </div>
                </div>

            <script>
            (async () => {

            const topology = await fetch(
                'https://code.highcharts.com/mapdata/countries/id/id-all.topo.json'
            ).then(response => response.json());

            // Prepare demo data. The data is joined to map using value of 'hc-key'
            // property by default. See API docs for 'joinBy' for more info on linking
            // data and map.
            const data = [
                { id: 1,'hc-key': 'id-ac', value: 11, name: 'Aceh' },
                { id: 10,'hc-key': 'id-jt', value: 12, name: 'Jawa Tengah' },
                { id: null,'hc-key': 'id-be', value: 13, name: 'Bengkulu' },
                { id: 13,'hc-key': 'id-bt', value: 14, name: 'Banten' },
                { id: 16,'hc-key': 'id-kb', value: 15, name: 'Kalimantan Barat' },
                { id: 8,'hc-key': 'id-bb', value: 16, name: 'Bangka Belitung' },
                { id: null,'hc-key': 'id-ba', value: 17, name: 'Bali' },
                { id: 12,'hc-key': 'id-ji', value: 18, name: 'Jawa Timur' },
                { id: 18,'hc-key': 'id-ks', value: 19, name: 'Kalimantan Selatan' },
                { id: 15,'hc-key': 'id-nt', value: 20, name: 'Nusa Tenggara Timur' },
                { id: 22,'hc-key': 'id-se', value: 21, name: 'Sulawesi Selatan' },
                { id: null,'hc-key': 'id-kr', value: 22, name: 'Kepulauan Riau' },
                { id: 28,'hc-key': 'id-ib', value: 23, name: 'Papua Barat' },
                { id: 2,'hc-key': 'id-su', value: 24, name: 'Sumatera Utara' },
                { id: 4,'hc-key': 'id-ri', value: 25, name: 'Riau' },
                { id: 20,'hc-key': 'id-sw', value: 26, name: 'Sulawesi Utara' },
                { id: null,'hc-key': 'id-ku', value: 27, name: 'Kalimantan Utara' },
                { id: 27,'hc-key': 'id-la', value: 28, name: 'Maluku Utara' },
                { id: 3,'hc-key': 'id-sb', value: 29, name: 'Sumatera Barat' },
                { id: 26,'hc-key': 'id-ma', value: 30, name: 'Maluku' },
                { id: 14,'hc-key': 'id-nb', value: 31, name: 'Nusa Tenggara Barat' },
                { id: 23,'hc-key': 'id-sg', value: 32, name: 'Sulawesi Tenggara' },
                { id: 21,'hc-key': 'id-st', value: 33, name: 'Sulawesi Tengah' },
                { id: 29,'hc-key': 'id-pa', value: 34, name: 'Papua' },
                { id: 9,'hc-key': 'id-jr', value: 35, name: 'Jawa Barat' },
                { id: 19,'hc-key': 'id-ki', value: 36, name: 'Kalimantan Timur' },
                { id: 7,'hc-key': 'id-1024', value: 37, name: 'Lampung' },
                { id: null,'hc-key': 'id-jk', value: 38, name: 'Jakarta' },
                { id: 24,'hc-key': 'id-go', value: 39, name: 'Gorontalo' },
                { id: 11,'hc-key': 'id-yo', value: 40, name: 'Yogyakarta' },
                { id: 6,'hc-key': 'id-sl', value: 41, name: 'Sumatera Selatan' },
                { id: 25,'hc-key': 'id-sr', value: 42, name: 'Sulawesi Barat' },
                { id: 5,'hc-key': 'id-ja', value: 43, name: 'Jambi' },
                { id: 17,'hc-key': 'id-kt', value: 44, name: 'Kalimantan Tengah' }
            ];

            // Create the chart
            Highcharts.mapChart('mapindo', {
                chart: {
                    map: topology
                },

                mapNavigation: {
                    enabled: true,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },

                colorAxis: {
                    min: 0,
                    max: 75, // Rentang nilai data
                    stops: [
                        [0, '#95be95'],     // tipis
                        [0.5, '#4c924c'],   // tengah
                        [1, '#006400']      // pekat
                    ]
                    
                },

                series: [{
                    data: data,
                    name: 'Jumlah Peserta',
                    states: {
                        hover: {
                            color: '#e3eee3'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}',
                        style: {
                            fontFamily: 'Arial, sans-serif',
                            fontSize: '12px',
                            fontWeight: 'normal',
                            color: '#000000',
                            fontWeight: 'bold',
                            // textOutline: 'none'
                        }
                    },

                    point: {
                        events: {
                            click: function () {
                                // Arahkan ke halaman lain berdasarkan `hc-key`
                                const route = `/kinerja-kegiatan/diseminasi/provinsi/${this.id}`;
                                window.location.href = route;  // Redirect ke halaman yang sesuai
                            }
                        }
                    }
                }]
            });

            document.getElementById('sasaran-diseminasi').addEventListener('change', function() {
                const selectedValue = this.value;

                // Filter data sesuai sasaran diseminasi
                const filteredData = data.filter(point => {
                    if (!selectedValue) return true; // Jika semua sasaran dipilih
                    return point.name.toLowerCase().includes(selectedValue.toLowerCase());
                });

                // Perbarui peta dengan data yang difilter
                Highcharts.mapChart('mapindo', {
                    chart: { map: topology },
                    mapNavigation: { enabled: true, buttonOptions: { verticalAlign: 'bottom' } },
                    colorAxis: {
                        min: 0, max: 75,
                        stops: [[0, '#95be95'], [0.5, '#4c924c'], [1, '#006400']]
                    },
                    series: [{
                        data: filteredData,
                        name: 'Jumlah Benih (ton)',
                        states: { hover: { color: '#e3eee3' } },
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}',
                            style: {
                                fontFamily: 'Arial, sans-serif',
                                fontSize: '12px',
                                fontWeight: 'bold',
                                color: '#000000'
                            }
                        },
                        point: {
                            events: {
                                click: function () {
                                    const route = `/kinerja-kegiatan/diseminasi/provinsi/${this.id}`;
                                    window.location.href = route;
                                }
                            }
                        }
                    }]
                });
            });

            })();
        </script>
    </div>
@endsection
