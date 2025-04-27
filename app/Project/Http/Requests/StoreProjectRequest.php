<?php declare(strict_types = 1);

namespace App\Project\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'        => 'Projeto',
            'hourly_rate' => 'Valor da Hora',
        ];
    }
    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'Você já possui um :attribute com esse nome.',
        ];
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('projects', 'name')->where('user_id', logged_in_user_id()),
            ],
            'hourly_rate' => [
                'nullable',
                'decimal:2',
                'min:0',
                'max:100000',
            ],
        ];
    }
}
