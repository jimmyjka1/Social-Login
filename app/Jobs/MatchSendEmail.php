<?php

namespace App\Jobs;

use App\Mail\HelloEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MatchSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $to_mail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($to)
    {
        $this -> to_mail = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new HelloEmail();
        Mail::to($this -> to_mail) -> send($email);
    }
}
