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

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
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
                    <button type="submit" class="btn btn-link" tyle="text-decoration: none;"">Đăng xuất</button>
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

    <div class="container my-4">
    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('storage/' . $product->image_url) }}" 
                 class="img-fluid rounded shadow" 
                 alt="{{ $product->name }}">
        </div>
        <div class="col-md-7 d-flex flex-column justify-content-center">
    <h2>{{ $product->name }}</h2>
    <p class="text-danger fw-bold">
        {{ number_format($product->price, 0, ',', '.') }} VND
    </p>
    {{-- <p><strong>Danh mục:</strong> {{ $product->category }}</p> --}}

     <!-- Chọn số lượng -->
    <div class="d-flex align-items-center w-auto mb-3">
        <button type="button" class="btn btn-outline-secondary btn-sm" id="decrease">-</button>
        <input type="number" name="quantity" id="quantity" 
            class="form-control text-center mx-1" 
            value="1" min="1" 
            max="{{ $product->qualityStock }}" 
            style="width: 60px;">
        <button type="button" class="btn btn-outline-secondary btn-sm" id="increase">+</button>
    </div>

    <p><strong>Trạng thái:</strong> 
        {{ $product->status === 'available' ? 'Còn hàng' : 'Hết hàng' }}
    </p>

    <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-form d-flex flex-column gap-2">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" id="product-quantity-{{ $product->id }}" value="1">
        <button type="submit" 
                class="btn btn-primary btn-lg w-50 align-self-start">
            <i class="bi bi-cart"></i> Thêm vào giỏ hàng
        </button>
    </form>
</div>

    </div>
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

 @include('auth-modal')

<script>
document.addEventListener('DOMContentLoaded', function(){
    const quantityInput   = document.getElementById('quantity');
    const hiddenQuantity  = document.getElementById('product-quantity-{{ $product->id }}');
    const form            = document.querySelector('.add-to-cart-form');
    const cartCountEl     = document.getElementById('cart-count');

    form.addEventListener('submit', function(e){
        e.preventDefault();

        //dong bo quantity vao hidden
        hiddenQuantity.value = quantityInput.value;
        let addQty = parseInt(quantityInput.value);

        let currentCount = parseInt(cartCountEl.textContent) || 0;
        cartCountEl.textContent = currentCount + addQty;
        cartCountEl.classList.add('bounce');
        setTimeout(() => cartCountEl.classList.remove('bounce'), 500);

        // Gửi request lên server để đồng bộ giỏ hàng
        let formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.cartCount !== undefined){
                // Nếu server trả về số chính xác -> cập nhật lại
                cartCountEl.textContent = data.cartCount;
            } else {
                console.error('Server không trả cartCount');
            }
        })
        .catch(err => console.error('Lỗi AJAX:', err));
    });

    // nut giam so luong
    document.getElementById('decrease').addEventListener('click', ()=>{
        let current = parseInt(quantityInput.value);
        if(current > 1) quantityInput.value = current - 1;
    });

    // nut tang
    document.getElementById('increase').addEventListener('click', ()=>{
        let current = parseInt(quantityInput.value);
        let max = parseInt(quantityInput.max);
        if(current < max) quantityInput.value = current + 1;
    });
});
</script>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>