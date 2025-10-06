<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zalando+Sans+Expanded:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<header class="header">
    <!-- Logo -->
    <div class="logo-shop">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Diang Drink Logo" title="Trở về trang chủ">
        </a>
    </div>

    <!-- Actions -->
    <div class="header-actions">
        <a class="header-action" href="{{ route('products.create') }}" title="Thêm sản phẩm">
            <img src="{{ asset('images/add.png') }}" alt="add-icon" title="Thêm sản phẩm">
            <div class="add">Thêm sản phẩm</div>
        </a>
        <a class="header-action" href="{{ route('products.index') }}" title="Quản lý sản phẩm" style="text-decoration: none; color: #333">
            <img src="{{ asset('images/edit.png') }}" alt="edit-icon" title="Chỉnh sửa sản phẩm">
            <div class="edit">Quản lý sản phẩm</div>
        </a>
        <a href="{{ route('users.index') }}" class="header-action">
            <img src="{{ asset('images/relationship.png') }}" alt="relationship-icon" title="Quản lý khách hàng">
            <span>Quản lý khách hàng</span>
        </a>
        <a href="#" class="header-action">
            <img src="{{ asset('images/clipboard.png') }}" alt="status-icon" title="Xem đơn hàng">
            <span>Trạng thái đơn hàng</span>
        </a>
        <a href="#" class="header-action">
            <img src="{{ asset('images/profit.png') }}" alt="profit-icon" title="Xem doanh số">
            <span>Doanh số</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;" >
            @csrf
            <div class="header-action">
                <img src="{{ asset('images/logout.png') }}" alt="logout-icon" title="Đăng xuất">
                <button type="submit" class="btn btn-link" style="border:none; background:none; cursor:pointer; text-decoration: none;color: #333;font-size: 15px;font-weight: bold;line-height: 1.6;">
                    <span>Đăng xuất</span>
                </button></div>
        </form>

        {{-- <a href="{{ route('logout') }}" class="header-action">
            <img src="{{ asset('images/logout.png') }}" alt="logout-icon" title="Đăng xuất">
            <span>Đăng xuất</span>
        </a> --}}
    </div>
</header>

<div class="customer-reminder">
    <h3>Ghi nhớ:</h3>
    <p>
        Mọi quyết định của chúng ta cần đặt <strong>khách hàng</strong> lên hàng đầu.  
        Hãy phục vụ tận tâm, phản hồi nhanh chóng và tạo trải nghiệm tốt nhất cho họ.  
    </p>
</div>

<!-- Nội dung quản lý sản phẩm -->
<div class="admin-content">
    <div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h4>Chi tiết đơn hàng #{{ $order->id }}</h4>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Thông tin khách hàng</h5>
                    <p><strong>Tên:</strong> {{ $order->user->name ?? 'Khách vãng lai' }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email ?? 'Không có' }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Thông tin đơn hàng</h5>
                    <p><strong>Trạng thái:</strong> <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span></p>
                    <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VND</p>
                    <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <h5 class="mb-3">Sản phẩm trong đơn hàng</h5>
            <table class="table table-bordered align-middle text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->details as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detail->product_name ?? $detail->product->name ?? 'Sản phẩm đã xóa' }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $detail->product->image_url) }}" alt="Ảnh sản phẩm" width="80" class="rounded shadow-sm">
                            </td>
                            <td>{{ number_format($detail->product_price, 0, ',', '.') }} VND</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->product_price * $detail->quantity, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>
</div>



<script>
    const links = document.querySelectorAll(".header-action");
    const currentLink = window.location.pathname;

    links.forEach(link => {
        if (link.getAttribute("href") === currentLink) {
            link.classList.add("active");
        }
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
