<?php

namespace App\Models\MY;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'my';
    protected $table = 'companies';
    protected $guarded = [];
}
