{{-- Modal login/register --}}
<div id="authModal" class="modal">
    <div class="modal-content">
        <span id="closeModal" class="close-btn">&times;</span>

        {{-- Login Form --}}
        <div id="loginForm">
            <h2>Đăng nhập</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Prefill email: ưu tiên old('email') rồi cookie --}}
                <input type="email" name="email" placeholder="Email" required 
                value="{{ old('email', request()->cookie('remembered_email')) }}">

                <div class="password-wrapper">
                    <input type="password" id="loginPassword" name="password" placeholder="Mật khẩu" required>
                    <img src="{{ asset('images/hidden.png') }}"
                        alt="Toggle Password"
                        class="toggle-password"
                        onclick="togglePassword('loginPassword', this)">
                </div>

                <div>
                    <label class="remember-me">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <p>Nhớ tài khoản</p>
                    </label>
                </div>
                <div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Quên mật khẩu?
                        </a>
                    @endif
                </div>
                <button type="submit">Đăng nhập</button>
            </form>
            <p class="switch-text">
                Chưa có tài khoản?
                <a href="#" id="switchToRegister">Đăng ký ngay</a>
            </p>
        </div>

        {{-- Register Form --}}
<div id="registerForm" style="display:none;">
    <h2>Đăng ký</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Họ và tên" required value="{{ old('name') }}">
        <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">

        {{-- phone --}}
        <input type="text" name="phone" placeholder="Số điện thoại" required value="{{ old('phone') }}">

        {{-- Địa chỉ --}}
        <input type="text" name="homeAddress" placeholder="Số nhà" value="{{ old('homeAddress') }}">

        <div class="address-select">
            <select name="province_id" id="province" required>
                <option value="">-- Tỉnh/TP --</option>
            </select>

            <select name="district_id" id="district" required>
                <option value="">-- Quận/Huyện --</option>
            </select>

            <select name="ward_id" id="ward" required>
                <option value="">-- Phường/Xã --</option>
            </select>
        </div>

        <div class="password-wrapper">
            <input type="password" id="regPassword" name="password" placeholder="Mật khẩu" required>
            <img src="{{ asset('images/hidden.png') }}"
                alt="Toggle Password"
                class="toggle-password"
                onclick="togglePassword('regPassword', this)">
        </div>

        <div class="password-wrapper">
            <input type="password" id="regPasswordConfirm" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
            <img src="{{ asset('images/hidden.png') }}"
                alt="Toggle Password"
                class="toggle-password"
                onclick="togglePassword('regPasswordConfirm', this)">
        </div>

        <button type="submit">Đăng ký</button>
    </form>
    <p class="switch-text">
        Đã có tài khoản?
        <a href="#" id="switchToLogin">Đăng nhập</a>
    </p>
</div>


<script>
const openLoginbtn = document.getElementById('openLogin');
const authModal = document.getElementById('authModal');
const closeModal = document.getElementById('closeModal');
const switchToRegister = document.getElementById('switchToRegister');
const switchToLogin = document.getElementById('switchToLogin');

if (openLoginbtn) { // chi chay khi co trong DOM 
    openLoginbtn.addEventListener('click', (e) => { //lắng nghe hành động là click hthu modal e - event
        e.preventDefault(); //ngăn hành động mặc định (reload, submit form khi click a)
        authModal.style.display = 'flex'; //hiện modal.
        showLogin();// function ở dưới
    });
}

if (closeModal) {
    closeModal.addEventListener('click', () => { // khong co su kien nao khi nhan x
        authModal.style.display = 'none'; //an modal
    });
}

window.addEventListener('click', (e) => { // su kien click ngoai modal xay ra
    if (e.target === authModal) { //dam bao dung phan khong nam ben trong modal
        authModal.style.display = 'none'; //dong modal
    }
});

function showLogin() {
    document.getElementById('loginForm').style.display = 'block'; //hthi Login
    document.getElementById('registerForm').style.display = 'none'; // an register
}

function showRegister() {
    document.getElementById('loginForm').style.display = 'none'; //hthi register
    document.getElementById('registerForm').style.display = 'block'; //an login
}

