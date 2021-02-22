<?php

namespace App\Http\Requests\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\SanitizeTraitRequest;
use App\Rules\CpfValidator;
use App\Rules\CnpjValidator;

class BilletRequest extends FormRequest
{
    use SanitizeTraitRequest;

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
        $rules =  [
            'name' => ['required', 'string', 'max:255', 'min:3'],            
            'expiration' => ['required', 'date'],
            'price' => ['required'],
            'cep' => ['required', 'string'],
            'city' => ['required', 'string'],
            'uf' => ['required', 'string'],
            'public_place' => ['string'],
            'number' => ['numeric', 'required'],
            'complement' => ['max:255']
        ];

        $input = $this->all();

        if(strlen($input['cpf_cnpj']) <= 14) {            
            $rules['cpf_cnpj'] = ['required', 'string', 'min:14', 'max:14', new CpfValidator()];
        }else{            
            $rules['cpf_cnpj'] = ['required', 'string', 'min:17', 'max:18', new CnpjValidator()];
        }

        return $rules;
    }
}
