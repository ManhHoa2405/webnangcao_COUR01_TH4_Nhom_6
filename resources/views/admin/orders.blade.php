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
    <h1 class="mb-4">Danh sách đơn hàng</h1>

    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} VND</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">Xem</a>
                        <!-- Bạn có thể thêm nút xử lý trạng thái, xóa nếu muốn -->
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Chưa có đơn hàng nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $orders->links('pagination::bootstrap-5') }}
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
