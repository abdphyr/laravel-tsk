<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Jobs\ApplicationCreatedMailJob;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    public function index()
    {
        $applications = auth()->user()->applications()->latest()->paginate(3);
        return view('applications')->with(['applications' => $applications]);
    }   

    public function store(StoreApplicationRequest $request)
    {

        if ($this->isMaySendApplication($request))
            return redirect()->back()->with('error', 'You may send application only one times in a day !');

        if ($request->hasFile('file')) {
            $file_name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('files', $file_name, 'public');
        }

        $application = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null
        ]);

        ApplicationCreatedMailJob::dispatch($application);

        return redirect()->back();
    }



    private function isMaySendApplication($request)
    {
        $oldApplication = $request->user()->applications()->latest()->first();
        if ($oldApplication) {
            $created = strtotime($oldApplication->created_at);
            $now = strtotime(now());
            // return $now - $created <= 86400;
            return $now - $created <= 10;
        }
        return false;
    }
}
