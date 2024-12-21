<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BlogApp</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="{{ asset('images/GIF-LOGO-MAHASLOT.gif') }}" alt="Logo">
                </div>
                <div class="search-container">
                    <input type="text" placeholder="Cari Bukti Jackpot..." class="search-box">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Marquee Section -->
    <section class="marquee">
        <marquee behavior="scroll" direction="left">
            Selamat kepada pemenang jackpot: Rp24.857.400 | Selamat kepada pemenang jackpot: Rp50.000.000 | Main sekarang dan menangkan jackpot Anda!
        </marquee>
    </section>

    <!-- Slider Section -->
    <section class="slider">
        <div class="slider-container">
            <img src="{{ asset('images/1.jpg') }}" alt="Slider 1" class="slider-image">
            <img src="{{ asset('images/2.jpg') }}" alt="Slider 2" class="slider-image">
            <img src="{{ asset('images/3.jpg') }}" alt="Slider 3" class="slider-image">
        </div>
    </section>

    @yield('content')

    <footer class="footer">
        <p>&copy; 2024 AlexisTogel. Semua Hak Dilindungi.</p>
    </footer>

    <script src="{{ asset('js/slider.js') }}"></script>
</body>
</html>
