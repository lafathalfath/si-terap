@extends('layouts.layoutIp2tp')

@section('content')
<style>
    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .profile-title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #00452C;
        margin-bottom: 20px;
    }

    .profile-image {
        display: block;
        max-width: 100%;
        height: auto;
        margin: 0 auto 20px;
        border-radius: 8px;
    }

    .profile-description {
        font-size: 16px;
        line-height: 1.6;
        color: #333;
        text-align: justify;
    }
</style>

<div class="profile-container">
    <!-- Judul -->
    <h1 class="profile-title">SISTEM INFORMASI INSTALASI PENELITIAN DAN PENGKAJIAN STANDAR INSTRUMEN PERTANIAN (IP2SIP) LINGKUP BPSIP</h1>

    <!-- Foto -->
    <img src="{{ asset('assets/img/bsip-21.jpg') }}" alt="Foto BBPSIP" class="profile-image">

    <!-- Deskripsi -->
    <p class="profile-description">
        Balai Besar Pengkajian dan Pengembangan Teknologi Pertanian (BBP2TP) adalah Unit Pelaksana Teknis (UPT) di bidang pengkajian dan pengembangan teknologi pertanian yang berada di bawah dan bertanggungjawab kepada Kepala Badan Penelitian dan Pengembangan Pertanian. BBP2TP semula bernama Balai Pengkajian dan Pengembangan Teknologi Pertanian (BP2TP) yang berdiri berdasarkan Keputusan Menteri Pertanian nomor 77/Kpts/OT.210/1/2002, tanggal 29 Januari 2002 dan sejak terbitnya Peraturan Menteri Pertanian (Permentan) nomor 301/Kpts/OT.140/7/2005 tanggal 11 Juli 2005, BP2TP berubah menjadi Balai Besar Pengkajian dan Pengembangan Teknologi Pertanian.
    </p>
    <p class="profile-description">
        Kebun Percobaan lingkup BBP2TP berjumlah 60 KP yang tersebar di 28 BPTP. Pada tahun 2018 ada tiga KP yang baru, yaitu KP Kampar, KP Siak (BPTP Riau) dan KP Paal 16 (BPTP Jambi). Total luas KP lingkup BBP2TP adalah 2.569,47 Ha, dengan luasan rata-rata 45 Ha. Luasan KP ini bervariasi dari yang terkecil seluas 0,188 Ha (KP Wamena Papua) dan yang terbesar seluas 307 Ha (KP Makariki-Maluku).
    </p>
    <p class="profile-description">
        Lokasi Kebun Percobaan tersebar pada beberapa agroekosistem. Sebanyak 41 KP berada di lahan kering baik lahan kering di dataran rendah, dataran tinggi maupun berbukit, sedangkan 9 KP berada di lahan sawah, sisanya 7 KP berada di lahan lebak, rawa dan lahan pasang surut.
    </p>
    <p class="profile-description">
        Berdasarkan fungsinya maka pemanfaatan KP dapat dibedakan menjadi tiga kelompok besar yaitu pemanfaatan untuk kegiatan pengkajian/diseminasi, Unit Pengelola Benih Sumber (UPBS) dan Kerjasama Pemanfaatan KP dengan stakeholder. Hal ini sejalan dengan tugas dan fungsi utama BPTP di daerah sebagai lembaga yang bergerak dalam bidang pengkajian dan diseminasi hasil pengkajian. Tujuh puluh enam persen pemanfaatan KP ditujukan untuk kegiatan pengkajian dan diseminasi meliputi penelitian, ujicoba, pengembangan model penelitian, kebun produksi, koleksi plasma nutfah, koleksi sumberdaya genetik, pembibitan, kebun bibit induk, visitor plot, display teknologi unggulan, dan diseminasi lain seperti program jarwo super dan taman sains teknologi.
    </p>
    <p class="profile-description">
        Lahan KP sebagai lokasi untuk kegiatan litkaji perlu dipetakan dan ditata dengan baik dalam bentuk zonasi atau blok - blok sesuai dengan peruntukannya. Penataan lahan dalam bentuk blok - blok tersebut harus disesuaikan dengan kondisi dan kontur lahan yang ada. Hal tersebut diperlukan untuk memudahkan bagi para peneliti dan pengkaji dalam menentukan rancangan atau perlakuan terhadap tanaman atau komoditas yang diteliti. Di samping itu penataan lahan bermanfaat untuk menghindari terjadinya tumpang tindih dalam penggunaannya. Lahan yang digunakan untuk litkaji harus terpelihara dengan baik agar terhindar atau bebas dari kemungkinan terkontaminasi, gangguan hama dan penyakit serta faktor faktor lainnya yang dapat mempengaruhi keberhasilan kegiatan tersebut. Di samping itu lahan untuk kegiatan litkaji perlu dipilih pada area yang mempunyai sistem irigasi memadai. Lahan di KP yang tidak digunakan untuk kegiatan litkaji sebaiknya dimanfaatkan sebagai area penyangga, misalnya untuk tanaman produksi, perbanyakan tanaman pakan ternak atau kegiatan lainnya.
    </p>
    <p class="profile-description">
        Kebun percobaan selain untuk mendukung kegiatan litkaji, juga berfungsi sebagai lokasi konservasi koleksi plasma nutfah, yang diperbanyak melalui biji atau setek, lokasi konservasi tersebut dapat berfungsi untuk kegiatan rejunevasi dan karakterisasi. Penentuan lahan untuk untuk koleksi plasma nutfah atau sumberdaya genetik hendaknya disesuaikan dengan karakteristik komoditasnya, seperti kebutuhan syarat tumbuh atau sifat sifat khusus lainnya.
    </p>

</div>
@endsection
