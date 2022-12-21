<?php

namespace App\Jobs;

use App\Mail\AnswerToApplicationMail;
use App\Models\Answer;
use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AnswerToApplicationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Application $application;
    public Answer $answer;

    public function __construct(Application $application, Answer $answer)
    {
        $this->application = $application;
        $this->answer = $answer;
    }


    public function handle()
    {
        Mail::to($this->application->user)->send(new AnswerToApplicationMail($this->answer));
    }
}
