<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf_cnpj',
        'expiration',
        'price',
        'fees',
        'instructions',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

}
