<?php
namespace App\Http\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class CampaignRebateRequest extends FormRequest
{
    protected $validation;
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
            'title' => 'required',
            'amount' => 'required|numeric',
            'rebate_levels' => '',
            'level' => ''
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return Redirect::back()->with("error",$validator->errors()->first());
    }
}
