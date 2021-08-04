<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;

class HomeController extends Controller
{
    public function index() {

        $user = Auth::user();

        Mail::to($user->email)->send(new SendNewMail());

        return view('admin.home');
    }
}
