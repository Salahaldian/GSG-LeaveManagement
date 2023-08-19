<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminShowAllRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $userId = auth()->id();
        if (
            User::query()
                ->where('id','=',$userId)
                ->where('type','=','admin')
                ->first())
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return
            [
                'user_id' => 'required',
            ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'user_id' => auth()->id()
            ]);
    }
}
