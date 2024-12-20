<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Jackpot - BlogApp</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="navbar">
                <!-- Logo -->
                <div class="logo">
                    <img src="{{ asset('images/GIF-LOGO-MAHASLOT.gif') }}" alt="Logo">
                </div>

                <!-- Search Bar -->
                <div class="search-container">
                    <input type="text" placeholder="Cari Bukti Jackpot..." class="search-box">
                </div>
            </div>
        </div>
    </header>

    <!-- Marquee Section -->
    <section class="marquee">
        <marquee behavior="scroll" direction="left">
            Selamat kepada pemenang jackpot: Rp24.857.400 | Selamat kepada pemenang jackpot: Rp50.000.000 |
            Main sekarang dan menangkan jackpot Anda!
        </marquee>
    </section>

    <!-- Slider Section -->
    <section class="slider">
        <div class="slider-container">
            <div class="slide active">
                <img src="{{ asset('images/1.jpg') }}" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="{{ asset('images/2.jpg') }}" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="{{ asset('images/3.jpg') }}" alt="Slide 3">
            </div>
            {{-- <div class="slide">
                <img src="{{ asset('images/4.jpg') }}" alt="Slide 4">
            </div>
            <div class="slide">
                <img src="{{ asset('images/5.jpg') }}" alt="Slide 5">
            </div> --}}
        </div>
    </section>



    <main class="main-content">
        <h2 class="main-title">Bukti Jackpot Lunas AlexisTogel</h2>
        <div class="cards-container">
            @foreach ($posts as $post)
                <div class="card">
                    <div class="card-image">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">{{ $post->title }}</h3>
                        <div class="card-text">{!! Str::limit(strip_tags($post->description), 100) !!}</div>
                        <p class="card-detail">{{ $post->created_at->format('d M Y') }}</p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 AlexisTogel. Semua Hak Dilindungi.</p>
    </footer>

    <script src="{{ asset('js/slider.js') }}"></script>

</body>

</html>