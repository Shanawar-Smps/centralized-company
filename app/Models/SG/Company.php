<?php

namespace App\Models\SG;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'sg';   // ✅ ensure it uses SG database
    protected $table = 'companies'; // or the correct table name

    public function reports()
    {
        return $this->hasMany(Report::class, 'company_id', 'id');
    }
}
