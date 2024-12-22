<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BlogApp</title>
    @if(isset($settings) && $settings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings->favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <!-- Logo -->
            <div class="logo-section">
                <div class="logo">
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo">
                </div>
                <div class="logo-buttons">
                    @php
                        $buttons = isset($settings->navbar_buttons) ? json_decode($settings->navbar_buttons) : [
                            (object)['text' => 'Daftar Sekarang', 'url' => '#'],
                            (object)['text' => 'Login Member', 'url' => '#']
                        ];
                    @endphp
                    
                    @foreach($buttons as $button)
                        <a href="{{ $button->url }}" class="logo-button">
                            {{ $button->text }}
                        </a>
                    @endforeach
                </div>
            </div>
            

            <!-- Right Section -->
            <div class="right-section">
                <!-- Social Media Links -->
                <div class="social-links">
                    @if(isset($settings))
                        @if($settings->whatsapp_link)
                            <a href="https://wa.me/{{ $settings->whatsapp_link }}" target="_blank" class="social-link">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </a>
                        @endif
                        @if($settings->instagram_link)
                            <a href="https://instagram.com/{{ $settings->instagram_link }}" target="_blank" class="social-link">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                        @endif
                        @if($settings->facebook_link)
                            <a href="{{ $settings->facebook_link }}" target="_blank" class="social-link">
                                <i class="fab fa-facebook text-xl"></i>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Marquee Section -->
    <section class="marquee">
        <marquee behavior="scroll" direction="left">
            @if(isset($settings) && $settings->marquee_text)
                {{ $settings->marquee_text }}
            @else
                Selamat kepada pemenang jackpot: Rp24.857.400 | Selamat kepada pemenang jackpot: Rp50.000.000 | Main sekarang dan menangkan jackpot Anda!
            @endif
        </marquee>
    </section>

    <!-- Slider Section -->
    <section class="slider">
        <div class="slider-container">
            @if(isset($settings))
                @for($i = 1; $i <= 3; $i++)
                    @if($settings->{"banner_$i"})
                        <img src="{{ asset('storage/' . $settings->{"banner_$i"}) }}" 
                             alt="Slider {{ $i }}" 
                             class="slider-image">
                    @else
                        <img src="{{ asset('images/' . $i . '.jpg') }}" 
                             alt="Slider {{ $i }}" 
                             class="slider-image">
                    @endif
                @endfor
            @else
                <img src="{{ asset('images/1.jpg') }}" alt="Slider 1" class="slider-image">
                <img src="{{ asset('images/2.jpg') }}" alt="Slider 2" class="slider-image">
                <img src="{{ asset('images/3.jpg') }}" alt="Slider 3" class="slider-image">
            @endif
        </div>
    </section>

    @yield('content')

    <!-- Footer Article & Footer Section -->
    @if(isset($settings) && $settings->footer_article)
    <div class="container mx-auto px-4">
        <section class="footer-article">
            <div class="article-content">
                {!! $settings->footer_article !!}
            </div>
        </section>
        <footer class="footer">
            <p>
                @if(isset($settings) && $settings->footer_text)
                    {{ $settings->footer_text }}
                @else
                    &copy; 2024 AlexisTogel. Semua Hak Dilindungi.
                @endif
            </p>
        </footer>
    </div>
    @endif

    <script src="{{ asset('js/slider.js') }}"></script>
</body>
</html>
