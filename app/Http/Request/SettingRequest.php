<?php
namespace App\Http\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class SettingRequest extends FormRequest
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
      return $this->validator;
    }

    public function validationData()
    {
        $data = $this->all();
        $settings = config("admin.settings");
        foreach ($settings as $setting){
            foreach($setting as $config){

                $validation[$config['key']] = $config['validation'] ?? '';

                if($config['type'] == 'boolean' && !isset($data[$config['key']])){
                    $data[$config['key']] = 'false';
                }
            }
        }
        $this->validator = $validation;
        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        return Redirect::back()->with("error",$validator->errors()->first());
    }
}
