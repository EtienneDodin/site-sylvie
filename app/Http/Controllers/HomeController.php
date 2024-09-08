<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creation;
use App\Models\Image;

class HomeController extends Controller
{
    public function index()
    {
        $creations = Creation::all();
        // remplacer

        return view('index', compact('creations'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function myWork()
    {
        return view('work');
    }

    public function legalNotice()
    {
        return view('legal-notice');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }
}
