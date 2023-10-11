<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => 'required|integer|delete_own_post'
        ];
    }
    
    /**
     * withValidator
     *
     * @param  mixed $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->addExtension('delete_own_post', function ($attr, $postId) {
            $userId = Auth::user()->id;
            return DB::table('posts')->where('id', $postId)->where('created_by', $userId)->exists();
        });
    }
}
