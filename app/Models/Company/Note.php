<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class Note extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'company_id',
        'note',
        'is_private',
        'is_archived'
    ];
    protected $casts    = [
        'is_private' => 'boolean',
        'is_archived' => 'boolean'
    ];
}
