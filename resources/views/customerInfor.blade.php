<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Information</title>
    <link rel="stylesheet" href="{{ asset('css/intro.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epunda+Slab:ital,wght@0,300..900;1,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <header class="header">
        <!-- Logo -->
        <div class="header-logo" title="ShopHiang">
            <a><img src="{{ asset('images/logo.png') }}" alt="ShopHiang Logo" style="width: 150px; height:100px;"></a>
        </div>
   </header>

    <div class="header-menu" >
        <nav class="header-nav">
            <a href="{{ url('/') }}" class="header-nav-link" title="Trang chủ" ><b>Trang chủ</b></a>
        </nav>
    </div>

    <body class="bg-light">

<div class="container py-5">
  <h2 style="color: #333; text-align: center; font-weight: bold">Thông tin Người Dùng</h2>

  <div class="card shadow-lg rounded-4 mx-auto" style="max-width: 800px;">
    <div class="card-body">
      <table class="table table-borderless align-middle">
        <tbody>
          <tr>
            <th class="text-primary">Tên</th>
            <td>{{ $user->name }}</td>
          </tr>
          <tr>
            <th class="text-primary">Email</th>
            <td>{{ $user->email }}</td>
          </tr>
          <tr>
            <th class="text-primary">Số điện thoại</th>
            <td>{{ $user->phone }}</td>
          </tr>
          <tr>
            <th class="text-primary">Địa chỉ</th>
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
          </tr>
        </tbody>
      </table>

<!-- Modal chỉnh sửa -->
<div class="d-flex justify-content-end mt-3">
    <!-- Nút mở modal -->
    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal">
        Sửa
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('profile.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Cập nhật thông tin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
              <label class="form-label">Tên</label>
              <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Số điện thoại</label>
              <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
          </div>
          <div class="mb-3">
              <label class="form-label">Số nhà</label>
              <input type="text" name="homeAddress" class="form-control" value="{{ $user->address->homeAddress ?? '' }}">
          </div>

          <div class="mb-3">
              <label class="form-label">Tỉnh/Thành phố</label>
              <select name="province_id" class="form-select">
                  <option value="">-- Chọn Tỉnh/TP --</option>
                  @foreach($provinces as $province)
                      <option value="{{ $province->id }}" 
                          {{ $user->address && $user->address->province_id == $province->id ? 'selected' : '' }}>
                          {{ $province->name }}
                      </option>
                  @endforeach
              </select>
          </div>
          <div class="mb-3">
              <label class="form-label">Quận/Huyện</label>
              <select name="district_id" class="form-select">
                  <option value="">-- Chọn Quận/Huyện --</option>
                  @foreach($districts as $district)
                      <option value="{{ $district->id }}" 
                          {{ $user->address && $user->address->district_id == $district->id ? 'selected' : '' }}>
                          {{ $district->name }}
                      </option>
                  @endforeach
              </select>
          </div>
          <div class="mb-3">
              <label class="form-label">Phường/Xã</label>
              <select name="ward_id" class="form-select">
                  <option value="">-- Chọn Phường/Xã --</option>
                  @foreach($wards as $ward)
                      <option value="{{ $ward->id }}" 
                          {{ $user->address && $user->address->ward_id == $ward->id ? 'selected' : '' }}>
                          {{ $ward->name }}
                      </option>
                  @endforeach
              </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>