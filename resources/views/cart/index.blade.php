<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="{{ asset('css/detailProduct.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epunda+Slab:ital,wght@0,300..900;1,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="header-logo" title="ShopHiang">
            <a><img src="{{ asset('images/logo.png') }}" alt="ShopHiang Logo" style="width: 150px; height:100px;"></a>
        </div>
        <div class="header-search" title="Tìm kiếm sản phẩm">
            <input type="text" placeholder="Tìm kiếm sản phẩm..." class="search-input">
            <button class="header-search-btn">
                <img src="{{ asset('images/search.png') }}" alt="search-icon">
            </button>
        </div>
        <div class="header-actions">
            <a href="tel:0989 888 888" title="Goi ngay" class="header-action">
                <img src="{{ asset('images/phone.png') }}" alt="Nhấn để gọi">
                <span>0989 888 888</span>
            </a>
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

    <!-- Nội dung giỏ hàng -->
<div class="container my-4">
    <h2>Giỏ hàng của bạn</h2>

    @if($carts->count() > 0)
        <div class="row g-3">
            @foreach($carts as $item)
            <div class="col-12">
                <div class="card p-3 d-flex flex-row align-items-center">
                    <img src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}" style="width: 100px; height: 100px; object-fit: cover;" class="me-3">
                    
                    <div class="flex-grow-1">
                        <h5>{{ $item->product->name }}</h5>
                        <p>Đơn giá: {{ number_format($item->product->price,0,',','.') }} VND</p>
                        <div class="d-flex align-items-center mb-2">
                            <button class="btn btn-outline-secondary btn-sm decrease-btn me-1" data-id="{{ $item->id }}">-</button>
                            <input type="number" class="form-control text-center quantity-input me-1" value="{{ $item->quantity }}" min="1" max="{{ $item->product->qualityStock }}" style="width: 60px;" data-id="{{ $item->id }}">
                            <button class="btn btn-outline-secondary btn-sm increase-btn me-2" data-id="{{ $item->id }}">+</button>
                            <span><strong>Tổng: {{ number_format($item->quantity * $item->product->price,0,',','.') }} VND</strong></span>
                        </div>
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Box ghi chú -->
        <div class="my-3">
            <label for="order-note" class="form-label"><strong>Ghi chú đơn hàng:</strong></label>
            <textarea class="form-control" id="order-note" name="order_note" rows="3" placeholder="Nhập yêu cầu đặc biệt hoặc lưu ý khi giao hàng..."></textarea>
        </div>

        <div class="text-end mt-3">
            <h4>Tổng tiền: {{ number_format($carts->sum(fn($i)=>$i->quantity * $i->product->price),0,',','.') }} VND</h4>
            <a href="{{ url('/') }}" class="btn btn-secondary">Tiếp tục mua hàng</a>
            <a href="{{ route('checkout.index') }}?order_note=" class="btn btn-success" 
                onclick="this.href=this.href+encodeURIComponent(document.getElementById('order-note').value)">
                Thanh toán
            </a>

        </div>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Quay lại mua sắm</a>
    @endif
</div>

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

<script>

    // Cập nhật ghi chú khi submit
    const checkoutForm = document.querySelector('form[action="{{ route("checkout.index") }}"]');
    const noteTextarea = document.getElementById('order-note');
    const noteInput = document.getElementById('order-note-input');

    checkoutForm.addEventListener('submit', function() {
        noteInput.value = noteTextarea.value;
    });
    // Xử lý nút +/-
    document.querySelectorAll('.decrease-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = document.querySelector(`.quantity-input[data-id='${id}']`);
            if(parseInt(input.value) > 1){
                input.value = parseInt(input.value) - 1;
                input.dispatchEvent(new Event('change'));
            }
        });
    });
    document.querySelectorAll('.increase-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = document.querySelector(`.quantity-input[data-id='${id}']`);
            const max = parseInt(input.max);
            if(parseInt(input.value) < max){
                input.value = parseInt(input.value) + 1;
                input.dispatchEvent(new Event('change'));
            }
        });
    });

    // Xử lý cập nhật quantity AJAX
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const id = this.dataset.id;
            const quantity = parseInt(this.value);

            fetch(`/cart/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({quantity})
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.cartCount;
                location.reload(); // Hoặc update DOM nếu muốn mà không reload
            });
        });
    });
</script>

</body>
</html>
