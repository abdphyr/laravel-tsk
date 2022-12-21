<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main(Request $request)
    {
        return $this->isManager($request) ? redirect('manager') : redirect('client');
    }

    public function manager(Request $request)
    {
        $apps = Application::latest()->paginate(3);
        return $this->isManager($request) ?
            view('manager')->with(['applications' => $apps]) : redirect('client');
    }

    public function client(Request $request)
    {
        return $this->isManager($request) ? redirect('manager') : view('client');
    }


    private function isManager($request)
    {
        return $request->user()->role->name === 'manager';
    }
}
