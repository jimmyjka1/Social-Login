<?php

namespace App\Http\Controllers;

use App\Jobs\MatchSendEmail;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail(){
        $users = User::get();
        // $emailJob = new MatchSendEmail();
        // dispatch($emailJob);
        foreach ($users as $user) {
            $emailJob = new MatchSendEmail($user -> email);
            dispatch($emailJob);
        }

    }
}
