<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'cep',
        'city',
        'uf',
        'public_place',
        'number',
        'complement'
    ];


    public function billet()
    {
        return $this->hasOne(Billet::class, 'address_id');
    }
}
