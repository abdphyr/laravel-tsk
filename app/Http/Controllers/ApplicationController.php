<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationCreatedMail;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file_name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('files', $file_name, 'public');
        }
    
        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required',
            'file' => 'nullable|file|mimes:jpg,png,pdf'
        ]);

        $application = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null
        ]);
        $manager  = User::first();

        Mail::to($manager)->queue((new ApplicationCreatedMail($application))->delay(10));
        return redirect()->back();
    }
}
