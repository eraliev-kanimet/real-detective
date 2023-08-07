<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
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

    public function ratingLikeOrDislikeUpdate(Request $request)
    {
        $data = $request->validate([
            'rating' => ['required', 'numeric'],
            'likes' => ['required', 'numeric'],
            'dislikes' => ['required', 'numeric'],
        ]);

        $rating = Rating::find($request->get('rating'));

        $rating?->update($data);

        return response()->json();
    }

    public function ratingViewsUpdate(Rating $rating)
    {
        $rating->update([
            'views' => $rating->views + 1
        ]);

        return response()->json();
    }
}
