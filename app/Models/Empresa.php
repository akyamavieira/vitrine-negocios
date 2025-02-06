<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'fk_user',
        'company_name',
        'cnpj',
        'size',
        'industry',
        'about',
        'cep',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'social_media',
        'website',
    ];
}
