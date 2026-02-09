<?php

namespace App\Observers;

use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerObserver
{
    public function creating(Answer $answer)
    {
        $user = Auth::user();
        $user->allow_multiple_attempts = 1;
        $user->save();

        $answer->user_id = $user->id;
    }
}
