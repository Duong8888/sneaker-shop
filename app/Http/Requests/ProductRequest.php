<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method()):
            case 'POST':
                $rules = [
                    'productName' => 'required|string|max:255',
                    'brand' => 'required',
                    'color' => 'required',
                    'sizes' => 'required',
                    'description' => 'required|string',
                    'files' => 'required|array',
                    'files.*' => 'required|image|mimes:jpeg,png,jpg,gif', // Tùy chỉnh các định dạng và kích thước tập tin ảnh được phép tải lên.
                    'status' => 'required',
                ];
                break;
            case "PUT":
                $rules = [
                    'productName' => 'required|string|max:255',
                    'brand' => 'required|exists:brands,id',
                    'color' => 'required',
                    'sizes' => 'required',
                    'description' => 'required|string',
                    'status' => 'required',
                ];
                break;
        endswitch;
        return $rules;
    }
}
