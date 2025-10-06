<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class AuthController extends Controller
{
    // Xử lý login
    public function login(Request $request)
    {
        // 1) Validate dữ liệu vào (bảo mật)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            // 'remember' không cần validate bắt buộc
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember'); // true nếu checkbox remember được tick

        // 2) Thử đăng nhập
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // phòng session fixation

            // Nếu user tick remember -> lưu cookie để nhớ email (chỉ lưu email, không lưu mật khẩu)
            // if ($remember) {
            //     // queue cookie: tên, giá trị, thời gian (phút). 60*24*30 => 30 ngày
            //     Cookie::queue('remembered_email', $request->email, 60 * 24 * 30);
            // } else {
            //     // xoá cookie nếu user không tick remember
            //     Cookie::queue(Cookie::forget('remembered_email'));
            // }

            return redirect()->intended(route('home'))->with('success', 'Đăng nhập thành công!');
        }

        // 3) Nếu sai, trả về kèm error và giữ input email, mở modal login
        return back()
            ->withErrors(['email' => 'Sai email hoặc mật khẩu.'])
            ->withInput($request->only('email'));    // giữ lại email
            // ->with('openAuthModal', 'login');      // signal để view mở modal
    }

    // Xử lý register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Tạo user (password sẽ tự cast 'hashed' nếu dùng cast password)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password), // đảm bảo hash
        ]);

        Auth::login($user); // đăng nhập tự động sau khi đăng ký

        // Xoá cookie email remembered (hoặc cập nhật nếu muốn)
        Cookie::queue(Cookie::forget('remembered_email'));

        return redirect(route('home'))->with('success', 'Đăng ký thành công!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalid session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Đã đăng xuất.');
    }
}