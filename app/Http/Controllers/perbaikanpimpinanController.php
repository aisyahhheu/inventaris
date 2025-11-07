<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('perbaikanpimpinan'); // This will load the 'perbaikanpimpinan.blade.php' file
    }
}