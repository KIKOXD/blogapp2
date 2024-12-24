<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Dynamic Title from SEO Settings -->
    @if(isset($settings) && $settings?->meta_title)
        <title>{{ $settings?->meta_title }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    @if(isset($settings) && $settings?->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings?->favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Meta Tags -->
    @if($settings?->meta_description)
        <meta name="description" content="{{ $settings->meta_description }}">
    @endif

    @if($settings?->meta_keywords)
        <meta name="keywords" content="{{ $settings->meta_keywords }}">
    @endif

    <!-- Google Search Console Verification -->
    @if($settings?->google_search_console)
        <meta name="google-site-verification" content="{{ $settings->google_search_console }}">
    @endif

    <!-- Canonical URL -->
    @if($settings?->canonical_url)
        <link rel="canonical" href="{{ $settings->canonical_url }}">
        <meta property="og:url" content="{{ $settings->canonical_url }}">
    @endif

    <!-- Google Analytics -->
    @if($settings?->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', '{{ $settings->google_analytics_id }}');
        </script>
    @endif

    <style>
        :root {
            --background-color:
                {{ $settings->background_color ?? '#f3f4f6' }}
            ;
            --section-color:
                {{ $settings->section_color ?? '#ffffff' }}
            ;
            --card-background-color:
                {{ $settings->card_background_color ?? '#ffffff' }}
            ;
            --card-text-primary-color:
                {{ $settings->card_text_primary_color ?? '#333333' }}
            ;
            --card-text-secondary-color:
                {{ $settings->card_text_secondary_color ?? '#666666' }}
            ;
            --card-button-color:
                {{ $settings->card_button_color ?? '#2563eb' }}
            ;
            --card-date-color:
                {{ $settings->card_date_color ?? '#999999' }}
            ;
            --card-button-hover-color:
                {{ $settings->card_button_hover_color ?? '#1d4ed8' }}
            ;
            --text-primary-color:
                {{ $settings->text_primary_color ?? '#333333' }}
            ;
            --text-secondary-color:
                {{ $settings->text_secondary_color ?? '#666666' }}
            ;
            --text-accent-color:
                {{ $settings->text_accent_color ?? '#2563eb' }}
            ;
        }

        body {
            background-color: var(--background-color);
        }

        .navbar,
        .marquee,
        .footer,
        .footer-article,
        .logo-section,
        .social-link {
            background-color: var(--section-color);
        }

        .card {
            background-color: var(--card-background-color) !important;
        }

        .card-title {
            color: var(--card-text-primary-color) !important;
        }

        .card-text {
            color: var(--card-text-secondary-color) !important;
        }

        .card-date,
        .card-detail {
            color: var(--card-date-color) !important;
            font-size: 0.875rem;
        }

        .card-button,
        .read-more {
            background-color: var(--card-button-color) !important;
            color: #ffffff !important;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
            outline: none;
            position: relative;
            overflow: hidden;
        }

        .card-button:hover,
        .read-more:hover {
            background-color: var(--card-button-hover-color) !important;
            opacity: 1 !important;
            transform: none !important;
        }

        .read-more:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background-color: var(--card-button-hover-color) !important;
            transition: all 0.3s ease;
            z-index: -1;
        }

        .read-more:hover:before {
            height: 100%;
        }

        button.card-button:hover,
        a.read-more:hover {
            background-color: var(--card-button-hover-color) !important;
        }

        .card-button:focus,
        .read-more:focus {
            outline: 2px solid var(--card-button-color);
            outline-offset: 2px;
        }

        /* Social Links Hover */
        .social-link:hover {
            background-color: var(--section-color) !important;
            color: #ffffff !important;
            opacity: 1 !important;
        }

        .social-link {
            background-color: var(--section-color) !important;
            color: #ffffff !important;
            transition: all 0.3s ease;
        }

        /* Text Colors */
        .marquee,
        .footer p,
        .footer-article,
        .logo-button,
        .pagination-info,
        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4,
        .article-content h5,
        .article-content h6,
        .article-content p,
        .jackpot-text h2,
        .pagination-text {
            color: var(--text-primary-color) !important;
        }

        /* Social Links */
        .social-link {
            background-color: var(--section-color) !important;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background-color: var(--section-color) !important;
            color: #ffffff !important;
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="container">
            <!-- Logo -->
            <div class="logo-section">
                <div class="logo">
                    <img src="{{ asset('storage/' . $settings?->logo) }}" alt="Logo">
                </div>
                <div class="logo-buttons">
                    @php
                        $buttons = isset($settings?->navbar_buttons) ? json_decode($settings?->navbar_buttons) : [
                            (object) ['text' => 'Daftar Sekarang', 'url' => '#'],
                            (object) ['text' => 'Login Member', 'url' => '#']
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
                        @if($settings?->whatsapp_link)
                            <a href="https://wa.me/{{ $settings?->whatsapp_link }}" target="_blank" class="social-link">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </a>
                        @endif
                        @if($settings?->instagram_link)
                            <a href="https://instagram.com/{{ $settings?->instagram_link }}" target="_blank"
                                class="social-link">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                        @endif
                        @if($settings?->facebook_link)
                            <a href="{{ $settings?->facebook_link }}" target="_blank" class="social-link">
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
            @if(isset($settings) && $settings?->marquee_text)
                {{ $settings?->marquee_text }}
            @else
                Selamat kepada pemenang jackpot: Rp24.857.400 | Selamat kepada pemenang jackpot: Rp50.000.000 | Main
                sekarang dan menangkan jackpot Anda!
            @endif
        </marquee>
    </section>

    <!-- Slider Section -->
    <section class="slider">
        <div class="slider-container">
            @if(isset($settings))
                <div class="slider-loading" id="sliderLoading">
                    <div class="spinner"></div>
                </div>
                @for($i = 1; $i <= 3; $i++)
                    @if($settings?->{"banner_$i"})
                        <img src="{{ asset('storage/' . $settings?->{"banner_$i"}) }}" alt="Slider {{ $i }}" class="slider-image">
                    @else
                        <img src="{{ asset('images/' . $i . '.jpg') }}" alt="Slider {{ $i }}" class="slider-image">
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
    @if(isset($settings) && $settings?->footer_article)
        <div class="container mx-auto px-4">
            <section class="footer-article">
                <div class="article-content">
                    {!! $settings?->footer_article !!}
                </div>
            </section>
            <footer class="footer">
                <p>
                    @if(isset($settings) && $settings?->footer_text)
                        {{ $settings?->footer_text }}
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