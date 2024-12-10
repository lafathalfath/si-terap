@php
    use App\Models\CMS;
    use App\Models\Social;
    $cms = CMS::first();
    $social = Social::get();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cms->app_name }} - {{ $cms->institute }}</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between; 
            padding: 15px 30px;
            background-color: #009144; 
            color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); 
            position: relative;
            z-index: 1000; 
        }

        .logo {
            width: 150px; 
            height: auto;
            margin-right: 20px; 
        }

        .navbar {
            display: flex;
            justify-content: center; 
            gap: 30px; 
            margin-left: auto;
            margin-right: auto; 
            align-items: center; 
            margin-bottom: 0;
            padding-bottom: 0;
            position: relative; /* Needed for dropdown positioning */
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 400; 
            position: relative; 
            padding: 10px 15px; 
            transition: color 0.3s ease, font-weight 0.3s ease; 
            text-align: center; 
            display: inline-block; 
        }

        .navbar a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: #ffffff; 
            left: 0;
            bottom: -5px; 
            transform: scaleX(0);
            transition: transform 0.3s ease; 
        }

        .navbar a:hover {
            color: #ffffff; 
        }

        .navbar a:hover::after {
            transform: scaleX(1); 
        }

        .navbar a.active {
            font-weight: 700; /* Tetap mempertebal teks */
            border-bottom: 3px solid white; /* Tambahkan garis putih di bawah elemen aktif */
            padding-bottom: 10px; /* Sesuaikan padding agar terlihat rapi */
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #009144;
            min-width: 160px;
            z-index: 1;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #007739;
        }
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .hero-section {
            background-image: url('/assets/img/bsip_depan.png');
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            margin-bottom: 50px;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.5rem;
        }

        .footer {
            background-color: #006400;
            color: white;
            padding-bottom: 40px;
            overflow: visible;
            position: relative;
        }

        @import url("https://fonts.googleapis.com/css?family=Lato:400,400i,700");

        svg {
            width:100%;
        }

        .arrow {
            stroke-width: .3px;
            stroke:green;
        }

        .wave {
            animation: wave 3s linear;
            animation-iteration-count:infinite;
            fill: #006400;
        }

        .drop {
            fill: transparent;
            animation: drop 5s ease infinite normal;
            stroke: #006400;
            stroke-width:0.5;
            opacity:.6; 
            transform: translateY(80%);
        }

        .drop1 {
            transform-origin: 20px 3px;
        }

        .drop2 {
            animation-delay: 3s;
            animation-duration:3s;
            transform-origin: 25px 3px;
        }

        .drop3 {
            animation-delay: -2s;
            animation-duration:3.4s;
            transform-origin: 16px 3px;
        }

        .gooeff {
            filter: url(#goo);
        }

        #wave2 {
            animation-duration:5s;
            animation-direction: reverse;
            opacity: .6
        }

        #wave3 {
            animation-duration: 7s;
            opacity:.3;
        }

        @keyframes drop {
            0% {
                transform: translateY(80%); 
                opacity:.6; 
            }
            80% {
                transform: translateY(80%); 
                opacity:.6; 
            }
            90% { 
                transform: translateY(10%) ; 
                opacity:.6; 
            }
            100% { 
                transform: translateY(0%) scale(1.5);  
                stroke-width:0.2;
                opacity:0; 
            }
        }

        @keyframes wave {
            to {transform: translateX(-100%);}
            }
            @keyframes ball {
            to {transform: translateY(20%);}
        }

        .header {
            background-color: white;
            color: white;
            padding: 10px 0;
            /* position: fixed; */
            width: 100%;
            z-index: 20;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between; 
            padding: 15px 30px;
            background-color: #009144; 
            color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); 
            /* position: fixed; Membuat navbar tetap di atas */
            top: 0; /* Posisi di bagian atas */
            left: 0;
            width: 100%; /* Lebar penuh */
            z-index: 1000; /* Pastikan berada di atas elemen lain */
        }


        footer .contact-info p a {
            color: white;
            text-decoration: none;
        }

        footer .social-links {
        margin-top: 10px;
        }

        footer .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        footer .social-links a:hover {
            text-decoration: underline;
        }
        
        .card{
            border-radius: 10px;
            padding: 2px;
            border-width: 0.5px !important;
        }
        
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 100, 0, 0.2); 
            border-color: #00640025 !important;
            border-width: 0.5px !important;
        }
        
        .btn-outline-light-daftar {
            color: #006400; 
            border-width: 0.5px;
            border-color: #006400;
        }
        
        .btn-outline-light-daftar:hover {
            background-color: #006400;
            color: white;
        }

        .btn-outline-light-masuk{
            background-color: #006400;
            color: white;
        }

        .btn-outline-light-masuk:hover{
            background-color: #006400;
            color: white;
        }
        .btn-outline-light-logout {
            color: white; 
            border-width: 0.5px;
            border-color: white;
        }
        
        .btn-outline-light-logout:hover {
            background-color: white;
            color: #006400;
        }

        .btn-outline-light-masuk{
            background-color: #006400;
            color: white;
        }

        .btn-outline-light-masuk:hover{
            background-color: #006400;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="/storage/cms/logo_light.png" alt="Logo" style="height: 50px;"> 
            <nav class="navbar">
                <a class="nav-link {{ request()->is('dashboard-lp2tp') ? 'active' : '' }}" href="{{ route('dashboard-lp2tp') }}">Beranda</a>
                <div class="dropdown">
                    <a class="nav-link {{ request()->routeIs('aset.index') ? 'active' : '' }}" href="#">Aset</a>
                    <div class="dropdown-content">
                        <a class="{{ request()->routeIs('aset.tanah') ? 'active' : '' }}" href="{{ route('aset.tanah') }}">Tanah</a>
                        <a class="{{ request()->routeIs('aset.gedung') ? 'active' : '' }}" href="{{ route('aset.gedung') }}">Gedung</a>
                        <a class="{{ request()->routeIs('aset.lab') ? 'active' : '' }}" href="{{ route('aset.lab') }}">Laboratorium</a>
                        <a class="{{ request()->routeIs('aset.rumah_negara') ? 'active' : '' }}" href="{{ route('aset.rumah_negara') }}">Rumah Negara</a>
                        <a class="{{ request()->routeIs('aset.alat_mesin') ? 'active' : '' }}" href="{{ route('aset.alat_mesin') }}">Peralatan & Mesin</a>
                    </div>
                </div>
                <a class="{{ request()->routeIs('lp2tp.pemanfaatan_kp') ? 'active' : '' }}" href="{{ route('lp2tp.pemanfaatan_kp') }}">Pemanfaatan KP</a>
                <a class="nav-link" href="#">Galeri</a>
            </nav>

            <div>
                <a href="" class="btn btn-outline-light-logout mr-2">Logout</a>
            </div>
        </div>
    </header>

    <div>
        @yield('content')
    </div>

    {{-- OMBAK --}}
    <svg viewBox="0 0 120 28">
        <defs> 
            <mask id="xxx">
                <circle cx="7" cy="12" r="40" fill="#fff" />
            </mask>
          
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="2" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="
                    1 0 0 0 0  
                    0 1 0 0 0  
                    0 0 1 0 0  
                    0 0 0 13 -9" result="goo" />
                <feBlend in="SourceGraphic" in2="goo" />
            </filter>

            <path id="wave" d="M 0,10 C 30,10 30,15 60,15 90,15 90,10 120,10 150,10 150,15 180,15 210,15 210,10 240,10 v 28 h -240 z" />
        </defs> 
       
        <use id="wave3" class="wave" xlink:href="#wave" x="0" y="-2" ></use> 
        <use id="wave2" class="wave" xlink:href="#wave" x="0" y="0" ></use>
        
        <a href="#top" class="topball">
            <circle class="ball" cx="110" cy="8" r="4" stroke="none" stroke-width="0" fill="white" />
                <g class="arrow">
                <polyline class="" points="108,8 110,6 112,8" fill="none"  />
                <polyline class="" points="110,6 110,10.5" fill="none"  />
                </g>
        </a>

        <g class="gooeff">
        <circle class="drop drop1" cx="20" cy="2" r="1.8"  />
        <circle class="drop drop2" cx="25" cy="2.5" r="1.5"  />
        <circle class="drop drop3" cx="16" cy="2.8" r="1.2"  />
        <use id="wave1" class="wave" xlink:href="#wave" x="0" y="1" />
        </g>
    </svg>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5443994375355!2d106.78557271018322!3d-6.5790339933869735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5311ad80031%3A0xae42de3ba17aceb7!2sBalai%20Besar%20Penerapan%20Standar%20Instrumen%20Pertanian%20(BBPSIP)!5e0!3m2!1sen!2sid!4v1722608683905!5m2!1sen!2sid" width="100%" height="250" style="border:0; border-radius: 5px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        <p><b>KONTAK</b></p>
                        <p><a href="tel:+6202518531727"></a>{{ $cms->contact_1 }} | WA : <a href="https://wa.me/{{ $cms->contact_2 }}">{{ $cms->contact_2 }}</a></p>
                        <p>Email: <a href="mailto:{{ $cms->email }}">{{ $cms->email }}</a></p>
                        <p>{{ $cms->address }}</p>
                        
                        <p><a href="{{ $cms->website }}" target="_blank">{{ $cms->website }}</a></p>
                        <div class="social-links">
                            @foreach ($social as $sc)
                                <a href="{{ $sc->url }}" target="_blank"><i class="fab fa-{{ $sc->name }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
