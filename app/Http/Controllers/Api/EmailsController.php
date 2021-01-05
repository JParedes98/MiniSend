<?php

namespace App\Http\Controllers\Api;

use Mail;
use Auth;
use App\Models\User;
use App\Mail\MailTemplate;
use Illuminate\Http\Request;
use App\Models\EmailActivity;
use App\Models\Recipient;
use App\Http\Controllers\Controller;

class EmailsController extends Controller
{
    public function GetAllMyEmails() {
        $user = Auth::user();
        $contact = Recipient::where('email', $user->email)->first();

        if($contact) {
            $emails = EmailActivity::where('sender_id', $user->id)
                                    ->orWhere('recipient_id', $contact->id)
                                    ->with('sender')
                                    ->with('recipient')
                                    ->orderBy('updated_at', 'desc')
                                    ->get();

            return response()->json($emails, 200);
        }else {
            $emails = EmailActivity::where('sender_id', $user->id)
                        ->with('sender')
                        ->with('recipient')
                        ->orderBy('updated_at', 'desc')
                        ->get();

            return response()->json($emails, 200);
        }
    }

    public function GetAllMyInboxEmails() {
        $user = Auth::user();
        $emails = EmailActivity::where('recipient_id', $user->id)
                    ->with('sender')
                    ->with('recipient')
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return response()->json($emails, 200);
    }

    public function GetAllMySentEmails() {
        $user = Auth::user();
        $emails = EmailActivity::where('sender_id', $user->id)
                    ->with('sender')
                    ->with('recipient')
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return response()->json($emails, 200);
    }

    public function SaveAndSendEmail(Request $request) {
        $request->validate([
            'subject' => 'nullable|string|max:250',
            'text' => 'nullable|string',
            'html' => 'nullable|string',

            'recipient' => 'required|string|max:250',
        ]);

        $user = Auth::user();
        $contact = Recipient::firstOrCreate([
            'email' => $request->recipient
        ]);

        if(!$user->contacts->contains($contact->id)) {
            $user->contacts()->attach($contact);
        }

        $mail = EmailActivity::create([
            'subject' => $request->subject,
            'text' => $request->text,
            'html' => $request->html,

            'sender_id' => $user->id,
            'recipient_id' => $contact->id,
        ]);

        $data = EmailActivity::find($mail->id);

        Mail::send(new MailTemplate($data, $data->sender, $data->recipient));

        return response()->json($mail, 200);
    }
}
