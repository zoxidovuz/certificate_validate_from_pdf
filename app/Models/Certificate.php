<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use Filterable;

    protected $fillable = [
        'name_society',
        'type',
        'date_certificate',
        'file',
        'vat'
    ];
}
