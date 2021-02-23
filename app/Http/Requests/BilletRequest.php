<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\SanitizeTraitRequest;
use App\Rules\CpfValidator;
use App\Rules\CnpjValidator;
use App\Rules\UfValidator;

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

        $date = date('Y-m-d');

        $rules =  [
            'name' => ['required', 'string','between:3,255'],            
            'expiration' => ['required', 'date', 'after_or_equal:' . $date],
            'price' => ['required'],
            'cep' => ['required', 'string', 'size:9'],
            'city' => ['required', 'string','between:3,255'],
            'uf' => ['required', 'string', 'size:2', new UfValidator()],
            'public_place' => ['required','string', 'between:3,255'],
            'number' => ['numeric', 'required'],
            'complement' => ['max:255'],
            'instructions' => ['max:100'],            
        ];

        $input = $this->all();

        if(strlen($input['cpf_cnpj']) <= 14) {            
            $rules['cpf_cnpj'] = ['required', 'string', 'size:14', new CpfValidator()];
        }else{            
            $rules['cpf_cnpj'] = ['required', 'string', 'size:18', new CnpjValidator()];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'instructions.max' => 'O campo INSTRUÇÕES deve conter no máximo 100 caracteres!' ,
            'complement.max' => 'O campo COMPLEMENTO deve conter no máximo 255 caracteres!' ,
            'number.numerico' => 'O campo NÚMERO só aceita numeros!',
            'number.required' => 'O campo NÚMERO é obrigatório!',
            'public_place.required' => 'O campo LOGRADOURO é obrigatório!',
            'public_place.string' => 'O campo LOGRADOURO deve ser uma texto!',
            'public_place.between' => 'O campo LOGRADOURO deve possuir entre 3 e 255 caracteres!',
            'city.required' => 'O campo CIDADE é obrigatório!',
            'public_place.string' => 'O campo CIDADE deve ser uma texto!',
            'price.required' => 'O campo VALOR é obrigatório!',
            'expiration.required' => 'O campo DATA DE VENCIMENTO é obrigatório!',
            'expiration.date' => 'O campo DATA DE VENCIMENTO deve ser uma data!',
            'expiration.after_or_equal' => 'O campo DATA DE VENCIMENTO deve ser maior ou igual a data atual!',
            'name.required' => 'O campo NOME/RAZÃO SOCIAL é obrigatório!',
            'name.string' => 'O campo NOME deve ser uma texto!',
            'name.between' => 'O campo NOME deve possuir entre 3 e 255 caracteres!',
        ];
    }
}
