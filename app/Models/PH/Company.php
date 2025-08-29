<?php

namespace App\Models\PH;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'ph';
    protected $table = 'companies';
    protected $guarded = [];
}
