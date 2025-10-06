<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('auth.forgot-password'); // bạn đã tạo sẵn
    }
}
