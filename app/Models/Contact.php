<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'zip_code',
        'addr_number',
        'address',
        'complement',
        'uf',
        'district',
        'city',
        'img_user'
    ];
}
