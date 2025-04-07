<?php declare(strict_types = 1);

namespace App\Project\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexProjectRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "project_id" => [
                "nullable",
                "integer",
                Rule::exists("projects", "id")->where("user_id", logged_in_user_id()),
            ],
            "selected_month" => [
                "nullable",
                "required_with:project_id,selected_year",
                "integer",
                "between:1,12",
            ],
            "selected_year" => [
                "nullable",
                "required_with:project_id,selected_month",
                "integer",
                "digits:4",
            ],
        ];
    }
}
