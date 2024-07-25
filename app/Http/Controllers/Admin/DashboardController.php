<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }

    
}
