<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplatesController extends Controller
{
    public function GetMyTemplates() {
        $templates = Auth::user()->templates;

        return response()->json($templates);
    }

    public function GetTemplate($template_id) {
        $template = Template::findOrFail($template_id);

        return response()->json($template, 200);
    }

    public function SaveTemplate(Request $request) {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'content' => 'required'
        ]);

        $template = Template::create([
            'owner_id' => Auth::user()->id,
            'name' => $request->name,
            'content' => $request->content
        ]);

        return response()->json($template, 200);
    }

    public function UpdateTemplate(Request $request) {
        $request->validate([
            'template_id' => 'required|integer',
            'name' => 'required|string|min:3|max:100',
            'content' => 'required'
        ]);

        $template = Template::findOrFail($request->template_id)->update([
            'name' => $request->name,
            'content' => $request->content
        ]);

        return response()->json($template, 200);
    }

    public function DeleteTemplate($template_id) {
        $template = Template::findOrFail($template_id)->delete();

        return response()->json($template, 200);
    }
}
