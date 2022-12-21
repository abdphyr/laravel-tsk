<?php

namespace App\Http\Controllers;

use App\Jobs\AnswerToApplicationMailJob;
use App\Jobs\ApplicationCreatedMailJob;
use App\Models\Application;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function create(Application $application)
    {
        return view('answer', ['application' => $application]);
    }

    public function store(Application $application, Request $request)
    {
        $request->validate(["body" => 'required']);

        $answer = $application->answer()->create([
            "body" => $request->body
        ]);
        AnswerToApplicationMailJob::dispatch($application, $answer);
        return redirect('manager');
    }
}
