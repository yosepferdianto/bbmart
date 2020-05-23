<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class ShowDashboard extends BaseController
{
    public function index()
    {
        return view('admin.dashboard.dashboard');
    }
}
