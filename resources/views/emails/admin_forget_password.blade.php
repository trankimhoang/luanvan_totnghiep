<h1>Forget Password Email</h1>

Nhấn vào link dưới đây để lấy lại mật khẩu
<a href="{{ route('admin.reset.password.get', ['token' => $token, 'email' => $email]) }}">Đặt lại mật khẩu</a>
