<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [];
        $currentAction =$this->route()->getActionMethod();
        $tableName = (new Brand())->getTable();
        $id = request()->segment('2');
//        dd($currentAction);
        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case 'add':
                        $rules = [
                            'name_brand' => 'required',
                            'slug' => 'unique:brands',
                        ];
                        break;
                    case 'edit':
                        $rules = [
                            'name_brand' => 'required',
                            Rule::unique($tableName)->ignore(request($id)),
                        ];
                endswitch;
                break;

        endswitch;
        return $rules;
    }
    public function messages()
    {
        return [
          'name_brand.required' => 'không được bỏ trống tên',
            'slug.unique' => 'slug đang bị trùng lặp! hãy đổi tên khác :)))',
        ];
    }
}
