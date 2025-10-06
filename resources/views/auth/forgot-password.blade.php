<h1>Quên mật khẩu</h1>
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" placeholder="Nhập email" required>
    <button type="submit">Gửi link reset</button>
</form>
