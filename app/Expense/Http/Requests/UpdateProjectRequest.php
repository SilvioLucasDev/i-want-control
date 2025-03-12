<?php declare(strict_types = 1);

namespace App\Expense\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255', 'unique:projects,name,NULL,NULL,user_id,' . auth()->id(), ],
            'hourlyRate' => [
                'nullable',
                'numeric',
            ],
        ];
    }
}
