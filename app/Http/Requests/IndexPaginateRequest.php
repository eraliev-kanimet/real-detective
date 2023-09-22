<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexPaginateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => ['nullable', 'numeric'],
            'page' => ['nullable', 'numeric'],
        ];
    }
}
