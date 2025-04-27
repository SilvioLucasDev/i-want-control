<?php declare(strict_types = 1);

namespace App\Expense\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvestmentRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'type'   => 'Investimento',
            'income' => 'Rendimento',
        ];
    }
    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type.unique' => 'Você já possui um :attribute com esse nome.',
        ];
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required',
                'string',
                'max:255',
                Rule::unique('investments', 'type')
                    ->where('user_id', logged_in_user_id())
                    ->ignore($this->route('investment')),
            ],
            'income' => [
                'nullable',
                'decimal:2',
                'min:0',
                'max:100',
            ],
        ];
    }
}
