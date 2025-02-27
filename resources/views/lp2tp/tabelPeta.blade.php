@extends('layouts.layoutIp2tp')

@section('content')
    <style>
    body {
        background-color: #ffffff;
    }
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
        <h1 class="page-title">Persebaran Instalasi Penelitian dan Pengkajian Teknologi Pertanian <br> Provinsi {{ $bsip->name }}</h1>

        <!-- Filter Section -->
        <form id="form-filter" class="filter-container">
            <label for="bpsip">BP2TP:</label>
            <select id="bpsip" onchange="handleChangeFilter(this)">
                <option value="">Pilih BP2TP</option>
                @foreach ($bsip_ip2sip as $bi)
                    <option value="{{ $bi->id }}" {{ request()->bsip_id == $bi->id ? 'selected' : '' }}>{{ $bi->name }}</option>
                @endforeach
            </select>

            {{-- <button type="button" onclick="filterData()">Filter</button> --}}
            <button type="submit">Filter</button>
        </form>

        <!-- Kegiatan Table -->
        <h2>Data IP2SIP</h2>
        <table id="kegiatan-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>IP2SIP</th>
                    <th>Luas</th>
                    <th>Agroekosistem</th>
                    <th>Pemanfaatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemanfaatan_sip as $ps)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ps->ip2sip->name }}</td>
                        <td>{{ $ps->luas_sip }}</td>
                        <td>{{ $ps->agro_ekosistem }}</td>
                        <td>---</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        const handleChangeFilter = (e) => {
            document.getElementById('form-filter').action = `/ip2sip/tabelPeta/${e.value}`
        }

        // const kegiatanData = [
        //     { no: 1, namaKP: 'Nama KP 1', luas: '50 Ha', agro: 'Sawah', pemanfaatan: 'Produksi Padi' },
        //     { no: 2, namaKP: 'Nama KP 2', luas: '30 Ha', agro: 'Kebun', pemanfaatan: 'Penelitian Jeruk' },
        //     { no: 3, namaKP: 'Nama KP 1', luas: '20 Ha', agro: 'Ladang', pemanfaatan: 'Peternakan Ayam' },
        // ];

        // function filterData() {
        //     const bpsip = document.getElementById('bpsip').value;

        //     const filteredData = kegiatanData.filter(item => {
        //         return bpsip === '' || item.namaKP === bpsip;
        //     });

        //     displayData(filteredData);
        // }

        // function displayData(data) {
        //     const tableBody = document.querySelector('#kegiatan-table tbody');
        //     tableBody.innerHTML = '';

        //     data.forEach(item => {
        //         const row = document.createElement('tr');
        //         row.innerHTML = `
        //             <td>${item.no}</td>
        //             <td>${item.namaKP}</td>
        //             <td>${item.luas}</td>
        //             <td>${item.agro}</td>
        //             <td>${item.pemanfaatan}</td>
        //         `;
        //         tableBody.appendChild(row);
        //     });
        // }

        // displayData(kegiatanData);
    </script>
@endsection