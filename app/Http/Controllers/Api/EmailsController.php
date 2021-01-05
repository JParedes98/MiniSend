<?php

namespace App\Http\Controllers\Api;

use DB;
use Mail;
use Auth;
use App\Models\User;
use App\Models\Recipient;
use App\Mail\MailTemplate;
use Illuminate\Http\Request;
use App\Models\EmailActivity;
use App\Models\EmailAttachment;
use App\Http\Controllers\Controller;

class EmailsController extends Controller
{
    public function GetAllEmails() {
        $emails = EmailActivity::with('sender')->with('recipient')->get();
        return response()->json($emails);
    }

    public function GetAllMyEmails() {
        $user = Auth::user();
        $contact = Recipient::where('email', $user->email)->first();

        if($contact) {
            $emails = EmailActivity::where('sender_id', $user->id)
                                    ->orWhere('recipient_id', $contact->id)
                                    ->with('sender')
                                    ->with('recipient')
                                    ->orderBy('created_at', 'desc')
                                    ->get();

            return response()->json($emails, 200);
        }else {
            $emails = EmailActivity::where('sender_id', $user->id)
                        ->with('sender')
                        ->with('recipient')
                        ->orderBy('created_at', 'desc')
                        ->get();

            return response()->json($emails, 200);
        }
    }

    public function GetEmail($email_id) {
        $email = EmailActivity::findOrFail($email_id)
                        ->with('sender')
                        ->with('recipient')
                        ->orderBy('created_at', 'desc')
                        ->first();

        return response()->json($email, 200);
    }

    public function GetAllMyInboxEmails() {
        $user = Auth::user();
        $emails = EmailActivity::where('recipient_id', $user->id)
                    ->with('sender')
                    ->with('recipient')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json($emails, 200);
    }

    public function GetAllMySentEmails() {
        $user = Auth::user();
        $emails = EmailActivity::where('sender_id', $user->id)
                    ->with('sender')
                    ->with('recipient')
                    ->orderBy('created_at', 'desc')
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

        if($request->hasFile('file')) {
            $file = $request->file('file');
    
            if ($file->getSize() > 5242880) {
                return response()->json([
                    'message' => 'Image too large, size: ' . $file->getSize()/1024/1024 . 'MB, max file size allowed: 5MB'
                ], 413);
            }
        }

        $user = Auth::user();
        $contact = Recipient::firstOrCreate([
            'email' => $request->recipient
        ]);

        if($user->contacts && !$user->contacts->contains($contact->id)) {
            $user->contacts()->attach($contact);
        }

        $mail = EmailActivity::create([
            'subject' => $request->subject,
            'text' => $request->text,
            'html' => $request->html,

            'sender_id' => $user->id,
            'recipient_id' => $contact->id,
        ]);

        if($request->hasFile('file')) {
            $file_name = $file->getClientOriginalName();
            $file_object = file_get_contents($file);
            $extension = $request->file('file')->getMimeType();
    
            $file = EmailAttachment::create([
                'email_id' => $mail->id,
                'name' => $file_name,
                'object' => $file_object,
                'extension' => $extension,
            ]);
        }


        $data = EmailActivity::find($mail->id);
            Mail::send(new MailTemplate($data, $data->sender, $data->recipient, $data->attachment));
        return response()->json($mail, 200);
    }

    public function SearchBySender($search) {
        $sender = User::where('name', 'LIKE', "%{$search}%")->firstOrFail();
        $emails = $sender->emails;

        return response()->json($emails, 200);
    }
}
