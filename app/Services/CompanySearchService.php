<?php

namespace App\Services;

use App\Models\SG\Company as SgCompany;
use App\Models\MX\Company as MxCompany;
use App\Models\PH\Company as PhCompany;
use App\Models\MY\Company as MyCompany;

class CompanySearchService
{
    public function search($keyword)
    {
        return collect([
            'SG' => SgCompany::where('name', 'like', "%{$keyword}%")->get(),
            'MX' => MxCompany::where('name', 'like', "%{$keyword}%")->get(),
            'PH' => PhCompany::where('name', 'like', "%{$keyword}%")->get(),
            'MY' => MyCompany::where('name', 'like', "%{$keyword}%")->get(),
        ]);
    }
}
