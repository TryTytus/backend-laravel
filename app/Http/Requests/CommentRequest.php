<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => "required|string",
            'post_id' => "required|int"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
