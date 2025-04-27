<?php declare(strict_types = 1);

namespace App\Project\Http\Requests;

use App\Common\Rules\EndTimeMustBeGreaterThanStartTime;
use Illuminate\Foundation\Http\FormRequest;

class StorePostingProjectActivityRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'scope'       => 'Escopo',
            'description' => 'Descrição',
            'start_time'  => 'Horário Inicial',
            'end_time'    => 'Horário Final',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => [
                'required',
                'exists:projects,id',
            ],
            'monthly_project_control_id' => [
                'nullable',
                'exists:monthly_project_controls,id',
            ],
            'scope' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
                'max:255',
            ],
            'start_time' => [
                'required',
                'date_format:H:i',
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                new EndTimeMustBeGreaterThanStartTime(),
            ],
        ];
    }
}
