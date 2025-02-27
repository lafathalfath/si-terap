@extends('layouts.layoutIp2tp')

@section('content')
    <style>
        .asset-dashboard {
            background-color: #f5f5f5;
        }

        h2 {
            text-align: left;
            color: #009144;
            padding: 10px;
        }
    
        .filter-container {
            display: flex;
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
            padding: 8px 10px;
            background-color: #00452C;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .filter-container button:hover {
            background-color: #006633;
        }
          /* New styles for export button */
        .export-button {
        float: right;
        padding: 8px 15px;
        background-color: #009144; /* Green color */
        color: white;
        border: none;
        border-radius: 5px;
        margin-left: 625px; /* Push the button to the right side */
        }

        .export-button:hover {
        background-color: #00b36b; /* Darker green on hover */
        }

        .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        }

  </style>

    <section class="asset-dashboard">
        <div class="container">
            <h2 class="heading" style="margin-top: 40px;">Pemanfaatan Kebun Percobaan</h1>
            <hr>
            
            <div class="d-flex align-items-center justify-content-between">
              <form action="{{ route('lp2tp.pemanfaatan_kp') }}" class="w-75 d-flex align-items-center gap-2 mb-3">
                  <!-- Filter Section -->
                  <div class="filter-container">
                      <select id="bpsip" name="bsip_id">
                          <option selected disabled>BPSIP</option>
                          @foreach ($all_bsip as $item)
                            <option value="{{ $item->id }}" {{ request()->bsip_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                          @endforeach
                      </select>
                      
                      <button type="submit" class="btn btn-success">Cari</button>
                  </div>
                </form>
                
              <div class="d-flex align-items center justify-content-end gap-2 w-50">
                  <a href="{{route('lp2tp.pemanfaatan_kp.create')}}" class="btn btn-success">
                      <i class="fa-solid fa fa-plus"></i>&ensp;
                      Tambah data
                  </a>
                  <a  class="btn btn-success">
                    <i class="fa-solid fa-file-excel"></i>&ensp;
                    Export Excel
                </a>
              </div>
          </div>

        <p>Pendataan Pemanfaatan Kebun Percobaan</p>

            <!-- Table with Static Data -->
            <div class="table-container">
                <table class="table table-bordered">
                    <tr>
                      <th>No</th>
                      <th>BPSIP</th>
                      <th>Luas IP2SIP (Ha)</th>
                      <th>Agroekosistem</th>
                      <th>Pengkajian/Diseminasi</th>
                    </tr>
                    <tr>
                      <tr>
                        @foreach ($pemanfaatan_sip as $item)
                            <tr> <!-- Buat baris baru untuk setiap item -->
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('lp2tp_detail', $item->id) }}" style="text-decoration: none; color: inherit;">
                                        {{ $item->ip2sip->bsip->name }}/KP. {{ $item->ip2sip->name }}
                                    </a>
                                </td>
                                <td>{{ $item->luas_sip }}</td>
                                <td>{{ $item->agro_ekosistem }}</td>
                                <td>
                                    <ol>
                                        @foreach ($item->pemanfaatan_diseminasi as $pd)
                                            <li>{{ $pd->name }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                        @endforeach
                    </tr>
                    
                  </table>

                <nav aria-label="...">
                    <ul class="pagination">
                      <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                      </li>
                      <li class="page-item active" aria-current="page">
                        <span class="page-link">1</span>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                      </li>
                    </ul>
                  </nav>
            </div>


        </div>
    </section>
    
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