if (switchToRegister) {
    switchToRegister.addEventListener('click', (e) => { //skien click sưitchToRegister xay ra
        e.preventDefault(); //ngăn hành động mặc định (reload, submit form khi click a)
        showRegister(); // doi sang register 
    });
}

if (switchToLogin) {
    switchToLogin.addEventListener('click', (e) => {
        e.preventDefault(); //nguoc lai o tren
        showLogin();
    });
}

// Hiển/ẩn mật khẩu
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
        icon.src = "{{ asset('images/visible.png') }}";
    } else {
        input.type = "password";
        icon.src = "{{ asset('images/hidden.png') }}";
    }
}

    // Nếu server gửi session('openAuthModal') hoặc có lỗi validate, mở modal
    document.addEventListener('DOMContentLoaded', function () { //đảm bảo code chỉ chạy sau khi DOM load xong.
        @if(session('openAuthModal')) //(bảo vệ tránh lỗi khi không mở modal)
            authModal.style.display = 'flex';
            @if(session('openAuthModal') === 'register') //
                showRegister();
            @else
                showLogin();//session tồn tại nhưng không phải 'register') -> mặc định hiện login
            @endif
        @elseif($errors->any())
            // Nếu có error (ví dụ validation lỗi khi submit từ modal), mặc định mở login hoặc register
            authModal.style.display = 'flex';
            // nếu input name có old('name') -> nhiều khả năng là register
            @if(old('name'))
                showRegister(); // Hiển thị lại form đăng ký để người dùng thấy lỗi và sửa
            @else
                showLogin(); // Nếu không có old('name') -> nhiều khả năng là submit từ form Login -> hiện Login
            @endif
        @endif
    });

    document.getElementById('province').addEventListener('change', function () {
        let provinceId = this.value;
        fetch('/districts/' + provinceId)
            .then(response => response.json())
            .then(data => {
                let districtSelect = document.getElementById('district');
                districtSelect.innerHTML = '<option value="">-- Quận/Huyện --</option>';
                data.forEach(d => {
                    districtSelect.innerHTML += `<option value="${d.id}">${d.name}</option>`;
                });
                document.getElementById('ward').innerHTML = '<option value="">-- Phường/Xã --</option>';
            });
    });

    document.getElementById('district').addEventListener('change', function () {
        let districtId = this.value;
        fetch('/wards/' + districtId)
            .then(response => response.json())
            .then(data => {
                let wardSelect = document.getElementById('ward');
                wardSelect.innerHTML = '<option value="">-- Phường/Xã --</option>';
                data.forEach(w => {
                    wardSelect.innerHTML += `<option value="${w.wards_id}">${w.name}</option>`;
                });
            });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let provinceSelect = document.getElementById('province');
    let districtSelect = document.getElementById('district');
    let wardSelect = document.getElementById('ward');

    // 1. Load provinces khi mở trang
    fetch('/provinces')
        .then(res => res.json())
        .then(data => {
            data.forEach(p => {
                provinceSelect.innerHTML += `<option value="${p.id}">${p.name}</option>`;
            });
        });

    // 2. Khi chọn Tỉnh => load Quận/Huyện
    provinceSelect.addEventListener('change', function () {
        let provinceId = this.value;
        districtSelect.innerHTML = '<option value="">--  Quận/Huyện --</option>';
        wardSelect.innerHTML = '<option value="">--  Phường/Xã --</option>';

        if(provinceId){
            fetch(`/districts/${provinceId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(d => {
                        districtSelect.innerHTML += `<option value="${d.id}">${d.name}</option>`;
                    });
                });
        }
    });

    // 3. Khi chọn Quận => load Phường/Xã
    districtSelect.addEventListener('change', function () {
        let districtId = this.value;
        wardSelect.innerHTML = '<option value="">-- Phường/Xã --</option>';

        if(districtId){
            fetch(`/wards/${districtId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(w => {
                        wardSelect.innerHTML += `<option value="${w.id}">${w.name}</option>`;
                    });
                });
        }
    });
});
</script>
