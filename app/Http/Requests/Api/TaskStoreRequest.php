<?php

namespace App\Http\Requests\Api;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'status' => 'required|integer|in:' . implode(',', array_column(TaskStatus::cases(), 'value')),
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
