<?php

namespace App\Http\Requests\Organisation;

use App\Models\Organisation;
use App\Rules\Base64EncodedPng;
use App\Rules\Slug;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->isGlobalAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => ['required', 'string', 'min:1', 'max:255', 'unique:'.table(Organisation::class).',slug', new Slug()],
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['required', 'string', 'min:1', 'max:10000'],
            'url' => ['required', 'url', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'min:1', 'max:255'],
            'logo' => ['nullable', 'string', new Base64EncodedPng()],
        ];
    }
}