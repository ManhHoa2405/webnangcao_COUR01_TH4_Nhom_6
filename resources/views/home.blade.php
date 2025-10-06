<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShopHiang</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epunda+Slab:ital,wght@0,300..900;1,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="top-banner">
        <p class="top-banner-text" style="font-size:120%"><b>Welcome to Hiang Food</b></p>
    </div>

    <header class="header">
        <!-- Logo -->
        <div class="header-logo" title="ShopHiang">
            <a><img src="{{ asset('images/logo.png') }}" alt="ShopHiang Logo" style="width: 150px; height:100px;"></a>
        </div>

        <!-- Search -->
        <div class="header-search" title="Tìm kiếm sản phẩm">
            <input type="text" placeholder="Tìm kiếm sản phẩm..." class="search-input">
            <button class="header-search-btn">
                <img src="{{ asset('images/search.png') }}" alt="search-icon">
            </button>
        </div>

        <!-- Actions -->
        <div class="header-actions">
            <a href="tel:0989 888 888" title="Goi ngay" class="header-action">
                <img src="{{ asset('images/phone.png') }}" alt="Nhấn để gọi">
                <span>0989 888 888</span>
            </a>

            <!-- Tài khoản -->
        @auth
        <div class="header-action dropdown">
            <img src="{{ asset('images/user.png') }}" alt="avatar">
            <span>{{ Auth::user()->name }}</span>

            <div class="dropdown-content">
                <p><strong>{{ Auth::user()->name }}</strong></p>
                <p>{{ Auth::user()->email }}</p>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('adminPage') }}">Vào trang quản trị</a>
                @else
                    <a href="{{ route('users.show', Auth::id()) }}">Thông tin</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link">Đăng xuất</button>
                </form>
            </div>
        </div>
        @else
        <a href="#" id="openLogin" class="header-action">
            <img src="{{ asset('images/user.png') }}" alt="Tài khoản"> 
            <span>Tài khoản</span>
        </a>
        @endauth

            <a href="{{ route('cart.index') }}" title="Giỏ hàng" class="header-action">
                <img src="{{ asset('images/shopping-bag.png') }}" alt="Giỏ hàng">
                <span>Giỏ hàng</span>
                <span class="cart-count" id="cart-count" >{{ $cartCount ?? 0 }}</span>
            </a>
        </div>
    </header>

    <div class="header-menu">
        <nav class="header-nav">
            <a href="#" class="header-nav-link" title="Trang chủ" ><b>Trang chủ</b></a>
            <a href="{{ route('menuProducts') }}" class="header-nav-link" title="Menu"><b>Danh sách các món</b></a>
            <a href="{{ url('/intro') }}" class="header-nav-link" title="Tìm hiểu thêm về Hiang"><b>Giới thiệu</b></a>
        </nav>
    </div>

    <div class="slideshow">
        <div class="slide" style="background-image: url('{{ asset('images/background.jpeg') }}')"></div>
        <div class="slide" style="background-image: url('{{ asset('images/background2.jpeg') }}')"></div>
    </div>
    <div class="background-image banner">
        <img src="{{ asset('images/background3.png') }}" alt="Background Image-3" class="background-img" style="width: 99%; margin-left:7px">
    </div>

     <!-- Footer -->
    <footer class="footer">
    <div class="footer-content">
        <div class="logo-footer">
            <a href="#">
                <img src="{{ asset('images/logo.png') }}" alt="logo-footer" title="Diang Drink">
            </a>
        </div>

        <div class="about-hiang">
            <h3 style="color: #333;">Về Hiang Food</h3>
            <p>Hiang Food cam kết mang đến cho bạn những trải nghiệm đồ uống tuyệt vời nhất với nguyên liệu tươi ngon và công thức độc đáo.</p>
            <a href="#">Nguồn gốc</a>
            <a href="#">Dịch vụ</a>
            <a href="#">Tuyển dụng</a>
            <a href="#">Liên hệ</a>
        </div>

        <div class="customer-support">
            <h3 style="color: #333;">Hỗ trợ khách hàng</h3>
            <a href="#">Chính sách đổi trả</a>
            <a href="#">Chính sách bảo mật</a>
            <a href="#">Điều khoản dịch vụ</a>
            <a href="#">Câu hỏi thường gặp</a>
        </div>

        <div class="system-store">
            <h3 style="color: #333;">Hệ thống cửa hàng</h3>
            <p>Hà Nội: 123 Đường A, Quận B</p>
            <p>Hồ Chí Minh: 456 Đường C, Quận D</p>
            <p>Đà Nẵng: 789 Đường E, Quận F</p>
            <p>Liên hệ: 0989 888 888</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>Theo dõi chúng tôi:</p>
        <div class="social-icons">
            <a href="#"><img src="{{ asset('images/tiktok.png') }}" alt="tiktok-icon" title="TikTok"></a>
            <a href="#"><img src="{{ asset('images/instagram.png') }}" alt="instagram-icon" title="Instagram"></a>
            <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="facebook-icon" title="Facebook"></a>
            <a href="#"><img src="{{ asset('images/youtube.png') }}" alt="youtube-icon" title="YouTube"></a>
        </div>
    </div>
</footer>


    {{-- Nhúng modal --}}
    @include('auth-modal')

    {{-- Gọi JS,css --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])


    <script>
        // slideshow
        document.addEventListener("DOMContentLoaded", function() {
            let slides = document.querySelectorAll('.slideshow .slide');
            let current = 0;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === index);
                });
            }

            function nextSlide() {
                current = (current + 1) % slides.length;
                showSlide(current);
            }

            showSlide(current);
            setInterval(nextSlide, 4000);
        });
    </script>
</body>
</html>