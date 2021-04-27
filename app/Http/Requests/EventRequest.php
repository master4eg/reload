<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date',
            'phone' => 'sometimes|required|numeric|min:30000',
            'firstName' => 'sometimes|required|string|regex:/^[а-яёa-z]+$/iu',
            'secondName' => 'sometimes|required|string|regex:/^[а-яёa-z]+$/iu',
            'middleName' => 'sometimes|required|string|regex:/^[а-яёa-z]+$/iu',
        ];
    }

    public function attributes()
    {
        return [
            'date' => 'дата',
            'phone' => 'телефон',
            'firstName' => 'имя',
            'secondName' => 'фамилия',
            'middleName' => 'отчество',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Не заполнено поле ":attribute"',
            'min' => 'Слишком короткий номер телефона',
            'regex' => 'Неверный формат поля ":attribute"'
        ];
    }
}
