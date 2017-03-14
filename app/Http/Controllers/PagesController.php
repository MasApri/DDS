<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class PagesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function homepage() {
        $halaman = "home";
        $data = ['halaman' => $halaman];
        return view('pages/homepage', $data);
    }

    public function beban() {
        $halaman = "beban";
        $data = ['halaman' => $halaman];
        return view('pages/beban', $data);
    }

    public function about() {
        $halaman = "about";
        $data = ['halaman' => $halaman];
        return view('pages/about', $data);
    }

}
