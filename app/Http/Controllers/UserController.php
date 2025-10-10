<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(10);
        return view('admin.customers', compact('users'));
    }

    public function create()
    {
        return view('users.create'); 
    }

    public function store(Request $request)
    {
        $request->merge([
            'ward_id' => (int) $request->ward_id,
        ]);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:user,email', 
            'password' => 'required|min:6|confirmed',
            // validate address
            'homeAddress' => 'required|string|max:255',
            'province_id' => 'required|integer',
            'district_id' => 'required|integer',
            'ward_id'     => 'required|integer',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password' => Hash::make($request->password),
            // 'userAddress_id' => $request->userAddress_id,
            'role' => $request->role ?? 'user',
        ]);

        $user->address()->create([
            'homeAddress' => $request->homeAddress,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'ward_id'     => $request->ward_id,
        ]);

        if ($request->routeIs('register')) { 
            Auth::login($user);
            return redirect()->route('home')->with('success','Đăng ký thành công');
        }

        return redirect()->route('users.index')->with('success','Tạo user thành công');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $provinces = DB::table('province')->get();
        $districts = DB::table('district')->get();
        $wards = DB::table('wards')->get();
        return view('customerInfor', compact('user','provinces','districts','wards'));
    }

    public function edit($id)
    {
        $user = User::with('address')->findOrFail($id);
        $provinces = DB::table('province')->get();
        $districts = DB::table('district')->get();
        $wards     = DB::table('wards')->get();
        return view('admin.editCustomer', compact('user', 'provinces', 'districts', 'wards'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:user,email,' . $user->id,
            // địa chỉ optional
            'homeAddress' => 'nullable|string|max:255',
            'province_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'ward_id'     => 'nullable|integer',
        ]);

        $data = $request->only(['name','email','phone']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->filled('role')) {
            $data['role'] = $request->role;
        }

        // Cập nhật hoặc tạo mới địa chỉ
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'homeAddress' => $request->homeAddress,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'ward_id'     => $request->ward_id,
            ]
        );

        $user->update($data);
        return redirect()->route('users.index')->with('success','Cập nhật user thành công');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:user,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
            'homeAddress' => 'nullable|string|max:255',
            'province_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'ward_id'     => 'nullable|integer',
        ]);

        // cập nhật thông tin cơ bản
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // cập nhật địa chỉ
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'homeAddress' => $request->homeAddress,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'ward_id'     => $request->ward_id,
            ]
        );

        // trở về lại trang customerInfor
        return redirect()->route('users.show', $user->id)
                        ->with('success', 'Cập nhật thông tin thành công');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','Xóa user thành công');
    }

    // Xử lý login từ modal
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email','password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('adminPage');
            }
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng'])->withInput();
    }

    public function register(Request $request)
    {
        return $this->store($request); 
    }
    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
// tận dụng store() để tạo user; 
//  form register gửi tới route('register'),
//   route tới UserController@register
//  ( map register() gọi store() ).

// là user thay vì users thì 
// mọi chỗ unique:users,email đổi thành unique:user,email
//  và Model thêm protected $table = 'user';.