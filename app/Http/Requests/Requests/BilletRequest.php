<?php

namespace App\Http\Requests\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\SanitizeTraitRequest;

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
     * @return array
     */
    public function sanitize()
    {
        $input = $this->all();

        if (isset($input['price'])) {
            $input['price'] = str_replace('.', '', $input['price']);
            $input['price'] = (int) str_replace(',', '.', $input['price']);
        }

        $this->replace($input);

        return $this->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'cpf_cnpj' => ['required', 'string', 'min:14', 'max:18'],
            'expiration' => ['required', 'date'],
            'price' => ['required'],
            'cep' => ['required', 'string'],
            'city' => ['required', 'string'],
            'uf' => ['required', 'string'],
            'public_place' => ['string'],
            'number' => ['numeric', 'required'],
            'complement' => ['max:255']
        ];
    }
}
