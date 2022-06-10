<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class SettingController extends Controller
{
    public function getSetting() {
        $user = User::where('id', auth()->user()->id)
            ->with('wallet', 'bank', 'info', 'verify', 'loan_amount')
            ->first();
            
        return view('public.setting.index', compact(
            'user'
        ));
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function getAboutUs() {
        return view('public.setting.about_us');
    }

    public function changePassword() {
        return view('public.setting.changePassword');
    }

    public function postChangePassword(Request $request)
    {
        $error = [
            'mkcu.required' => 'Nhập mật khẩu cũ!',
            'mkmoi.required' => 'Nhập mật khẩu mới!',
            'mkmoi.min' => 'Mật khẩu phải có 6 ký tự trở lên!',
            'nhaplai.required' => 'Nhập lại mật khẩu không đúng!',
            'nhaplai.same' => 'Nhập lại mật khẩu không đúng!',
        ];
        $this->validate($request, [
            'mkcu' => 'required',
            'mkmoi' => 'required',
            'nhaplai' => 'required|same:mkmoi',
        ], $error);

        $user = User::find(auth()->user()->id);
        
        if (Hash::check($request->mkcu, $user->password)) {
            $user->password = Hash::make($request->mkmoi);
            $user->save();
            return $this->getLogout($request)->with('success', 'Đổi mật khẩu thành công. Hệ thống tự động đăng xuất!');
        }
        return back()->withErrors(['error' => 'Mật khẩu cũ không đúng!']);
    }
}