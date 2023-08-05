<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteForm;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function callback(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'number' => ['required'],
            'question' => ['nullable'],
        ]);

        SiteForm::create([
            'type' => 'callback',
            'data' => $data
        ]);

        return response()->json();
    }
}
