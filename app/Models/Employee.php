<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Company;

class Employee extends Model
{
    use HasFactory,SoftDeletes;
    public function company()
    {
        return $this->belongsTo(Company::class, "company_id")->withDefault();
    }
}
