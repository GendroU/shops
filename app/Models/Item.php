<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'round_desc',
        'caliber',
        'mass',
        'explosive_type',
        'explosive_mass',
        'tnt',
        'fuze',
        'pen',
    ];
}
