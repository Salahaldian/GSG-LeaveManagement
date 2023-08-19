<?php

namespace App\Http\Requests;

use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $userId = auth()->id();
//        employee/request/{requestId}
        $requestId = request()->segment(2);
        $user = User::query()
            ->where('id', '=', $userId)
            ->where('type', '=', 'admin')
            ->first();
        $checkRequest = LeaveRequest::query()
            ->where('id', '=', $requestId)
            ->where('accept', '=', null)
            ->first();

        if ($user && $checkRequest) {
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
                'request_id' => 'required',
                'user_id' => 'required',
                'accept' => 'required|integer',
            ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'user_id' => auth()->id(),
                'request_id' => request()->segment(2)
            ]);
    }
}
