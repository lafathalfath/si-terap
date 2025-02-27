@extends('layouts.layoutIp2tp')

@section('content')
<style>
    .gallery-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
        padding: 20px;
    }

    .gallery-item {
        width: 250px;
        height: 200px;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-item .gallery-caption {
        position: absolute;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        width: 100%;
        text-align: center;
        padding: 5px;
        font-size: 16px;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Gambar di dalam modal */
    #modalImage {
        width: 80%; /* Atur lebar gambar menjadi 80% dari lebar modal */
        max-width: 600px; /* Lebar maksimal gambar */
        height: auto; /* Agar tinggi gambar proporsional */
        margin: 0 auto; /* Menempatkan gambar di tengah modal */
    }

    /* Judul Dokumentasi Kegiatan di tengah */
    h2 {
        text-align: center;
        font-size: 24px;
        margin-top: 50px; /* Memberi jarak lebih besar antara navbar dan h2 */
        margin-bottom: 30px; /* Menambah jarak bawah jika diperlukan */
        font-weight: bold;
    }

    /* Menyelaraskan judul di dalam modal */
    #modalTitle {
        text-align: center; /* Menyelaraskan teks ke tengah */
        font-size: 24px; /* Atur ukuran font sesuai keinginan */
        font-weight: bold; /* Menebalkan teks */
        margin-bottom: 20px; /* Memberikan sedikit jarak antara judul dan konten lainnya */
    }
</style>

<h2>Profil Kebun Percobaan (IP2SIP)</h2>
<div class="gallery-container">
    @foreach ($gallery as $gal)
        <div class="gallery-item" onclick="openModal('{{ $gal->title }}', '{{ $gal->image_url }}', 'Deskripsi kegiatan yang lebih panjang tentang {{ $gal->title }}. Sejarah singkat asal usul Kebun Percobaan ini berawal dari adanya proyek IDAP (1976-1986) kerjasana Indonesia dengan kerajoon Belanda. Pada tahun 1980 masyarakat petani kop di Aceh Tengah tergantung kehidupannya pada komoditi kopi sementora produksi hanya 500 kg/ hektar dalam setahun. Selain itu mutu kopi juga masih rendah akibat tidak adanya prosesing yang baik sehingga pada tahun 1984 dibangun pabrik prosesing kopi arabika. sengan kapas tas 15 ton kopi glondong nerah perharinya. Hal ini bertujuan untuk meningkatkan kualitas mutu kopi sehinggo meningkatkan pendapatan masyarakat tani sekitarnya. ')">
            <img src="{{ $gal->image_url }}" alt="{{ $gal->title }}">
            <div class="gallery-caption">{{ $gal->title }}</div>
        </div>
    @endforeach
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 id="modalTitle">Nama Kegiatan</h3>
        <img id="modalImage" src="" alt="Kegiatan">
        <p id="modalDescription">Deskripsi Kegiatan</p>
    </div>
</div>

<script>
    // Open the modal and populate it with content
    function openModal(title, imageUrl, description) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('modalDescription').innerText = description;

        // Show the modal
        document.getElementById('myModal').style.display = "block";
    }

    // Close the modal
    function closeModal() {
        document.getElementById('myModal').style.display = "none";
    }

    // Close the modal if the user clicks outside the modal
    window.onclick = function(event) {
        if (event.target == document.getElementById('myModal')) {
            closeModal();
        }
    }
</script>

@endsection
