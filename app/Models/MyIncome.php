<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyIncome extends Model
{
    public function IncomeType(){
        return $this->belongsTo(IncomeType::class, 'incometypeid', 'id');
    }
}
