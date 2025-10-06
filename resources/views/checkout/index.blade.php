<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="{{ asset('css/detailProduct.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epunda+Slab:ital,wght@0,300..900;1,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif


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
                    <a href="{{ route('adminPage') }}" style="text-decoration: none; color: #333;">Vào trang quản trị</a>
                @else
                    <a href="{{ route('users.show', Auth::id()) }}">Thông tin</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link" tyle="text-decoration: none;">Đăng xuất</button>
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
                <span class="cart-count" id="cart-count">{{ $cartCount ?? 0 }}</span>
            </a>
        </div>
    </header>

    <div class="header-menu">
        <nav class="header-nav">
            <a href="{{ url('/') }}" class="header-nav-link" title="Trang chủ"><b>Trang chủ</b></a>
            <a href="{{ route('menuProducts') }}" class="header-nav-link" title="Menu" ><b>Danh sách các món</b></a>
            <a href="{{ url('/intro') }}" class="header-nav-link" title="Tìm hiểu thêm về Hiang"><b>Giới thiệu</b></a>
        </nav>
    </div>

<div class="checkout-content">

<h2>Thanh toán</h2>
<p>Ghi chú: {{ $orderNote ?? 'Không có ghi chú' }}</p>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>

    <div class="text-end mt-3">
        <a href="{{ route('menuProducts') }}" class="btn btn-secondary">
            Quay lại mua sắm
        </a>
    </div>
@else
<form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <input type="hidden" name="order_note" value="{{ $orderNote ?? '' }}" readonly>

    <table class="table table-striped align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>Chọn</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                @if($item->product)
                <tr>
                    <td>
                        <input type="checkbox" name="cart_ids[]" value="{{ $item->id }}" checked>
                    </td>
                    <td class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . ($item->product->image_url ?? 'default.png')) }}" 
                             alt="{{ $item->product->name }}" 
                             style="width: 80px; height: 80px; object-fit: cover;" 
                             class="me-3 rounded">
                        <span>{{ $item->product->name }}</span>
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price,0,',','.') }} VND</td>
                    <td>{{ number_format($item->quantity * $item->product->price,0,',','.') }} VND</td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div class="mb-3">
        <label for="payment-method" class="form-label">Phương thức thanh toán:</label>
        <select name="method" id="payment-method" class="form-select" required>
            <option value="cash">Tiền mặt</option>
            <option value="momo">Momo</option>
            <option value="card">Credit Card</option>
        </select>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">Xác nhận thanh toán</button>
    </div>
</form>
@endif


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
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>