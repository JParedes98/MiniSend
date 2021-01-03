<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplatesController extends Controller
{
    public function GetMyTemplates() {
        $templates = Auth::user()->templates;

        return response()->json($templates);
    }
}
