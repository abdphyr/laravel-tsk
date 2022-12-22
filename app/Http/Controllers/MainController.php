<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function manager()
    {
        $apps = Application::latest()->paginate(3);
        return view('manager')->with(['applications' => $apps]);
    }

    public function client () { return view('client'); }
}
