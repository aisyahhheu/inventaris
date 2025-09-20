<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPegawai extends Controller
{
    public function index()
    {
        return view('auth.dashboardpegawai');
    }
}