<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\NewMessageNotification;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {

        $user_id = Auth::user()->id;
        $data = array('user_id' => $user_id);

        return view('messages.broadcast', $data);
    }

    /**
     *
     */
    public function send()
    {
        // ...
        // message is being sent
        $message = new Message;
        $user_id = Auth::user()->id;
        $message->setAttribute('from', $user_id);
        $message->setAttribute('to', 2);
        $message->setAttribute('message', 'Demo message from user 1 to user 3');
        $message->save();

        // want to broadcast NewMessageNotification event
        broadcast(new NewMessageNotification($message));
        return ['status' => 'Message Sent!'];
        // ...
    }
}
