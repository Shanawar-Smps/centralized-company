<?php

namespace App\Models\SG;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $connection = 'sg';
    protected $table = 'reports';

    protected $fillable = [
        'company_id', 'name', 'price' 
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
