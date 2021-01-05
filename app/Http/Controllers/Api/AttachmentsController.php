<?php

namespace App\Http\Controllers\Api;

use Response;
use Illuminate\Http\Request;
use App\Models\EmailAttachment;
use App\Http\Controllers\Controller;

class AttachmentsController extends Controller
{
    public function GetFile($file_id) {
        $file = EmailAttachment::findOrFail($file_id);

        return Response::make($file->object, 200)->header('Content-Type', $file->extension);
    }
}
