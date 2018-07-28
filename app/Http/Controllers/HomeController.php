<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewDashboardPeserta()
    {
        return view('peserta/dashboard');
    }

    public function viewDashboardAdmin()
    {
        return view('admin/dashboard');
    }

    public function viewError()
    {
        return view('error');
    }
}
