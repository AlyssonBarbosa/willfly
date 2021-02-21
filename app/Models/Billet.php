<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billet extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'cpf_cnpj',
        'expiration',
        'price',
        'fees',
        'instructions',
        'address_id',
        'code',
        'status'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

}
