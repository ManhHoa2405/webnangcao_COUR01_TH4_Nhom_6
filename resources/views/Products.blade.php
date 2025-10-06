<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Introduction about Hiang</title>
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epunda+Slab:ital,wght@0,300..900;1,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
</head>
<body>

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
            <a href="#" title="Tài khoản" class="header-action" id="openLogin">
                <img src="{{ asset('images/user.png') }}" alt="Tài khoản">
                <span>Tài khoản</span>
            </a>
            <a href="{{ route('cart.index') }}" title="Giỏ hàng" class="header-action">
                <img src="{{ asset('images/shopping-bag.png') }}" alt="Giỏ hàng">
                <span>Giỏ hàng</span>
                <span class="cart-count">{{ $cartCount ?? 0 }}</span>
            </a>
        </div>
    </header>

    <div class="header-menu">
        <nav class="header-nav">
            <a href="{{ url('/') }}" class="header-nav-link" title="Trang chủ"><b>Trang chủ</b></a>
            <a href="#" class="header-nav-link" title="Menu"><b>Danh sách các món</b></a>
            <a href="{{ url('/intro') }}" style="text-decoration: none; color: #007bff"><b>Giới thiệu</b></a>
        </nav>
    </div>
    <div class="main-content">
    
    </div>
</body>
</html>