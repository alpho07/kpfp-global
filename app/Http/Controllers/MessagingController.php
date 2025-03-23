<?php

namespace App\Http\Controllers;

use App\Mail\MessagingMail;
use App\Models\Messaging;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MessagingController extends Controller
{
    public function index(Request $r,$sender, $receiver)
    {


        if ($r->has('inbox')) {
            $new_sender = $receiver;
            $new_receiver = $sender;
        } else {
            $new_sender = $sender;
            $new_receiver = $receiver;
        }

            // Fetch the user based on the receiver ID
            $users = User::where('id',  $new_receiver)->first();
            // Fetch messages between the sender and receiver
            $message = Messaging::where(function ($query) use ($new_sender,  $new_receiver) {
                $query->where('sender_id', $new_sender)
                    ->where('receiver_id', $new_receiver);
            })->orWhere(function ($query) use ($new_sender,  $new_receiver) {
                $query->where('sender_id', $new_receiver)
                    ->where('receiver_id',   $new_sender);
            })->get();


        return view('admin.enrollments.messaging', compact('users', 'new_sender', 'new_receiver', 'message'));
    }




    public function index_inbox(Request $r, $sender, $receiver)
    {

        if ($r->has('inbox')) {
            $new_sender = $receiver;
            $new_receiver = $sender;
        } else {
            $new_sender = $sender;
            $new_receiver = $receiver;
        }

        // Fetch the user based on the receiver ID
        $users = User::where('id',  $new_receiver)->first();
        // Fetch messages between the sender and receiver
        $message = Messaging::where(function ($query) use ($new_sender,  $new_receiver) {
            $query->where('sender_id', $new_sender)
                ->where('receiver_id', $new_receiver);
        })->orWhere(function ($query) use ($new_sender,  $new_receiver) {
            $query->where('sender_id', $new_receiver)
                ->where('receiver_id',   $new_sender);
        })->get();

        return view('messaging', compact('users', 'new_sender', 'new_receiver', 'message'));
    }

    public function store(Request $r, $sender, $receiver)
    {

        if ($r->has('inbox')) {
            $new_sender = $receiver;
            $new_receiver = $sender;
        } else {
            $new_sender = $sender;
            $new_receiver = $receiver;
        }


        $message = $r->message;

        Messaging::create([
            'sender_id' =>  $new_sender,
            'receiver_id' => $new_receiver,
            'message' => $message,
            'user' => $new_sender,
        ]);

        $this->sendEmail($new_sender, $new_receiver);

        $redirect = redirect()->back()->with(['success' => 'Message sent!']);

        // Check if 'inbox' parameter is present in the URL
        if ($r->has('inbox')) {
            $inboxValue = $r->input('inbox');
            // Add 'inbox' parameter to the session flash data
            $redirect->with('inbox', $inboxValue);
        }

        return $redirect;
    }


    public function sendEmail($sender, $receiver)
    {
        $email  = User::where('id', $receiver)->first();

        $mail = new MessagingMail($sender, $receiver);

        Mail::to($email->email)->send($mail);
    }
}
