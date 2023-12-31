<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Models\Rating;
use App\Models\SiteForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Telegram\Bot\Laravel\Facades\Telegram;

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

        if (config('mail.mailers.smtp.username')) {
            Mail::to(config('app.email'))->send(new ContactFormMail(
                (string)$request->get('name'),
                (string)$request->get('number'),
                (string)$request->get('question', ''),
            ));
        }

        $telegram_chat = config('app.telegram_chat');

        if ($telegram_chat) {
            try {
                $message = "Имя: {$request->get('name')}\n\n";
                $message .= "Телефон: {$request->get('number')}";

                if ($request->has('question')) {
                    $message .= "\n\nВопрос: {$request->get('question')}\n";
                }

                Telegram::sendMessage([
                    'chat_id' => $telegram_chat,
                    'text' => $message,
                ]);
            } catch (Exception) {}
        }

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
