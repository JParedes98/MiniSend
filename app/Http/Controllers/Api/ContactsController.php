<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Models\Recipient;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function GetMyContacts() {
        $contacts = Auth::user()->contacts;

        return response()->json($contacts);
    }

    public function SaveContact(Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $contact = Recipient::firstOrCreate([
            'email' => $request->email
        ]);

        $user = Auth::user();

        if(!$user->contacts->contains($contact->id)) {
            $user->contacts()->attach($contact);
        } else {
            return response()->json([
                'message' => 'This contact already has been added before.'
            ], 409);
        }

        return response()->json($contact);
    }

    public function UpdateContact(Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'new_email' => 'required|string|email|max:255',
        ]);

        $user = Auth::user();

        $old_contact = Recipient::where('email', $request->email)->firstOrFail();

        $user->contacts()->detach($old_contact);

        $new_contact = Recipient::firstOrCreate([
            'email' => $request->new_email
        ]);

        if(!$user->contacts->contains($new_contact->id)) {
            $user->contacts()->attach($new_contact);
        } else {
            return response()->json([
                'message' => 'This contact already has been added before.'
            ], 409);
        }

        return response()->json($new_contact);
    }

    public function DetachContact($contact_id) {
        $res = Auth::user()->contacts()->detach($contact_id);

        return response()->json($res, 200);
    }
}
