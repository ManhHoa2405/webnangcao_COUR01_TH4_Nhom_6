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
    <h1 class="mb-4">Danh sách sản phẩm</h1>

    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Ảnh sản phẩm</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                <td>
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="Ảnh sản phẩm" width="80" class="rounded shadow-sm">
                </td>
                <td>
                    <!-- Nút Sửa -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                        <i class="bi bi-pencil-square"></i> Sửa
                    </button>

                    <!-- Nút Xóa -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">
                        <i class="bi bi-trash"></i> Xóa
                    </button>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel{{ $product->id }}">Sửa sản phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Giá</label>
                                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Số lượng</label>
                                    <input type="number" name="qualityStock" class="form-control" value="{{ $product->qualityStock }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Danh mục</label>
                                    <input type="text" name="category" class="form-control" value="{{ $product->category }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select name="status" class="form-select">
                                        <option value="available" {{ $product->status == 'available' ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="not available" {{ $product->status == 'not available' ? 'selected' : '' }}>Không hoạt động</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ảnh sản phẩm</label><br>
                                    <img src="{{ asset('storage/' . $product->image_url) }}" width="100" class="mb-2 rounded shadow-sm">
                                    <input type="file" name="image_url" class="form-control">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Xóa -->
            <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteProductModalLabel{{ $product->id }}">Xác nhận xóa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>

                        <div class="modal-body">
                            Bạn có chắc chắn muốn xóa sản phẩm <strong>{{ $product->name }}</strong> không?
                        </div>

                        <div class="modal-footer">
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
    {{ $products->links('pagination::bootstrap-5') }}
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
