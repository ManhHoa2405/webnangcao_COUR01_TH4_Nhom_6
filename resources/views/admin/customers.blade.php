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
        <a href="#" class="header-action">
            <img src="{{ asset('images/relationship.png') }}" alt="relationship-icon" title="Quản lý khách hàng">
            <span>Quản lý khách hàng</span>
        </a>
        <a href="{{ route('admin.orders.index')" class="header-action">
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
    </div>
</header>

<div class="customer-reminder">
    <h3>Ghi nhớ:</h3>
    <p>
        Mọi quyết định của chúng ta cần đặt <strong>khách hàng</strong> lên hàng đầu.  
        Hãy phục vụ tận tâm, phản hồi nhanh chóng và tạo trải nghiệm tốt nhất cho họ.  
    </p>
</div>

<div class="customers-content">
<div class="container mt-4">
    <h2 class="mb-4">Danh sách khách hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover align-middle text-center" style="width: 100%">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Mật khẩu</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @php
                            $address = $user->address;
                            if ($address) {
                                $province = DB::table('province')->where('id', $address->province_id)->value('name');
                                $district = DB::table('district')->where('id', $address->district_id)->value('name');
                                $ward     = DB::table('wards')->where('id', $address->ward_id)->value('name');
                            }
                        @endphp

                        @if ($address)
                            {{ $address->homeAddress }},
                            {{ $ward }},
                            {{ $district }},
                            {{ $province }}
                        @else
                            (Chưa có địa chỉ)
                        @endif
                    </td>

                    <td>********</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa user này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links('pagination::bootstrap-5') }}
</div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
