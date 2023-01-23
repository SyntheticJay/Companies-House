<?php

namespace App\Models\Company\SicCode;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SicCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'sic_code',
        'description'
    ];
}
