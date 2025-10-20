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

<div class="admin-content">
    <div class="container mt-4">
        <h2 class="mb-3">Sửa thông tin khách hàng</h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <table class="table table-bordered">
                <tr>
                    <th style="width: 200px;">Tên</th>
                    <td>
                        <input type="text" name="name" class="form-control" 
                            value="{{ old('name', $user->name) }}">
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="email" name="email" class="form-control" 
                            value="{{ old('email', $user->email) }}">
                    </td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td>
                        <input type="text" name="phone" class="form-control" 
                            value="{{ old('phone', $user->phone ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <th>Tỉnh/Thành phố</th>
                    <td>
                        <select name="province_id" class="form-select">
                            <option value="">-- Chọn Tỉnh/TP --</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" 
                                    {{ $user->address && $user->address->province_id == $province->id ? 'selected' : '' }}>
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Quận/Huyện</th>
                    <td>
                        <select name="district_id" class="form-select">
                            <option value="">-- Chọn Quận/Huyện --</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" 
                                    {{ $user->address && $user->address->district_id == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>Phường/Xã</th>
                    <td>
                        <select name="ward_id" class="form-select">
                            <option value="">-- Chọn Phường/Xã --</option>
                            @foreach($wards as $ward)
                                <option value="{{ $ward->id }}" 
                                    {{ $user->address && $user->address->ward_id == $ward->id ? 'selected' : '' }}>
                                    {{ $ward->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Địa chỉ cụ thể</th>
                    <td>
                    <input title="Số nhà - tên đường" type="text" name="homeAddress" class="form-control"
                           value="{{ old('homeAddress', $user->address->homeAddress ?? '') }}">
                </td>
            </tr>
        </table>

            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
