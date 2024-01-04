<?php

namespace App\Models\Monitor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monitor extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'user_id',
            'name',
            'companies'
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<int, string>
     */
    protected $casts
        = [
            'companies' => 'array'
        ];
}
