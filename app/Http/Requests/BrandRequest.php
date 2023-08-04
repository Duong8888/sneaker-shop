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
//        dd($currentAction);
        $tableName = (new Brand())->getTable();
        $id = request()->segment('3');
//        dd($id);
//        dd($currentAction);
        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case 'add':
                        $rules = [
                            'name_brand' => 'required',
                            'slug' => 'unique:brands',
                            'files' => 'required',
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
            'image.required' => 'bạn chưa chọn ảnh',
        ];
    }
}
