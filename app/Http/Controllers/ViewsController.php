<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except([
            'website'
        ]);;
    }

    public function website() {
        return view('website');
    }

    public function index() {
        return view('pages.home');
    }
}
