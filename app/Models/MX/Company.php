<?php

namespace App\Models\MX;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'mx';
    protected $table = 'companies';
    protected $guarded = [];
}
