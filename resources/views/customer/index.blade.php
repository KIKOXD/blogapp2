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
            <h1 class="logo">Mahaslot</h1>
            <div class="search-container">
                <input type="text" placeholder="Cari Bukti Jackpot..." class="search-box">
            </div>
        </div>
    </header>

    <main class="main-content">
        <h2 class="main-title">Bukti Jackpot Lunas Mahaslot</h2>
        <div class="cards-container">
            <!-- Contoh Kartu -->
            @for ($i = 0; $i < 8; $i++)
            <div class="card">
                <div class="card-image">
                    <img src="{{ asset('images/example.jpg') }}" alt="Jackpot">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Selamat Kepada</h3>
                    <p class="card-text">Mahaslot di Slot Sweet Bonanza</p>
                    <p class="card-detail">Jackpot: Rp24.857.400</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>
            @endfor
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Mahaslot. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>