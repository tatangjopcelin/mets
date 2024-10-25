<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecetteRequest extends FormRequest
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
            // 'nom' => 'nullable|string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validation de l'image
            // 'description' => 'nullable|string',
            // 'duree'=> 'nullable|string',
            // 'budget' => 'nullable|numeric',
            // 'abonne_id'=> 'nullable',
    
        ];
    }
}
