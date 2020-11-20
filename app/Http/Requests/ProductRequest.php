<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (in_array($this->method(), ['POST', 'CREATE'])) {
            return true;
        } else {
            return auth()->check();
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Router $router, Filesystem $files, Repository $config)
    {
      $rules = [];
        
        // CREATE
        if (in_array($this->method(), ['POST', 'CREATE'])) {
            $rules = $this->storeRules($router, $files, $config);
        }
        
        // UPDATE
        if (in_array($this->method(), ['PUT', 'PATCH', 'UPDATE'])) {
            $rules = $this->updateRules($router, $files, $config);
        }
        
        return $rules;
    }

    /**
     * @param $router
     * @param $files
     * @param $config
     * @return array
     */
    private function storeRules($router, $files, $config)
    {
        $rules = [
                
                'name'         => 'required|max:100',
                'category'     => 'required|integer',
                'quantity'     => 'required|integer',
                'description'  => 'required',
                'file'         =>'required|mimes:jpeg,png,jpg',
                'status'       =>'required'
                 
            ];
        
        return $rules;
    }
}
